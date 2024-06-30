<!-- resources/views/jabatan/edit.blade.php -->

@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Edit Departemen'])

<div class="row mt-4 mx-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Departemen</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('departemen.update', $departemen->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_departemen" class="form-label">Nama Departemen</label>
                        <input type="text" class="form-control" id="nama_departemen" name="nama_departemen"
                            value="{{ $departemen->nama_departemen }}" required>
                    </div>
                    <!-- tambahkan field lainnya sesuai kebutuhan -->

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection