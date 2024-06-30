@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <!-- Section 1: Total Manpower -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Manpower</p>
                        <h5 class="font-weight-bolder">{{ $totalManpower }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2, 3, 4: Manpower Charts (by Customer, Job Title, Gender) -->
    <div class="row mt-4">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <h6 class="text-capitalize">Manpower by Customer</h6>
                    <canvas id="manpowerByCustomerChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <h6 class="text-capitalize">Manpower by Job Title</h6>
                    <canvas id="manpowerByJobTitleChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <h6 class="text-capitalize">Manpower by Gender</h6>
                    <canvas id="manpowerByGenderChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 5: Trend Manpower dari Bulan Januari – Desember -->
    <div class="row mt-4">
        <div class="col-lg-7 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Trend Manpower dari Bulan Januari – Desember</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">{{ number_format($percentageIncrease, 1) }}% more</span> in {{
                        date('Y') }}
                    </p>
                </div>
                <div class="card-body p-3">
                    <canvas id="manpowerChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 6: List Pegawai -->
    <div class="row mt-4">
        <div class="col-lg-7 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">List Pegawai</h6>
                        <button class="btn btn-warning" onclick="checkExpiry()">Alert Expired ID</button>
                    </div>
                </div>
               <div class="table-responsive">
                   <table class="table align-items-center table-sm table-borderless">
                       <tbody>
                           @foreach ($manpower as $employee)
                           <tr>
                               <td class="w-30">
                                   <div class="d-flex align-items-center">
                                       <div>
                                           <img src="{{ asset('upload/image/' . $employee['image']) }}" alt="Employee Image" style="width: 50px; border-radius: 50%;">
                                       </div>
                                       <div class="ms-3">
                                           <p class="text-xs mb-0 text-muted">Nama</p>
                                           <h6 class="text-sm mb-0">{{ $employee['nama'] }}</h6>
                                       </div>
                                   </div>
                               </td>
                               <td>
                                   <div class="text-center">
                                       <p class="text-xs mb-0 text-muted">Jabatan</p>
                                       <h6 class="text-sm mb-0">{{ $employee['jabatan'] }}</h6>
                                   </div>
                               </td>
                               <td>
                                   <div class="text-center">
                                       <p class="text-xs mb-0 text-muted">Badge Number</p>
                                       <h6 class="text-sm mb-0">{{ $employee['badge_number'] }}</h6>
                                   </div>
                               </td>
                               <td class="align-middle text-sm">
                                   <div class="text-center">
                                       <p class="text-xs mb-0 text-muted">Masa Berlaku ID Karyawan</p>
                                       <h6 class="text-sm mb-0">{{ $employee['masa_berlaku_permit'] }}</h6>
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

   <!-- Modal untuk Notifikasi Expired ID -->
   @if($expiringSoon->isNotEmpty())
   <div id="expiryModal" class="modal" tabindex="-1" role="dialog">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <span class="fa fa-exclamation-triangle text-warning mr-2" style="font-size: 22px;"></span>
                   <h6 class="modal-title">Notifikasi Masa Berlaku ID-nya Akan Expired</h6>
                   <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="table-responsive">
                       <table class="table table-sm table-borderless">
                           <thead>
                               <tr>
                                   <th>Nama</th>
                                   <th>Masa Berlaku ID</th>
                                   <th>Actions</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($expiringSoon as $employee)
                               <tr>
                                   <td>{{ $employee->nama }}</td>
                                   <td>{{ $employee->masa_berlaku_permit }}</td>
                                   <td>
                                       <a href="{{ route('manpower.edit', $employee->id) }}" class="btn btn-primary btn-sm">Update Now</a>
                                       <a href="{{ route('kirimemail.web', $employee->id) }}" class="btn btn-primary btn-sm">Kirim email</a>
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
           </div>
       </div>
   </div>
   @endif

   <style>
       .modal-body .table {
           margin-bottom: 0;
       }

       .table-borderless td,
       .table-borderless th {
           border: 0;
       }

       .table th,
       .table td {
           padding: 0.75rem;
       }

       .btn-sm {
           margin-top: 0.2rem;
       }

   </style>


</div>
 <style>
     .table {
         margin-bottom: 0;
         border-collapse: collapse;
     }

     .table td,
     .table th {
         padding: 0.5rem;
     }

     .table-borderless td,
     .table-borderless th {
         border: 0;
     }

     .text-muted {
         color: #6c757d;
     }

 </style>



@include('layouts.footers.auth.footer')
@endsection

@push('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="./assets/js/plugins/chartjs.min.js"></script>


<script>
    function checkExpiry() {
   @if($expiringSoon->isNotEmpty())
   $('#expiryModal').modal('show');
   @else
   Swal.fire({
   icon: 'info',
   title: 'Tidak ada ID yang akan kadaluwarsa dalam 2 bulan ke depan.',
   showConfirmButton: false,
   timer: 1500
   });
   @endif
   }

   // Fix for modal close
   $(document).on('click', '[data-dismiss="modal"]', function(e) {
   e.stopPropagation();
   var $modal = $(this).closest('.modal');
   if ($modal.length) {
   $modal.modal('hide');
   }
   });

   ///////

   // Script untuk chart Manpower by Customer
   const manpowerByCustomerData = {!! json_encode($manpowerByCustomer) !!};

   function createManpowerByCustomerChart() {
   const ctx = document.getElementById('manpowerByCustomerChart').getContext('2d');
   new Chart(ctx, {
   type: 'bar',
   data: {
   labels: Object.keys(manpowerByCustomerData),
   datasets: [{
   label: 'Customer',
   data: Object.values(manpowerByCustomerData),
   backgroundColor: 'rgba(255, 99, 132, 0.2)',
   borderColor: 'rgba(255, 99, 132, 1)',
   borderWidth: 1
   }]
   },
   options: {
   scales: {
   y: {
   beginAtZero: true
   }
   }
   }
   });
   }

   // Panggil fungsi untuk membuat chart Manpower by Customer
   createManpowerByCustomerChart();

// Script untuk chart Manpower by Job Title
const manpowerByJobTitleData = {!! json_encode($manpowerByJobTitle) !!};

function createManpowerByJobTitleChart() {
const ctx = document.getElementById('manpowerByJobTitleChart').getContext('2d');
new Chart(ctx, {
type: 'pie',
data: {
labels: Object.keys(manpowerByJobTitleData),
datasets: [{
label: 'Job Title',
data: Object.values(manpowerByJobTitleData),
backgroundColor: [
'rgba(255, 99, 132, 0.5)',
'rgba(54, 162, 235, 0.5)',
'rgba(255, 206, 86, 0.5)',
'rgba(75, 192, 192, 0.5)',
'rgba(153, 102, 255, 0.5)'
],
borderColor: [
'rgba(255, 99, 132, 1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)'
],
borderWidth: 1
}]
}
});
}

// Panggil fungsi untuk membuat chart Manpower by Job Title
createManpowerByJobTitleChart();

// Script untuk chart Manpower by Gender
const manpowerByGenderData = {!! json_encode($manpowerByGender) !!};

function createManpowerByGenderChart() {
const ctx = document.getElementById('manpowerByGenderChart').getContext('2d');
new Chart(ctx, {
type: 'doughnut',
data: {
labels: Object.keys(manpowerByGenderData),
datasets: [{
label: 'Gender',
data: Object.values(manpowerByGenderData),
backgroundColor: [
'rgba(255, 99, 132, 0.5)',
'rgba(54, 162, 235, 0.5)'
],
borderColor: [
'rgba(255, 99, 132, 1)',
'rgba(54, 162, 235, 1)'
],
borderWidth: 1
}]
}
});
}

// Panggil fungsi untuk membuat chart Manpower by Gender
createManpowerByGenderChart();



 const trendLabels = {!! json_encode($trendManpower->pluck('created_at')->map(function($date) {
 return $date->format('M');
 })) !!};

 const trendData = {!! json_encode($trendManpower->pluck('id')) !!}; // Contoh data, sesuaikan dengan data yang benar

 // Function to create the manpower trend chart
 function createManpowerChart() {
 const ctx = document.getElementById('manpowerChart').getContext('2d');
 const chart = new Chart(ctx, {
 type: 'line',
 data: {
 labels: trendLabels,
 datasets: [{
 label: 'Trend Manpower',
 data: trendData,
 backgroundColor: 'rgba(54, 162, 235, 0.2)',
 borderColor: 'rgba(54, 162, 235, 1)',
 borderWidth: 2,
 tension: 0.1
 }]
 },
 options: {
 scales: {
 y: {
 beginAtZero: true
 }
 }
 }
 });
 }

 // Create the chart when the DOM is fully loaded
 document.addEventListener('DOMContentLoaded', function() {
 createManpowerChart();
 });

</script>
@endpush