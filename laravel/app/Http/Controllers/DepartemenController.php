<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departemen = Departemen::all();
        return view('departemen.index', compact('departemen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departemen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required',
        ]);
        $departemen = new Departemen;
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->save();
        Alert::success('Success', 'Departemen Berhasil Ditambahkan');
        return redirect()->route('departemen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $departemen = Departemen::find($id);
        return view('departemen.show', compact('departemen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departemen = Departemen::find($id);
        return view('departemen.edit', compact('departemen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_departemen' => 'required',
        ]);
        $departemen = Departemen::find($id);
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->save();
        Alert::success('Success', 'Departemen Berhasil Diubah');
        return redirect()->route('departemen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $departemen = Departemen::find($id);
        $departemen->delete();
        Alert::success('Success', 'Departemen Berhasil Dihapus');
        return redirect()->route('departemen.index');
    }
}
