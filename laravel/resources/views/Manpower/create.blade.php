@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Create Manpower'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create New Manpower</p>
                        <a href="{{ route('manpower.index') }}" class="btn btn-secondary btn-sm ms-auto">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('manpower.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p class="text-uppercase text-sm">Manpower Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" id="nama" name="nama" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="badge_number" class="form-control-label">Badge Number</label>
                                    <input class="form-control" type="number" id="badge_number" name="badge_number"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" type="text" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_register" class="form-control-label">No Register</label>
                                    <input class="form-control" type="text" id="no_register" name="no_register"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="area_kerja" class="form-control-label">Area Kerja</label>
                                    <select class="form-control" id="area_kerja" name="area_kerja" required>
                                       <option value="">Pilih Area Kerja</option>
                                        @foreach($areakerja as $areakerja)
                                        <option value="{{ $areakerja->area_kerja }}">{{ $areakerja->area_kerja}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer" class="form-control-label">Customer</label>
                                    <input class="form-control" type="text" id="customer" name="customer" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="departemen" class="form-control-label">Departemen</label>
                                    <select class="form-control" id="departemen" name="departemen" required>
                                      <option value="">Pilih Departemen</option>
                                        @foreach($departemen as $departemen)
                                        <option value="{{ $departemen->nama_departemen }}">{{
                                            $departemen->nama_departemen }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jabatan" class="form-control-label">Jabatan</label>
                                    <select class="form-control" id="jabatan" name="jabatan" required>
                                     <option value="">Pilih Jabatan</option>
                                        @foreach($jabatan as $job)
                                        <option value="{{ $job->nama_jabatan }}">{{ $job->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_permit" class="form-control-label">Tipe Permit</label>
                                    <select class="form-control" id="tipe_permit" name="tipe_permit" required>
                                        <option value="">Pilih Tipe Permit</option>
                                        <option value="ID ONLY">ID ONLY</option>
                                        <option value="PIT WORKER PERMIT">PIT WORKER PERMIT</option>
                                        <option value="IN PIT ACCESS ONLY">IN PIT ACCESS ONLY</option>
                                        <option value="FULL PIT ACCESS ONLY">FULL PIT ACCESS ONLY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permit_status" class="form-control-label">Permit Status</label>
                                    <input class="form-control" type="text" id="permit_status" name="permit_status"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="form-control-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masa_berlaku_permit" class="form-control-label">Masa Berlaku
                                        Permit</label>
                                    <input class="form-control" type="date" id="masa_berlaku_permit"
                                        name="masa_berlaku_permit" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-control-label">Gambar</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*"
                                    required>
                            </div>
                            <div class="form-group">
                                <img id="preview-image" style="max-width: 100%; display: none;">
                                <canvas id="cropped-canvas" style="display: none;"></canvas>
                            </div>
                            <div class="form-group text-end">
                                <button type="button" id="crop-button" class="btn btn-primary"
                                    style="display: none;">Crop</button>
                            </div>
                            <input type="hidden" id="croppedImage" name="croppedImage">
                        </div>
                        <p class="text-uppercase text-sm">Certifications</p>
                        <div id="certifications">
                            <div class="row certification-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certifications[0][title]" class="form-control-label">Title</label>
                                        <input class="form-control" type="text" name="certifications[0][title]"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certifications[0][description]"
                                            class="form-control-label">Description</label>
                                        <input class="form-control" type="text" name="certifications[0][description]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certifications[0][certificate]"
                                            class="form-control-label">Certificate</label>
                                        <input class="form-control" type="file" name="certifications[0][certificate]"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-certification" class="btn btn-secondary btn-sm">Add
                            Certification</button>

                        <p class="text-uppercase text-sm">Training</p>
                        <div id="training">
                            <div class="row training-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training[0][title]" class="form-control-label">Title</label>
                                        <input class="form-control" type="text" name="training[0][title]" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training[0][description]"
                                            class="form-control-label">Description</label>
                                        <input class="form-control" type="text" name="training[0][description]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training[0][tanggal_training]" class="form-control-label">Date
                                            Training</label>
                                        <input class="form-control" type="date" name="training[0][tanggal_training]">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="button" id="add-training" class="btn btn-secondary btn-sm">Add Training</button>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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

            const cropper = new Cropper(img, {
                aspectRatio: 1
                , viewMode: 1
                , crop(event) {
                    // Crop event
                }
            });

            cropButton.addEventListener('click', function() {
                const canvas = cropper.getCroppedCanvas({
                    width: 300
                    , height: 300
                });
                canvas.toBlob(function(blob) {
                    const formData = new FormData();
                    formData.append('croppedImage', blob);

                    const fileInput = document.getElementById('croppedImage');
                    const reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        fileInput.value = reader.result;
                    }

                    cropper.destroy();
                    img.style.display = 'none';
                    cropButton.style.display = 'none';
                });
            });
        };
        reader.readAsDataURL(file);
    });
   let certificationIndex = 1;
document.getElementById('add-certification').addEventListener('click', function() {
const certificationsDiv = document.getElementById('certifications');
const newCertification = document.createElement('div');
newCertification.classList.add('row', 'certification-row');
newCertification.innerHTML = `
<div class="col-md-6">
    <div class="form-group">
        <label for="certifications[${certificationIndex}][title]" class="form-control-label">Title</label>
        <input class="form-control" type="text" name="certifications[${certificationIndex}][title]" required>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="certifications[${certificationIndex}][description]" class="form-control-label">Description</label>
        <input class="form-control" type="text" name="certifications[${certificationIndex}][description]">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="certifications[${certificationIndex}][certificate]" class="form-control-label">Certificate</label>
        <input class="form-control" type="file" name="certifications[${certificationIndex}][certificate]"
            accept="image/*">
    </div>
</div>
`;
certificationsDiv.appendChild(newCertification);
certificationIndex++;
});
    // Add new training row
    document.getElementById('add-training').addEventListener('click', function() {
        var trainingIndex = document.querySelectorAll('.training-row').length;
        var newTraining = document.createElement('div');
        newTraining.className = 'row training-row';
        newTraining.innerHTML = `
    <div class="col-md-6">
        <div class="form-group">
            <label for="training_title" class="form-control-label">Title</label>
            <input class="form-control" type="text" name="training[` + trainingIndex + `][title]" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="training_description" class="form-control-label">Description</label>
            <input class="form-control" type="text" name="training[` + trainingIndex + `][description]">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal_training" class="form-control-label">Date Training</label>
            <input class="form-control" type="date" name="training[` + trainingIndex + `][tanggal_training]">
        </div>
    </div>

    `;
        document.getElementById('training').appendChild(newTraining);
    });

</script>
<script>
    $(document).ready(function() {
        $('#tipe_permit').on('change', function() {
            var selectedValue = $(this).val();
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
            $(this).css('background-color', color);
        });
    });

</script>
@endsection