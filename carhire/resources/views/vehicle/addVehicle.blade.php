@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Vehicle</h1>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('vehicle.store') }}"
                            aria-label="{{ __('save-vehicle') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Owner Type<span aria-hidden="true" class="required">*</span></label>
                                            <select required name="owner_type" class="form-control select2 err-tooltip" id="owner_type"
                                                onchange="disableSelectFirstOption(this); fetchOwners(this.value,`{{ route('get-owners-based-on-type') }}`)">
                                                <option value="" selected disabled>Select Owner Type</option>
                                                <option value="Individual">Individual</option>
                                                <option value="Company">Company</option>
                                                <option value="Trust">Trust</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="vehicle_owner_label">Vehicle Owner<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <select required name="vehicle_owner" id="vehicle_owner" class="form-control select2 err-tooltip"
                                                disabled>
                                                <option value="">Select Vehicle Owner</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Make<span aria-hidden="true" class="required">*</span></label>
                                            <select required name="vehicle_making_id" id="vehicle_making_id" class="form-control select2 err-tooltip">
                                                <option value="">Select Making Brand</option>
                                                @foreach ($making_companies as $brand)
                                                    <option value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="registration_no">Registration No<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" autocomplete="registration_no"
                                                value="{{ old('vehicle_registration_no') }}" id="registration_no"
                                                name="vehicle_registration_no" required class="form-control"
                                                placeholder="Vehicle Registration Number" maxlength="25">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fuel_type">Fuel Type<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            {{-- <input value="{{ old('name')}}" autocomplete="name" id="name" type="text" name="name"  class="form-control" id="exampleInputName1" placeholder="Vehicle Name"> --}}
                                            <select required name="fuel_type" id="fuel_type" class="form-control select2 err-tooltip"
                                                value="{{ old('fuel_type') }}">
                                                <option value="">Select Fuel Type</option>
                                                <option value="petrol">Petrol</option>
                                                <option value="diesel">Diesel</option>
                                                <option value="electric">Electric</option>
                                                <option value="hybrid">Hybrid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="model">Model<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" required value="{{ old('model') }}" autocomplete="model"
                                                id="model" name="model" class="form-control"
                                                placeholder="Vehicle Model" maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vin">VIN<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" autocomplete="color" value="{{ old('vin') }}" required
                                                id="vin" name="vin" class="form-control" placeholder="VIN"
                                                pattern="[A-HJ-NPR-Z0-9]{17}"
                                                title="The VIN must be 17 alphanumeric characters long and must not contain letters I, O & Q.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="engine_no">Engine No<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="vehicle_engine_no" autocomplete="engine_no"
                                                value="{{ old('vehicle_engine_no') }}" id="engine_no" required
                                                class="form-control" placeholder="Vehicle Engine Number" maxlength="25">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type<span aria-hidden="true" class="required">*</span></label>
                                            <select required name="type" id="type" class="form-control select2 err-tooltip"
                                                value="{{ old('type') }}">
                                                <option value="">Select Type</option>
                                                <option value="hatch-back">Hatch Back</option>
                                                <option value="sedan">Sedan</option>
                                                <option value="suv">Suv</option>
                                                <option value="commercial">Commercial</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="year">Year<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="number" required autocomplete="year"
                                                value="{{ old('year') }}" id="year" name="year"
                                                placeholder="Year" class="form-control" pattern="\d{4}" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="color">Color<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" required autocomplete="color"
                                                value="{{ old('color') }}" id="color" name="color"
                                                placeholder="Color" class="form-control" pattern="^[A-Za-z\s]+$" maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="biller_code">BPAY Biller Code</label>
                                            <input type="text" autocomplete="color" value="{{ old('biller_code') }}"
                                                id="biller_code" name="biller_code" class="form-control"
                                                placeholder="Biller Code">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="reference_no">BPAY Reference No</label>
                                            <input type="text" autocomplete="color" value="{{ old('reference_no') }}"
                                                id="reference_no" name="reference_no" class="form-control"
                                                placeholder="Reference No">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="admin_fee">Weekly Rent</label>
                                            <input type="number" autocomplete="color" value="{{ old('admin_fee') }}"
                                                id="admin_fee" name="admin_fee" class="form-control"
                                                placeholder="Weekly Rent" step="0.01">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                       <div class="form-group">
                        <label for="exampleInputConfirmPassword1">BPAY Details</label>
                        <input type="text" autocomplete="color" value="{{old('bepay_detail')}}" id="bepay_detail" name="bepay_detail" class="form-control"  placeholder="Bepay Details">
                      </div>
                    </div> --}}
                                </div>
                                {{-- <div class="row"> --}}
                                <!-- <div class="col-md-6">
                                    </div> -->
                                {{-- </div> --}}
                                <div class="row">
                                    <div>
                                        <label>Vehicle Type</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" autocomplete="vehicle_status"
                                                    value="Personal" type="radio" id="customRadio1"
                                                    name="vehicle_status" checked>
                                                <label for="customRadio1" class="custom-control-label">Personal
                                                    Vehicle</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" autocomplete="vehicle_status"
                                                    value="Ride Share" type="radio" id="customRadio3"
                                                    name="vehicle_status">
                                                <label for="customRadio3" class="custom-control-label">Ride Share</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" autocomplete="vehicle_status"
                                                    value="Other" type="radio" id="customRadio2"
                                                    name="vehicle_status">
                                                <label for="customRadio2" class="custom-control-label">Other
                                                    Vehicle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            initializeSelect2Dropdown("#vehicle_owner", "Select Vehicle Owner");
            initializeSelect2Dropdown("#vehicle_making_id", "Select Making Brand");
            initializeSelect2Dropdown("#owner_type", "Select Owner Type");
            removeSelect2Search("#owner_type");
            initializeSelect2Dropdown("#fuel_type", "Select Fuel Type");
            removeSelect2Search("#fuel_type");
            initializeSelect2Dropdown("#type", "Select Type");
            removeSelect2Search("#type");
        });
    </script>
@endsection
