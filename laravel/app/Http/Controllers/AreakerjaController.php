<?php

namespace App\Http\Controllers;

use App\Models\areakerja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AreakerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areakerjas = areakerja::all();
        return view('areakerjas.index', compact('areakerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areakerjas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'area_kerja' => 'required',
        ]);
        $areakerja = new areakerja;
        $areakerja->area_kerja = $request->area_kerja;
        $areakerja->save();
        Alert::success('Success', 'Area Kerja Berhasil Ditambahkan');
        return redirect()->route('areakerja.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('areakerjas.show', compact('areakerja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $areakerja = areakerja::find($id);
        return view('areakerjas.edit', compact('areakerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request, [
            'area_kerja' => 'required',
        ]);
        $areakerja = areakerja::find($id);
        $areakerja->area_kerja = $request->area_kerja;
        $areakerja->save();
        Alert::success('Success', 'Area Kerja Berhasil Diubah');
        return redirect()->route('areakerja.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $areakerja = areakerja::find($id);
        $areakerja->delete();
        Alert::success('Success', 'Area Kerja Berhasil Dihapus');
        return redirect()->route('areakerja.index');
    }
}
