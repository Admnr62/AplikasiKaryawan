@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Employee Profile'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>{{ $manpower->nama }}</h6>
                </div>
                <div class="card-body">
                 <img src="{{ asset('upload/image/' . $manpower['image']) }}" alt="Profile Image" style="width: 100px; height: 100px;"> 
                    <p><strong>Badge Number:</strong> {{ $manpower->badge_number }}</p>
                    <p><strong>No Register:</strong> {{ $manpower->no_register }}</p>
                    <p><strong>Area Kerja:</strong> {{ $manpower->area_kerja }}</p>
                    <p><strong>Customer:</strong> {{ $manpower->customer }}</p>
                    <p><strong>Departemen:</strong> {{ $manpower->departemen }}</p>
                    <p><strong>Jabatan:</strong> {{ $manpower->jabatan }}</p>
                    <p><strong>Permit Status:</strong> {{ $manpower->permit_status }}</p>
                    <p><strong>Masa Berlaku Permit:</strong> {{ $manpower->masa_berlaku_permit }}</p>
                    <p><strong>Gender:</strong> {{ $manpower->gender }}</p>
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


                    <p><strong>Barcode:</strong></p>
                    {!! QrCode::size(300)->generate($manpower->barcode) !!}

                    <p><strong>Certifications:</strong></p>
                    <ul>
                        @foreach($manpower->certifications as $certification)
                        <li>{{ $certification->title }} - <a
                                href="{{ asset('/' . $certification->certificate) }}" target="_blank">View
                                Certificate</a></li>
                        @endforeach
                    </ul>

                   <p><strong>Training:</strong></p>
                   <ul>
                       @foreach($manpower->training as $training)
                       <li>
                           <p><strong>Title:</strong> {{ $training->title }}</p>
                           <p><strong>Date Training :</strong> {{ $training->tanggal_training }}</p>
                           <p><strong>Description:</strong> {{ $training->description }}</p>
                       </li>
                       @endforeach
                   </ul>


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

</div>
@endsection