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
                    <h1>Edit Driver</h1>
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                                        <i class="fas fa-arrow-left mr-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('driver.update', $driver->driver_id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between">
                                                <label for="first_name">First Name<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <div>
                                                    <label for="customSwitch3">skip this field? </label>
                                                    <div
                                                        class="d-inline-block custom-control custom-switch custom-switch-off custom-switch-on-danger">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitch3" {{ is_null($driver->first_name) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customSwitch3"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" id="first_name" name="first_name" required
                                                class="form-control" value="{{ $driver->first_name }}" id="name"
                                                placeholder="Enter First Name"
                                                {{ is_null($driver->first_name) ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Last Name<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="last_name" required class="form-control"
                                                value="{{ $driver->last_name }}" id="name"
                                                placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Driver's Licence Number<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" onchange="checkDate()" name="driver_license_no" required
                                                class="form-control" @if (!Auth::user()->hasRole('Super-Admin')) readonly @endif
                                                value="{{ $driver->driver_license_no }}" id="dl_expiry_date"
                                                placeholder="Enter Licence No">
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
                                                        {{ old('driver_license_state', $driver->driver_license_state) === $driver_license_state ? 'selected' : '' }}>
                                                        {{ $driver_license_state }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Driver's Licence Expiry Date<span
                                                    aria-hidden="true" class="required">*</span></label>
                                            <input type="text" name="license_expiry_date" required
                                                class="date-input form-control"
                                                value="{{ date('d-m-Y', strtotime($driver->license_expiry_date)) }}"
                                                @if (!Auth::user()->hasRole('Super-Admin')) disabled @endif id="date_picker"
                                                placeholder="Select Licence Expiry Date">
                                            {{-- <span style="display: none; padding: 8px; background-color: red; color: white;" id="display_error"></span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">EziDebit Driver Id</label>
                                            <input type="text" name="ezi_debt" class="form-control"
                                                value="{{ $driver->ezi_debt }}"
                                                @if (!Auth::user()->hasRole('Super-Admin')) readonly @endif id="ezi_debt"
                                                placeholder="Enter EziDebit ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Date of Birth<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="dob" autocomplete="dob" required
                                                class="date-input form-control"
                                                value="{{ date('d-m-Y', strtotime($driver->dob)) }}" id="date_of_birth"
                                                placeholder="Enter Date of Birth">
                                            {{-- <input type="text" name="dob" required class="form-control"   id="phone" placeholder="Enter Date of Birth"> --}}
                                        </div>
                                    </div>
                                </div>
                                <fieldset
                                    style="border: 1px solid #d3d3d3; margin-bottom: 10px; padding: 20px; border-radius: 3px;">
                                    <legend><b>Contact</b></legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="email" required name="email" class="form-control"
                                                    value="{{ $driver->email }}" id="email"
                                                    placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPhone1">Telephone <span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="contact" required class="form-control"
                                                    value="{{ $driver->contact }}" id="phone"
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
                                                <label for="exampleInputPhone1">Street Address<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="street" required class="form-control"
                                                    value="{{ $driver->street }}" id="phone"
                                                    placeholder="Enter Street">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPhone1">Suburb<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="suburb" class="form-control"
                                                    value="{{ $driver->suburb }}" id="phone"
                                                    placeholder="Enter Suburb" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPhone1">Postal Code<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="number" name="postal_code" required class="form-control"
                                                    value="{{ $driver->postal_code }}" id="phone"
                                                    placeholder="Enter Postal Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputPhone1">State<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="state" required class="form-control"
                                                    value="{{ $driver->state }}" id="phone"
                                                    placeholder="Enter State" pattern="^[A-Za-z\s]+$">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country<span aria-hidden="true" class="required">*</span></label>
                                                <select required name="country" class="form-control select2 err-tooltip"
                                                    id="country">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $country)
                                                        <option
                                                            <?= $country->countries_id == $driver->country ? 'selected' : '' ?>
                                                            value="{{ $country->countries_id }}">
                                                            {{ $country->country_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div style="margin-bottom: 15px;" class="row">
                                    <div class="col-md-6 d-none">
                                        <div class="radio-h mt-2"></div>
                                        @if ($driver->driver_image)
                                            <input type="hidden" name="changed_image" id="changed_image">
                                            <div class="card img-placeholder-card">
                                                <div id="driver_img_name" class="img-name" style="display:none">
                                                    <span class="name">
                                                        {{ substr($driver->driver_image, strpos($driver->driver_image, 'img\\') + 4) }}
                                                    </span>
                                                </div>
                                                @if (pathinfo($driver->driver_image, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class="card-body card-body-img"
                                                        ondragover="handleDragOver(event)"
                                                        ondragleave="handleDragLeave(event)"
                                                        ondrop="handleDrop(event, 'driver_image')">
                                                        <a href="{{ asset('') . $driver->driver_image }}"
                                                            target="_blank">
                                                            <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                                id="driverPreviewImage" class="img-fluid" alt="pdf">
                                                        </a>
                                                    </div>
                                                    <div class="card-footer" id="driver-remove-container">
                                                        <button type="button" class="btn btn-outline-danger btn-block sm"
                                                            onclick="removeDocImage('driver_img_name', 'driverPreviewImage', 'driver-remove-container', 'driver_image','changed_image')">
                                                            Remove
                                                        </button>
                                                    </div>
                                                @elseif (pathinfo($driver->driver_image, PATHINFO_EXTENSION) == 'png' ||
                                                        pathinfo($driver->driver_image, PATHINFO_EXTENSION) == 'jpg' ||
                                                        pathinfo($driver->driver_image, PATHINFO_EXTENSION) == 'jpeg')
                                                    <div class="card-body card-body-img"
                                                        ondragover="handleDragOver(event)"
                                                        ondragleave="handleDragLeave(event)"
                                                        ondrop="handleDrop(event, 'driver_image')">
                                                        <img src="{{ asset('') . $driver->driver_image }}"
                                                            id="driverPreviewImage" class="img-fluid" alt="driver-image">
                                                    </div>
                                                    <div class="card-footer" id="driver-remove-container">
                                                        <button type="button" class="btn btn-outline-danger btn-block sm"
                                                            onclick="removeDocImage('driver_img_name', 'driverPreviewImage', 'driver-remove-container', 'driver_image','changed_image')">
                                                            Remove
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="card img-placeholder-card">
                                                <div id="driver_img_name" class="img-name" style="display: none;">
                                                    <span class="name"></span>
                                                </div>
                                                <div class="card-body" ondragover="handleDragOver(event)"
                                                    ondragleave="handleDragLeave(event)"
                                                    ondrop="handleDrop(event, 'driver_image')">
                                                    <img src="{{ asset('panelslayout/dist/img/driver-placeholder.png') }}"
                                                        id="driverPreviewImage" class="img-fluid"
                                                        alt="document-placeholder">
                                                </div>
                                                <div class="card-footer" id="driver-remove-container"
                                                    style="display: none;">
                                                    <button type="button" class="btn btn-outline-danger btn-block sm"
                                                        onclick="removeDocImage('driver_img_name', 'driverPreviewImage', 'driver-remove-container', 'driver_image','changed_image')">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group w-100">
                                            <label for="image">Driver Picture<small> (JPEG, JPG and PNG
                                                    only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="image" id="driver_image" class="upload"
                                                    onchange="displayImage(event, 'driver_img_name', 'driverPreviewImage', 'driver-remove-container', 'driver_image', 'changed_image')"
                                                    accept=".jpg,.png,.jpeg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group clearfix text-center mt-2">
                                            <div class="icheck-danger d-inline mr-2">
                                                <input type="radio" name="radio_option" id="radio_passport"
                                                    value="Passport" onclick="changeInputName('passport_image')"
                                                    @if ($driver->p_m_value == 'Passport') checked @endif>
                                                <label for="radio_passport">Passport</label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="radio_option" id="radio_medicare"
                                                    value="Medicare" onclick="changeInputName('medicare_image')"
                                                    @if ($driver->p_m_value == 'Medicare') checked @endif>
                                                <label for="radio_medicare">Medicare</label>
                                            </div>
                                        </div>
                                        @if ($driver->p_m_image)
                                            <input type="hidden" id="changed_passport_image" name="changed_p_m_image">
                                            <div class="card img-placeholder-card">
                                                <div id="passport_img_name" class="img-name" style="display:none">
                                                    <span class="name">
                                                        {{ substr($driver->p_m_image, strpos($driver->p_m_image, 'img\\') + 4) }}
                                                    </span>
                                                </div>
                                                @if (pathinfo($driver->p_m_image, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class="card-body card-body-img"
                                                        ondragover="handleDragOver(event)"
                                                        ondragleave="handleDragLeave(event)"
                                                        ondrop="handleDrop(event, 'passport_image')">
                                                        <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                            id="passportPreviewImage" class="img-fluid" alt="pdf">
                                                    </div>
                                                @elseif (pathinfo($driver->p_m_image, PATHINFO_EXTENSION) == 'png' ||
                                                        pathinfo($driver->p_m_image, PATHINFO_EXTENSION) == 'jpg' ||
                                                        pathinfo($driver->p_m_image, PATHINFO_EXTENSION) == 'jpeg')
                                                    <div class="card-body card-body-img"
                                                        ondragover="handleDragOver(event)"
                                                        ondragleave="handleDragLeave(event)"
                                                        ondrop="handleDrop(event, 'passport_image')">
                                                        <img src="{{ asset('') . $driver->p_m_image }}"
                                                            id="passportPreviewImage" class="img-fluid"
                                                            alt="driver-image">
                                                    </div>
                                                    <div class="card-footer" id="passport-remove-container">
                                                        <button type="button" class="btn btn-outline-danger btn-block sm"
                                                            onclick="removeDocImage('passport_img_name', 'passportPreviewImage', 'passport-remove-container', 'passport_image', 'changed_passport_image')">
                                                            Remove
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
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
                                        @endif
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1"><span id="radio-span">
                                                    @if ($driver->p_m_value == 'Passport')
                                                        Passport
                                                    @else
                                                        Medicare
                                                    @endif
                                                </span><small> (PDF, JPEG, JPG and PNG only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="p_m_image" id="passport_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'passport_img_name', 'passportPreviewImage', 'passport-remove-container' , 'passport_image', 'changed_passport_image')"
                                                    accept=".jpg,.png,.jpeg,.pdf">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio-h mt-2"></div>
                                        @if ($driver->license_back_image)
                                            <input type="hidden" name="changed_license_back_image">
                                            <div class="card img-placeholder-card">
                                                <div id="license_back_img_name" class="img-name" style="display:none">
                                                    <span class="name">
                                                        {{ substr($driver->license_back_image, strpos($driver->license_back_image, 'img\\') + 4) }}
                                                    </span>
                                                </div>
                                                @if (pathinfo($driver->license_back_image, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class="card-body">
                                                        <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                            id="licenseBackPreviewImage" class="img-fluid"
                                                            alt="pdf">
                                                    </div>
                                                @elseif (pathinfo($driver->license_back_image, PATHINFO_EXTENSION) == 'png' ||
                                                        pathinfo($driver->license_back_image, PATHINFO_EXTENSION) == 'jpg' ||
                                                        pathinfo($driver->license_back_image, PATHINFO_EXTENSION) == 'jpeg')
                                                    <div class="card-body">
                                                        <img src="{{ asset('') . $driver->license_back_image }}"
                                                            id="licenseBackPreviewImage" class="img-fluid"
                                                            alt="driver-image">
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="card img-placeholder-card">
                                                <div id="license_back_img_name" class="img-name" style="display: none;">
                                                    <span class="name"></span>
                                                </div>
                                                <div class="card-body">
                                                    <img src="{{ asset('panelslayout/dist/img/driver-placeholder.png') }}"
                                                        id="licenseBackPreviewImage" class="img-fluid"
                                                        alt="document-placeholder">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1">Licence Back<small> (PDF, JPEG, JPG and PNG
                                                    only)</small><span aria-hidden="true"
                                                    class="required">*</span></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="license_back_image" id="license_back_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'license_back_img_name', 'licenseBackPreviewImage', 'license-back-remove-container' , 'license_back_image', 'changed_license_back_image')"
                                                    accept=".jpg,.png,.jpeg,.pdf">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($driver->license_front_image)
                                            <input type="hidden" name="changed_license_front_image">
                                            <div class="card img-placeholder-card">
                                                <div id="license_front_img_name" class="img-name" style="display:none">
                                                    <span class="name">
                                                        {{ substr($driver->license_front_image, strpos($driver->license_front_image, 'img\\') + 4) }}
                                                    </span>
                                                </div>
                                                @if (pathinfo($driver->license_front_image, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class="card-body">
                                                        <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                            id="licenseFrontPreviewImage" class="img-fluid"
                                                            alt="pdf">
                                                    </div>
                                                @elseif (pathinfo($driver->license_front_image, PATHINFO_EXTENSION) == 'png' ||
                                                        pathinfo($driver->license_front_image, PATHINFO_EXTENSION) == 'jpg' ||
                                                        pathinfo($driver->license_front_image, PATHINFO_EXTENSION) == 'jpeg')
                                                    <div class="card-body">
                                                        <img src="{{ asset('') . $driver->license_front_image }}"
                                                            id="licenseFrontPreviewImage" class="img-fluid"
                                                            alt="driver-image">
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="card img-placeholder-card">
                                                <div id="license_front_img_name" class="img-name" style="display: none;">
                                                    <span class="name"></span>
                                                </div>
                                                <div class="card-body">
                                                    <img src="{{ asset('panelslayout/dist/img/driver-placeholder.png') }}"
                                                        id="licenseFrontPreviewImage" class="img-fluid"
                                                        alt="document-placeholder">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1">Licence Front<small> (PDF, JPEG, JPG and PNG
                                                    only)</small><span aria-hidden="true"
                                                    class="required">*</span></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="license_front_image" id="license_front_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'license_front_img_name', 'licenseFrontPreviewImage', 'license-front-remove-container' , 'license_front_image', 'changed_license_front_image')"
                                                    accept=".jpg,.png,.jpeg,.pdf">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($driver->other_document)
                                            <input type="hidden" id="changed_other_document"
                                                name="changed_other_document">
                                            <div class="card img-placeholder-card">
                                                <div id="doc_img_name" class="img-name" style="display:none">
                                                    <span class="name">
                                                        {{ substr($driver->other_document, strpos($driver->other_document, 'img\\') + 4) }}
                                                    </span>
                                                </div>
                                                @if (pathinfo($driver->other_document, PATHINFO_EXTENSION) == 'pdf')
                                                    <div class="card-body card-body-img"
                                                        ondragover="handleDragOver(event)"
                                                        ondragleave="handleDragLeave(event)"
                                                        ondrop="handleDrop(event, 'other_documents')">
                                                        <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                            id="otherDocuments" class="img-fluid" alt="pdf">
                                                    </div>
                                                    <div class="card-footer" id="other-documents-remove-container">
                                                        <button type="button" class="btn btn-outline-danger btn-block sm"
                                                            onclick="removeDocImage('doc_img_name', 'otherDocuments', 'other-documents-remove-container', 'other_documents','changed_other_document')">
                                                            Remove
                                                        </button>
                                                    </div>
                                                @elseif (pathinfo($driver->other_document, PATHINFO_EXTENSION) == 'png' ||
                                                        pathinfo($driver->other_document, PATHINFO_EXTENSION) == 'jpg' ||
                                                        pathinfo($driver->other_document, PATHINFO_EXTENSION) == 'jpeg')
                                                    <div class="card-body card-body-img"
                                                        ondragover="handleDragOver(event)"
                                                        ondragleave="handleDragLeave(event)"
                                                        ondrop="handleDrop(event, 'other_documents')">
                                                        <img src="{{ asset('') . $driver->other_document }}"
                                                            id="otherDocuments" class="img-fluid" alt="driver-image">
                                                    </div>
                                                    <div class="card-footer" id="other-documents-remove-container">
                                                        <button type="button" class="btn btn-outline-danger btn-block sm"
                                                            onclick="removeDocImage('doc_img_name', 'otherDocuments', 'other-documents-remove-container', 'other_documents','changed_other_document')">
                                                            Remove
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
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
                                                        onclick="removeDocImage('doc_img_name', 'otherDocuments', 'other-documents-remove-container', 'other_documents','changed_other_document')">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1">Other Documents <small>(PDF, JPEG, JPG and PNG
                                                    only)</small><span aria-hidden="true" class="required"></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="document" id="other_documents"
                                                    class="upload"
                                                    onchange="displayImage(event, 'doc_img_name', 'otherDocuments', 'other-documents-remove-container' , 'other_documents','changed_other_document')"
                                                    accept=".jpg,.png,.jpeg,.pdf">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Driver</button>
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
        function displayImage(event, nameId, prevImgId, removeId, imageId, changedInputId) {
            var changedInput = document.getElementById(changedInputId);
            if (changedInput != null) {
                changedInput.value = 0;
            }
            var previewImage = document.getElementById(prevImgId);
            var imageName = document.getElementById(nameId);
            var imageNameChild = imageName.children[0];
            var removeContainer = document.getElementById(removeId);
            var image = document.getElementById(imageId);
            if (!image.value) {
                removeDocImage(nameId, prevImgId, removeId, imageId, changedInputId);
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
            imageName.style.display = 'block';
            if (removeContainer != null) {
                previewImage.parentNode.classList.add('card-body-img');
                removeContainer.style.display = 'block';
            }
        }

        function removeDocImage(nameId, prevImgId, removeId, imageId, changedInputId) {
            var changedInput = document.getElementById(changedInputId);
            if (changedInput != null) {
                var changedInput = document.getElementById(changedInputId);
                changedInput.value = 1;
            }
            var image = document.getElementById(prevImgId);
            image.parentNode.classList.remove('card-body-img');
            var imageName = document.getElementById(nameId);
            var imageInput = document.getElementById(imageId);
            var removeContainer = document.getElementById(removeId);
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
