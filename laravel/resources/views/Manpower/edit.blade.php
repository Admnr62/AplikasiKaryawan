@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Edit Manpower'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Manpower</p>
                        <a href="{{ route('manpower.index') }}" class="btn btn-secondary btn-sm ms-auto">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('manpower.update', $manpower->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p class="text-uppercase text-sm">Manpower Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ $manpower->nama }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="badge_number" class="form-control-label">Badge Number</label>
                                    <input class="form-control" type="text" id="badge_number" name="badge_number" value="{{ $manpower->badge_number }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_register" class="form-control-label">No Register</label>
                                    <input class="form-control" type="text" id="no_register" name="no_register" value="{{ $manpower->no_register }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" type="text" id="email" name="email" value="{{ $manpower->email }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="area_kerja" class="form-control-label">Area Kerja</label>
                                    <select class="form-control" id="area_kerja" name="area_kerja" required>
                                        @foreach($areas as $area)
                                        <option value="{{ $area->area_kerja }}" {{ $manpower->area_kerja ===
                                            $area->area_kerja ? 'selected' : '' }}>{{ $area->area_kerja }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer" class="form-control-label">Customer</label>
                                    <input class="form-control" type="text" id="customer" name="customer" value="{{ $manpower->customer }}" required>
                                </div>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="masa_berlaku_permit" class="form-control-label">Masa Berlaku</label>
                                     <input class="form-control" type="date" id="masa_berlaku_permit" name="masa_berlaku_permit" value="{{ $manpower->masa_berlaku_permit }}" required>
                                 </div>
                             </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="departemen" class="form-control-label">Departemen</label>
                                    <select class="form-control" id="departemen" name="departemen" required>
                                        @foreach($departemen as $departemen)
                                        <option value="{{ $departemen->nama_departemen }}" {{ $manpower->departemen ===
                                            $departemen->nama_departemen ? 'selected' : '' }}>{{
                                            $departemen->nama_departemen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jabatan" class="form-control-label">Jabatan</label>
                                    <select class="form-control" id="jabatan" name="jabatan" required>
                                        @foreach($jabatan as $job)
                                        <option value="{{ $job->nama_jabatan }}" {{ $manpower->jabatan ===
                                            $job->nama_jabatan ? 'selected' : '' }}>{{ $job->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_permit" class="form-control-label">Tipe Permit</label>
                                    <select class="form-control" id="tipe_permit" name="tipe_permit" required>
                                        <option value="">Pilih Tipe Permit</option>
                                        <option value="ID ONLY" {{ $manpower->tipe_permit == 'ID ONLY' ? 'selected' : '' }}>ID ONLY</option>
                                        <option value="PIT WORKER PERMIT" {{ $manpower->tipe_permit == 'PIT WORKER PERMIT' ? 'selected' : '' }}>PIT WORKER PERMIT</option>
                                        <option value="IN PIT ACCESS ONLY" {{ $manpower->tipe_permit == 'IN PIT ACCESS ONLY' ? 'selected' : '' }}>IN PIT ACCESS ONLY</option>
                                        <option value="FULL PIT ACCESS ONLY" {{ $manpower->tipe_permit == 'FULL PIT ACCESS ONLY' ? 'selected' : '' }}>FULL PIT ACCESS ONLY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permit_status" class="form-control-label">Permit Status</label>
                                    <input class="form-control" type="text" id="permit_status" name="permit_status" value="{{ $manpower->permit_status }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="form-control-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="Male" {{ $manpower->gender === 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ $manpower->gender === 'Female' ? 'selected' : ''
                                            }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Gambar</label>
                                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <img id="preview-image" src="{{ asset('upload/image/' . $manpower->image) }}" style="max-width: 100%;">
                                    <canvas id="cropped-canvas" style="display: none;"></canvas>
                                </div>
                                <div class="form-group text-end">
                                    <button type="button" id="crop-button" class="btn btn-primary">Crop</button>
                                </div>
                                <input type="hidden" id="croppedImage" name="croppedImage">
                                </div>
                        </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Certification</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">Certification</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Certification</th>
                                        <th>Deskripsi</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="certificationTable">
                                    @foreach ($manpower->certifications as $index => $certification)
                                    <tr id="certification-row-{{ $index }}">
                                        <td>
                                            <input type="hidden" name="certifications[{{ $index }}][id]" value="{{ $certification->id }}">
                                            <input type="hidden" name="certifications[{{ $index }}][deleted]" value="0">
                                            <input type="text" class="form-control" name="certifications[{{ $index }}][title]" value="{{ $certification->title }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="certifications[{{ $index }}][description]" value="{{ $certification->description }}">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="certifications[{{ $index }}][certificate]">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="deleteRow('certification-row-{{ $index }}', 'certifications[{{ $index }}][deleted]')">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="addCertification">Add Certification</button>
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Training</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">Training</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Training</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Training</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="trainingTable">
                                    @foreach ($manpower->training as $index => $train)
                                    <tr id="training-row-{{ $index }}">
                                        <td>
                                            <input type="hidden" name="training[{{ $index }}][id]" value="{{ $train->id }}">
                                            <input type="hidden" name="training[{{ $index }}][deleted]" value="0">
                                            <input type="text" class="form-control" name="training[{{ $index }}][title]" value="{{ $train->title }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="training[{{ $index }}][description]" value="{{ $train->description }}">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" name="training[{{ $index }}][tanggal_training]" value="{{ $train->tanggal_training }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="deleteRow('training-row-{{ $index }}', 'training[{{ $index }}][deleted]')">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="addTraining">Add Training</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
let certificationCount = {{ $manpower->certifications->count() }};
let trainingCount = {{ $manpower->training->count() }};

    let cropper;

    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.getElementById('preview-image');
            img.src = event.target.result;
            img.style.display = 'block';
            const cropButton = document.getElementById('crop-button');
            cropButton.style.display = 'block';

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(img, {
                aspectRatio: 1
                , viewMode: 1
            });
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('crop-button').addEventListener('click', function() {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 300
            , height: 300
        });

        canvas.toBlob(function(blob) {
            const fileInput = document.getElementById('croppedImage');
            const reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                fileInput.value = reader.result;

                // Update the preview image
                const img = document.getElementById('preview-image');
                img.src = reader.result;
                img.style.display = 'block';
            };

            cropper.destroy();
            cropper = null;

            // Hide the crop button
            document.getElementById('crop-button').style.display = 'none';
        });
    });

    document.getElementById('addCertification').addEventListener('click', function() {
        let table = document.getElementById('certificationTable');
        let index = certificationCount++;
        let row = document.createElement('tr');
        row.id = `certification-row-${index}`;
        row.innerHTML = `
        <td>
            <input type="hidden" name="certifications[${index}][id]" value="">
            <input type="hidden" name="certifications[${index}][deleted]" value="0">
            <input type="text" class="form-control" name="certifications[${index}][title]">
        </td>
        <td>
            <input type="text" class="form-control" name="certifications[${index}][description]">
        </td>
        <td>
            <input type="file" class="form-control" name="certifications[${index}][certificate]">
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="deleteRow('certification-row-${index}', 'certifications[${index}][deleted]')">Delete</button>
        </td>
    `;
        table.appendChild(row);
    });

    document.getElementById('addTraining').addEventListener('click', function() {
        let table = document.getElementById('trainingTable');
        let index = trainingCount++;
        let row = document.createElement('tr');
        row.id = `training-row-${index}`;
        row.innerHTML = `
        <td>
            <input type="hidden" name="training[${index}][id]" value="">
            <input type="hidden" name="training[${index}][deleted]" value="0">
            <input type="text" class="form-control" name="training[${index}][title]">
        </td>
        <td>
            <input type="text" class="form-control" name="training[${index}][description]">
        </td>
        <td>
            <input type="date" class="form-control" name="training[${index}][tanggal_training]">
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="deleteRow('training-row-${index}', 'training[${index}][deleted]')">Delete</button>
        </td>
    `;
        table.appendChild(row);
    });

    function deleteRow(rowId, deleteFieldName) {
        document.getElementById(rowId).style.display = 'none';
        document.querySelector(`input[name="${deleteFieldName}"]`).value = 1;
    }

</script>
<script>
    $(document).ready(function() {
        function updateBackgroundColor() {
            var selectedValue = $('#tipe_permit').val();
            var color = '';

            switch (selectedValue) {
                case 'ID ONLY':
                    color = 'white';
                    break;
                case 'PIT WORKER PERMIT':
                    color = 'pink';
                    break;
                case 'IN PIT ACCESS ONLY':
                    color = 'blue';
                    break;
                case 'FULL PIT ACCESS ONLY':
                    color = 'yellow';
                    break;
                default:
                    color = 'white';
                    break;
            }

            // Set background color of the select input
            $('#tipe_permit').css('background-color', color);
        }

        // Call the function when the page loads
        updateBackgroundColor();

        // Call the function when the select value changes
        $('#tipe_permit').on('change', function() {
            updateBackgroundColor();
        });
    });

</script>


@endsection
