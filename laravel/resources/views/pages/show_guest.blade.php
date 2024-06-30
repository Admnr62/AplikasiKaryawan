@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<div class="container-fluid py-4  justify-content-center ">

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0 text-center">
                    {{-- <img src="{{ asset('images/profile_placeholder.png') }}"  --}}
                     <img src="{{ asset('upload/image/' . $manpower['image']) }}" alt="Profile Image" style="width: 100px; height: 100px;">
                    <h6>{{ $manpower->nama }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Jabatan:</strong> {{ $manpower->jabatan }}</p>
                            <p><strong>Customer:</strong> {{ $manpower->customer }}</p>
                            <p><strong>Area Kerja:</strong> {{ $manpower->area_kerja }}</p>
                            <p><strong>Awal Masuk:</strong> {{ \Carbon\Carbon::parse($manpower->created_at)->format('d-M-Y') }}</p>
                            <p><strong>Masa Kerja:</strong> {{ $manpower->masa_berlaku_permit }}</p>
                            <p><strong>Badge Number:</strong> {{ $manpower->badge_number }}</p>
                        </div>
                        <div class="col-md-6">
                            @php
                            $bgClass = '';
                            switch ($manpower->tipe_permit) {
                            case 'ID ONLY':
                            $bgClass = 'bg-gradient-light';
                            break;
                            case 'PIT WORKER PERMIT':
                            $bgClass = 'bg-gradient-pink';
                            break;
                            case 'IN PIT ACCESS ONLY':
                            $bgClass = 'bg-gradient-blue';
                            break;
                            case 'FULL PIT ACCESS ONLY':
                            $bgClass = 'bg-gradient-yellow';
                            break;
                            default:
                            $bgClass = 'bg-gradient-light';
                            break;
                            }
                            @endphp

                            <p class="{{ $bgClass }}" style="padding: 10px; border-radius: 5px;">
                                <strong>TIPE PERMIT:</strong> {{ $manpower->tipe_permit }}
                            </p>
                            <p><strong>No Register:</strong> {{ $manpower->no_register }}</p>
                            <div class="text-center">
                                <p><strong>QR Code:</strong></p>
                                {!! QrCode::size(150)->generate($manpower->barcode) !!}
                                <p>{{ $manpower->nama }} # {{ $manpower->badge_number }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="text-center">Historical Training</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Materi</th>
                                <th>Deskripsi</th>
                                <th>Training</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($manpower->training as $training)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $training->title }}</td>
                                <td>{{ $training->description }}</td>
                                <td>{{ $training->tanggal_training }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No training records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary" onclick="window.print()">PRINT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.bg-gradient-light {
    background: linear-gradient(87deg, #f6f9fc 0, #e9ecef 100%) !important;
}

.bg-gradient-pink {
    background: linear-gradient(87deg, #f3a4b5 0, #f596a9 100%) !important;
}

.bg-gradient-blue {
    background: linear-gradient(87deg, #11cdef 0, #1171ef 100%) !important;
}

.bg-gradient-yellow {
    background: linear-gradient(87deg, #ffeb3b 0, #ff9800 100%) !important;
}

</style>
@endsection

