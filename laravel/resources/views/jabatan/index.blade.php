<!-- resources/views/jabatan/index.blade.php -->

@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Jabatan Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Jabatan</h6>
                <a href="{{ route('jabatan.create') }}" class="btn btn-primary">Create Jabatan</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-3">
                    <table id="jabatan-table" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jabatan as $j)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $j->nama_jabatan }}</td>

                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('jabatan.edit', $j->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                                        <form action="{{ route('jabatan.destroy', $j->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#jabatan-table').DataTable();
    });

</script>
@endsection
