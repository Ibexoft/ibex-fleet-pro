@extends('layouts.app')
@section('admincontent')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Driver</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <style>
        .required {
            color: red;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data" action="{{ route('driver.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between">
                                                <label for="first_name">First Name<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <div>
                                                    <label for="customSwitch3">skip this field?</label>
                                                    <div
                                                        class="d-inline-block custom-control custom-switch custom-switch-off custom-switch-on-danger">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitch3">
                                                        <label class="custom-control-label" for="customSwitch3"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" name="first_name" autocomplete="first_name" required
                                                class="form-control" value="{{ old('first_name') }}" id="first_name"
                                                placeholder="Enter First Name">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="last_name" autocomplete="last_name" required
                                                class="form-control" value="{{ old('last_name') }}" id="last_name"
                                                placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="driver_license_no">Driver's Licence Number<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="driver_license_no" autocomplete="driver_license_no"
                                                required class="form-control" value="{{ old('driver_license_no') }}"
                                                id="phone" placeholder="Enter Licence No">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="driver_license_state">Driver's Licence State<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <select required name="driver_license_state"
                                                class="form-control select2 err-tooltip" id="driver_license_state">
                                                @foreach ($driver_license_states as $driver_license_state)
                                                    <option value="{{ $driver_license_state }}"
                                                        @if (old('driver_license_state') === $driver_license_state) selected @endif>
                                                        {{ $driver_license_state }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="license_expiry_date">Driver's Licence Expiry Date<span
                                                    aria-hidden="true" class="required">*</span></label>
                                            <input type="text" name="license_expiry_date" required
                                                value="{{ old('license_expiry_date') }}" class="date-input form-control"
                                                id="date_picker" placeholder="Select Licence Expiry Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ezi_debt">EziDebit Driver Id</label>
                                            <input type="text" name="ezi_debt" autocomplete="ezi_debt"
                                                class="form-control" value="{{ old('ezi_debt') }}" id="ezi_debt"
                                                placeholder="Enter EziDebit">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dob">Date of Birth<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            {{-- max="1960-12-31" --}}
                                            {{-- <input type="text" class="disableFuturedate"> --}}
                                            <input type="text" name="dob" autocomplete="dob" required
                                                class="date-input   form-control" value="{{ old('dob') }}"
                                                id="date_of_birth" placeholder="Enter Date of Birth">
                                            {{-- <span style="display: none; padding: 8px; background-color: red; color: white;" id="display_error"></span> --}}
                                        </div>
                                    </div>
                                </div>
                                <fieldset
                                    style="border: 1px solid #d3d3d3; margin-bottom: 10px; padding: 20px; border-radius: 3px;">
                                    <legend><b>Contact</b></legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="email" required name="email" autocomplete="email"
                                                    class="form-control" value="{{ old('email') }}" id="email"
                                                    placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact">Telephone<span aria-hidden="true"
                                                        class="required">*</span> <small>Format: XXXXXXXXXX</small></label>
                                                <input type="tel" pattern="[0-9]{10}" name="contact"
                                                    autocomplete="contact" required class="form-control"
                                                    value="{{ old('contact') }}" id="contact"
                                                    placeholder="Enter Telephone">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset
                                    style="border: 1px solid #d3d3d3; margin-bottom: 10px; padding: 20px; border-radius: 3px;">
                                    <legend><b>Residential Address</b></legend>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="street">Street Address<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="street" autocomplete="street" required
                                                    class="form-control" value="{{ old('street') }}" id="street"
                                                    placeholder="Enter Street">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="suburb">Suburb<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="suburb" autocomplete="suburb"
                                                    class="form-control" value="{{ old('suburb') }}" id="suburb"
                                                    placeholder="Enter Suburb" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="postal_code">Post Code<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="number" name="postal_code" required
                                                    autocomplete="postal_code" class="form-control"
                                                    value="{{ old('postal_code') }}" id="postal_code"
                                                    placeholder="Enter Postal Code" pattern="^\d+$">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="state" required autocomplete="state"
                                                    class="form-control" value="{{ old('state') }}"
                                                    placeholder="Enter State" pattern="^[A-Za-z\s]+$">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- <div class="form-group">
                                                                              <label for="exampleInputPhone1">Country</label>
                                                                              <input type="text" name="country" required class="form-control" value="{{ old(' country ') }}" id="phone" placeholder="Enter Country">
                                                                            </div> -->
                                            <div class="form-group">
                                                <label>Country<span aria-hidden="true" class="required">*</span></label>
                                                <select required name="country" class="form-control select2 err-tooltip"
                                                    id="country">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $countries)
                                                        <option @if ($countries->country_name == 'Australia') selected @endif
                                                            value="{{ $countries->countries_id }}">
                                                            {{ $countries->country_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row">
                                    <div class="col-md-6 d-none">
                                        <div class="radio-h mt-2"></div>
                                        <div class="card img-placeholder-card">
                                            <div id="driver_img_name" class="img-name" style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'driver_image')">
                                                <img src="{{ asset('panelslayout/dist/img/driver-placeholder.png') }}"
                                                    id="driverPreviewImage" class="img-fluid" alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="driver-remove-container" style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('driver_img_name', 'driverPreviewImage', 'driver-remove-container', 'driver_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="image">Driver Picture<small> (JPEG, JPG and PNG
                                                    only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="image" id="driver_image" class="upload"
                                                    onchange="displayImage(event, 'driver_img_name', 'driverPreviewImage', 'driver-remove-container', 'driver_image')"
                                                    accept=".jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group clearfix text-center mt-2">
                                            <div class="icheck-danger d-inline mr-2">
                                                <input type="radio" name="radio_option" id="radio_passport"
                                                    value="Passport" checked onclick="changeInputName('passport_image')">
                                                <label for="radio_passport">Passport</label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="radio_option" id="radio_medicare"
                                                    value="Medicare" onclick="changeInputName('medicare_image')">
                                                <label for="radio_medicare">Medicare</label>
                                            </div>
                                        </div>
                                        <div class="card img-placeholder-card">
                                            <div id="passport_img_name" class="img-name" style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'passport_image')">
                                                <img src="{{ asset('panelslayout/dist/img/passport-placeholder-1.png') }}"
                                                    id="passportPreviewImage" class="img-fluid"
                                                    alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="passport-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('passport_img_name', 'passportPreviewImage', 'passport-remove-container', 'passport_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1"><span id="radio-span">Passport</span><small>
                                                    (PDF, JPEG, JPG and PNG only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="p_m_image" id="passport_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'passport_img_name', 'passportPreviewImage', 'passport-remove-container' , 'passport_image')"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio-h mt-2"></div>
                                        <div class="card img-placeholder-card">
                                            <div id="license_back_img_name" class="img-name" style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'license_back_image')">
                                                <img src="{{ asset('panelslayout/dist/img/license-back.png') }}"
                                                    id="licenseBackPreviewImage" class="img-fluid"
                                                    alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="license-back-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('license_back_img_name', 'licenseBackPreviewImage', 'license-back-remove-container', 'license_back_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1">Licence Back<small> (PDF, JPEG, JPG and PNG
                                                    only)</small><span aria-hidden="true"
                                                    class="required">*</span></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="license_back_image" id="license_back_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'license_back_img_name', 'licenseBackPreviewImage', 'license-back-remove-container', 'license_back_image')"
                                                    required accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card img-placeholder-card">
                                            <div id="license_front_img_name" class="img-name" style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'license_front_image')">
                                                <img src="{{ asset('panelslayout/dist/img/license-front.png') }}"
                                                    id="licenseFrontPreviewImage" class="img-fluid"
                                                    alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="license-front-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('license_front_img_name', 'licenseFrontPreviewImage', 'license-front-remove-container', 'license_front_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1">Licence Front<small> (PDF, JPEG, JPG and PNG
                                                    only)</small><span aria-hidden="true"
                                                    class="required">*</span></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="license_front_image" id="license_front_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'license_front_img_name', 'licenseFrontPreviewImage', 'license-front-remove-container', 'license_front_image')"
                                                    required accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card img-placeholder-card">
                                            <div id="doc_img_name" class="img-name" style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'other_documents')">
                                                <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                    id="otherDocuments" class="img-fluid" alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="other-documents-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('doc_img_name', 'otherDocuments', 'other-documents-remove-container', 'other_documents')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1">Other Documents <small>(PDF, JPEG, JPG and PNG
                                                    only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="document" id="other_documents"
                                                    class="upload"
                                                    onchange="displayImage(event, 'doc_img_name', 'otherDocuments', 'other-documents-remove-container',  'other_documents')"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <br><br>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <script>
        function displayImage(event, nameId, prevImgId, removeId, imageId) {
            var previewImage = document.getElementById(prevImgId);
            previewImage.parentNode.classList.add('card-body-img');
            var imageName = document.getElementById(nameId);
            var imageNameChild = imageName.children[0];
            var removeContainer = document.getElementById(removeId);
            var image = document.getElementById(imageId);
            if (!image.value) {
                removeDocImage(nameId, prevImgId, removeId, imageId);
                return false;
            }
            let imageType = event.target.files[0].type;
            let fileName = event.target.files[0].name
            if (imageType === "application/pdf") {
                previewImage.src = "{{ asset('panelslayout/dist/img/pdf.png') }}";
            } else {
                previewImage.src = URL.createObjectURL(event.target.files[0])
            }
            imageNameChild.textContent = fileName;
            removeContainer.style.display = 'block'
            imageName.style.display = 'block'
        }

        function removeDocImage(nameId, prevImgId, removeId, imageId) {
            var image = document.getElementById(prevImgId);
            image.parentNode.classList.remove('card-body-img');
            var imageName = document.getElementById(nameId);
            var imageInput = document.getElementById(imageId);
            var removeContainer = document.getElementById(removeId);
            imageInput.value = ''; // Clear the file input
            if (prevImgId === "driverPreviewImage") {
                image.src = "{{ asset('panelslayout/dist/img/driver-placeholder.png') }}";
            }
            if (prevImgId === "passportPreviewImage") {
                image.src = "{{ asset('panelslayout/dist/img/passport-placeholder-1.png') }}";
            }
            if (prevImgId === "licenseBackPreviewImage") {
                image.src = "{{ asset('panelslayout/dist/img/license-back.png') }}";
            }
            if (prevImgId === "licenseFrontPreviewImage") {
                image.src = "{{ asset('panelslayout/dist/img/license-front.png') }}";
            }
            if (prevImgId === "otherDocuments") {
                image.src = "{{ asset('panelslayout/dist/img/placholder-img.jpg') }}";
            }
            removeContainer.style.display = 'none';
            imageName.style.display = 'none';
        }
    </script>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            initializeSelect2Dropdown("#country", "Select Country");
        });

        $('#customSwitch3').on('change', function() {
            const isChecked = $(this).is(':checked');
            toggleDriverFirstNameField(isChecked);
        });
    </script>
@endsection
