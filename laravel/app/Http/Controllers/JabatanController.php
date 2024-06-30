<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = jabatan::all();
        return view('jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'nama_jabatan' => 'required|string|max:255',
        // tambahkan validasi lainnya sesuai kebutuhan
    ]);

    jabatan::create([
        'nama_jabatan' => $request->nama_jabatan,
        // tambahkan field lainnya sesuai kebutuhan
    ]);

    // SweetAlert success message
    Alert::success('Success', 'Jabatan berhasil ditambahkan.');

    return redirect()->route('jabatan.index');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jabatan = jabatan::findOrFail($id);
        return view('jabatan.show', compact('jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jabatan = jabatan::findOrFail($id);
        
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'nama_jabatan' => 'required|string|max:255',
        // tambahkan validasi lainnya sesuai kebutuhan
    ]);

    $jabatan = jabatan::find($id);
    $jabatan->nama_jabatan = $request->nama_jabatan;
    $jabatan->save();
    
    // SweetAlert success message
    Alert::success('Success', 'Jabatan berhasil diperbarui.');

    return redirect()->route('jabatan.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jabatan = jabatan::findOrFail($id);
        $jabatan->delete();

        // SweetAlert success message
        Alert::success('Success', 'jabatan berhasil dihapus.');

        return redirect()->route('jabatan.index');
    }
}
