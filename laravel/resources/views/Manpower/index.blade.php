@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Manpower</h6>
                <a href="{{ route('manpower.create') }}" class="btn btn-primary">Create Manpower</a>
                <form action="{{ route('manpower.printAllQRCodes') }}" method="GET" class="d-inline">
                    <button type="submit" class="btn btn-primary">Print All</button>
                </form>
                <form action="{{ route('manpower.printByAreaKerja') }}" method="GET" class="d-inline mt-3">
                    <div class="form-group">
                        <label for="area_kerja">Select Area Kerja</label>
                        <select class="form-control" id="area_kerja" name="area_kerja">
                            @foreach($areas as $area)
                            <option value="{{ $area->area_kerja }}">{{ $area->area_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary">Print by Area Kerja</button>
                </form>
            </div>
            <form action="{{ route('manpower.index') }}" method="GET" class="p-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by Name, Customer, Jabatan, Area Kerja" name="query">
                </div>
                <button class="btn btn-outline-secondary mt-3" type="submit">Search</button>
                <a href="{{ route('manpower.index') }}" class="btn btn-outline-secondary mt-3">Reset</a>
            </form>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Badge Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Register</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Area Kerja</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Departemen</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jabatan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipe Permit</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Masa Berlaku Permit</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Permit Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manpower as $index => $s)
                            <tr>
                                <td class="align-middle">{{ $manpower->firstItem() + $index }}</td>
                                <td class="align-middle">{{ $s->nama }}</td>
                                <td class="align-middle">{{ $s->badge_number }}</td>
                                <td class="align-middle">{{ $s->no_register }}</td>
                                <td class="align-middle">{{ $s->area_kerja }}</td>
                                <td class="align-middle">{{ $s->customer }}</td>
                                <td class="align-middle">{{ $s->departemen }}</td>
                                <td class="align-middle">{{ $s->jabatan }}</td>
                                 <td class="align-middle" style="background-color: 
                                @switch($s->tipe_permit)
                                    @case('ID ONLY')
                                        white
                                        @break
                                    @case('PIT WORKER PERMIT')
                                        pink
                                        @break
                                    @case('IN PIT ACCESS ONLY')
                                        blue
                                        @break
                                    @case('FULL PIT ACCESS ONLY')
                                        yellow
                                        @break
                                    @default
                                        white
                                @endswitch;">
                                    {{ $s->tipe_permit }}
                                </td>
                                <td class="align-middle">{{ $s->gender }}</td>
                                <td class="align-middle text-center">
                                    @if ($s->masa_berlaku_permit instanceof \DateTime)
                                    {{ $s->masa_berlaku_permit->format('d/m/Y') }}
                                    @else
                                    {{ $s->masa_berlaku_permit }}
                                    @endif
                                </td>
                                <td class="align-middle text-center">{{ $s->permit_status }}</td>
                                <td class="align-middle text-center">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a href="{{ route('manpower.edit', $s->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('manpower.destroy', $s->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        <a href="{{ route('manpower.show', $s->id) }}" class="btn btn-info btn-sm">Show</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $manpower->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-content')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/dataTables.select.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#datatable-buttons').DataTable({
            dom: 'lBfrtip'
            , buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

</script>
@endsection

@section('top-content')
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
    .dt-buttons button {
        font-size: 12px;
        padding: 10px;
        height: 35px;
    }

    .dt-buttons {
        width: 40%;
    }

    .dataTables_length {
        display: inline-block;
    }

    #datatable-buttons_filter {
        width: 60%;
        display: inline-block;
    }

</style>
@stop

{{-- <td class="align-middle text-center text-sm">
    <span class="badge badge-sm bg-gradient-success">Online</span>
</td> --}}
