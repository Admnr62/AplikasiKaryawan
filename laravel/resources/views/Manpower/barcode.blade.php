@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Print QR Codes'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>QR Codes</h6>
                </div>
                <div class="card-body">
                    <div class="row" id="printable-area">
                        @foreach($manpower as $employee)
                        <div class="col-md-3 text-center mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $employee->nama }}</h5>
                                    {!! QrCode::size(200)->generate($employee->barcode) !!}
                                    {{-- <p>{{ $employee->barcode }}</p> --}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary" onclick="printCards()">PRINT</button>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #printable-area,
        #printable-area * {
            visibility: visible;
        }

        #printable-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
        }
    }

</style>

<script>
    function printCards() {
        window.print();
    }

</script>
@endsection

