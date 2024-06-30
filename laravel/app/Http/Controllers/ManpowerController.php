<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Manpower;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Storage;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\areakerja;
use App\Models\Certification;
use App\Models\Training;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpiredIDNotification;





class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $manpower = Manpower::search($query)->paginate(5); // 10 items per page
        $areas = areakerja::all();

        return view('manpower.index', compact('manpower', 'areas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departemen = Departemen::all();
        $jabatan = Jabatan::all();
        $areakerja = areakerja::all();
        return view('Manpower.create', compact('departemen', 'jabatan', 'areakerja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama'          => 'required',
        //     'badge_number'  => 'required',
        //     'no_register'   => 'required',
        //     'area_kerja'    => 'required',
        //     'customer'      => 'required',
        //     'departemen'    => 'required',
        //     'gender'        => 'required',
        //     'permit_status' => 'required',
        //     'image'         => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $manpower = new Manpower();
        $manpower->nama = $request->nama;
        $manpower->badge_number = $request->badge_number;
        $manpower->no_register = $request->no_register;
        $manpower->area_kerja = $request->area_kerja;
        $manpower->customer = $request->customer;
        $manpower->departemen = $request->departemen;
        $manpower->jabatan = $request->jabatan;
        $manpower->masa_berlaku_permit = $request->masa_berlaku_permit;
        $manpower->tipe_permit = $request->tipe_permit;
        $manpower->gender = $request->gender;
        $manpower->permit_status = $request->permit_status;
        $manpower->email = $request->email;

        if ($request->croppedImage) {
            $imageData = $request->croppedImage;
            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);

            $imageName = time() . '.png';
            $path = public_path('upload/image/' . $imageName);
            file_put_contents($path, $imageData);

            $manpower->image = $imageName;
        }

        $manpower->save();

        $qrCodeContent = route('manpower.showguest', $manpower->id);

        // Simpan URL QR code dalam kolom 'barcode' pada model Manpower
        $manpower->barcode = $qrCodeContent;
        $manpower->save();


        // Save certifications and training
        if ($request->certifications) {
            foreach ($request->certifications as $certification) {
                $certificateData = [
                    'title' => $certification['title'],
                    'description' => $certification['description'] ?? null,
                ];

               if (isset($certification['certificate']) && $certification['certificate']->isValid()) {
                $file = $certification['certificate'];
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('upload/certificates');
                
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                
                $file->move($destinationPath, $filename);
                $certificateData['certificate'] = 'upload/certificates/' . $filename;
            }
                $manpower->certifications()->create($certificateData);
            }
        }

        if ($request->training) {
            foreach ($request->training as $training) {
                $manpower->training()->create($training);
            }
        }
        Alert::success('Success', 'Data Berhasil Disimpan');
        return redirect(route('manpower.index'))->with('message', 'Karyawan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $manpower = Manpower::with('certifications', 'training')->findOrFail($id);
        return view('manpower.show', compact('manpower'));
    }

    public function showGuest($id)
    {
        $manpower = Manpower::with('certifications', 'training')->findOrFail($id);
        return view('pages.show_guest', compact('manpower'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $manpower = Manpower::findOrFail($id);
        $areas = areakerja::all();
        $departemen = Departemen::all();
        $jabatan = Jabatan::all();
        return view('manpower.edit', compact('manpower', 'areas', 'departemen', 'jabatan'));
    }


    /**
     * Update the specified resource in storage.
     */
    // Controller Method
public function update(Request $request, $id)
{
    $manpower = Manpower::find($id);

    // Update basic information
    $manpower->nama = $request->nama;
    $manpower->badge_number = $request->badge_number;
    $manpower->no_register = $request->no_register;
    $manpower->area_kerja = $request->area_kerja;
    $manpower->customer = $request->customer;
    $manpower->departemen = $request->departemen;
    $manpower->jabatan = $request->jabatan;
    $manpower->masa_berlaku_permit = $request->masa_berlaku_permit;
    $manpower->tipe_permit = $request->tipe_permit;
    $manpower->gender = $request->gender;
    $manpower->permit_status = $request->permit_status;

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $manpower->foto = $filename;
    }

    $manpower->save();

    // Update certifications
    foreach ($request->certifications as $certification) {
        if ($certification['deleted'] == 1) {
            if (!empty($certification['id'])) {
                Certification::find($certification['id'])->delete();
            }
            continue;
        }

        if (empty($certification['id'])) {
            $newCertification = new Certification();
            $newCertification->manpower_id = $manpower->id;
        } else {
            $newCertification = Certification::find($certification['id']);
        }

        $newCertification->title = $certification['title'];
        $newCertification->description = $certification['description'];

        if (isset($certification['certificate']) && $certification['certificate']->isValid()) {
            $file = $certification['certificate'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('upload/certificates');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $file->move($destinationPath, $filename);
            $newCertification->certificate = 'upload/certificates/' . $filename;
        }


        $newCertification->save();
    }

    // Update training
    foreach ($request->training as $train) {
        if ($train['deleted'] == 1) {
            if (!empty($train['id'])) {
                Training::find($train['id'])->delete();
            }
            continue;
        }

        if (empty($train['id'])) {
            $newTraining = new Training();
            $newTraining->manpower_id = $manpower->id;
        } else {
            $newTraining = Training::find($train['id']);
        }

        $newTraining->title = $train['title'];
        $newTraining->description = $train['description'];
        $newTraining->tanggal_training = $train['tanggal_training'];

        $newTraining->save();
    }
     Alert::success('Success', 'Data Berhasil Diupdate');
    return redirect()->route('manpower.index')->with('success', 'Diupdate updated successfully');
}






    /**
     *
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $manpower = Manpower::findOrFail($id);
            $manpower->delete();
            Alert::success('Success', 'Data karyawan berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data karyawan.');
        }

        return redirect(route('manpower.index'));
    }

    public function sendEmail($id)
    {
        $employee = Manpower::findOrFail($id); // Sesuaikan dengan model dan method pencarian

        // Kirim email
        Mail::to($employee->email)->send(new ExpiredIDNotification($employee));
         Alert::success('Success', 'Email notification sent successfully.');
        return redirect()->back()->with('status', 'Email notification sent successfully.'); // Redirect sesuai kebutuhan
    }

    public function printAllQRCodes()
    {
        $manpower = Manpower::all();

        return view('manpower.barcode', compact('manpower'));
    }

    public function printByAreaKerja(Request $request)
    {
        $areaKerja = $request->input('area_kerja');
        $manpower = Manpower::where('area_kerja', $areaKerja)->get();

        return view('manpower.barcode', compact('manpower'));
    }
}
