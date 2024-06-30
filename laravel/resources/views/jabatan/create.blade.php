<!-- resources/views/jabatan/create.blade.php -->

@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Create Jabatan'])

<div class="row mt-4 mx-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Jabatan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                    </div>
                    <!-- tambahkan field lainnya sesuai kebutuhan -->

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
