<!-- resources/views/jabatan/create.blade.php -->

@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Create Area Kerja'])

<div class="row mt-4 mx-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Area Kerja</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('areakerja.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="area_kerja" class="form-label">Area Kerja</label>
                        <input type="text" class="form-control" id="area_kerja" name="area_kerja" required>
                    </div>
                    <!-- tambahkan field lainnya sesuai kebutuhan -->

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection