@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Vehicle</h1>
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
                                action="{{ route('vehicle.update', $vehicleData->vehicle_id) }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Owner Type<span aria-hidden="true" class="required">*</span></label>
                                                <select required name="owner_type" id="owner_type" class="form-control select2 err-tooltip"
                                                onchange="disableSelectFirstOption(this); fetchOwners(this.value,`{{route('get-owners-based-on-type') }}`)">
                                                    <option value="" disabled>Select Owner Type</option>
                                                    <option value="Individual" {{$vehicleData->vehicle_owner->entity_type == 'Individual' ? 'selected' : ''}}
                                                    >Individual</option>
                                                    <option value="Company" {{$vehicleData->vehicle_owner->entity_type == 'Company' ? 'selected' : ''}}
                                                    >Company</option>
                                                    <option value="Trust" {{$vehicleData->vehicle_owner->entity_type == 'Trust' ? 'selected' : ''}}
                                                    >Trust</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label id="vehicle_owner_label">Vehicle Owner<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <select required name="vehicle_owner" id="vehicle_owner" class="form-control select2 err-tooltip" disabled data-id={{$vehicleData->vehicle_owner->customer_id}}>
                                                    <option value="">Select Vehicle Owner</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Make</label>
                                                <select name="vehicle_making_id" id="vehicle_making_id" class="form-control select2 err-tooltip" required>
                                                    @foreach ($making_companies as $brand)
                                                        <option
                                                            <?= $brand->brand_id == $vehicleData->vehicle_making_company ? 'selected' : '' ?>
                                                            value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="registration_no">Registration No<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" value="{{ $vehicleData->vehicle_registration_no }}"
                                                    id="registration_no" name="vehicle_registration_no" required
                                                    class="form-control" placeholder="Vehicle Registration Number" maxlength="25">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fuel_type">Fuel Type<span aria-hidden="true"
                                                    class="required">*</span></label>
                                                <select name="fuel_type" id="fuel_type" class="form-control select2 err-tooltip" required>
                                                    <option <?= $vehicleData->fuel_type == '' ? 'selected' : '' ?>
                                                        value="">Select Fuel Type</option>
                                                    <option <?= $vehicleData->fuel_type == 'petrol' ? 'selected' : '' ?>
                                                        value="petrol">Petrol</option>
                                                    <option <?= $vehicleData->fuel_type == 'diesel' ? 'selected' : '' ?>
                                                        value="diesel">Diesel</option>
                                                    <option
                                                        <?= $vehicleData->fuel_type == 'electric' ? 'selected' : '' ?>
                                                        value="electric">Electric</option>
                                                    <option <?= $vehicleData->fuel_type == 'hybrid' ? 'selected' : '' ?>
                                                        value="hybrid">Hybrid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="model">Model<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" required value="{{ $vehicleData->vehicle_model }}"
                                                    id="model" name="model" class="form-control"
                                                    placeholder="Vehicle Model" maxlength="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vin">VIN</label>
                                                <input type="text" autocomplete="color" value="{{ $vehicleData->vin }}" required
                                                    id="vin" name="vin" class="form-control" placeholder="VIN" pattern="[A-HJ-NPR-Z0-9]{17}" 
                                                    title="The VIN must be 17 alphanumeric characters long and must not contain letters I, O & Q.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="engine_no">Engine No<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" name="vehicle_engine_no"
                                                    value="{{ $vehicleData->vehicle_engine_no }}" id="engine_no" required
                                                    class="form-control" placeholder="Vehicle Engine Number" maxlength="25">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type" id="type" class="form-control select2 err-tooltip" required>
                                                    <option
                                                        <?= $vehicleData->vehicle_type == 'hatch-back' ? 'selected' : '' ?>
                                                        value="hatch-back">Hatch Back</option>
                                                    <option <?= $vehicleData->vehicle_type == 'sedan' ? 'selected' : '' ?>
                                                        value="sedan">Sedan</option>
                                                    <option <?= $vehicleData->vehicle_type == 'suv' ? 'selected' : '' ?>
                                                        value="suv">Suv</option>
                                                    <option
                                                        <?= $vehicleData->vehicle_type == 'commercial' ? 'selected' : '' ?>
                                                        value="commercial">Commercial</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="year">Year<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="number" required value="{{ $vehicleData->vehicle_year }}"
                                                    id="year" name="year" class="form-control" placeholder="Year"
                                                    pattern="\d{4}" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="color">Color<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <input type="text" required value="{{ $vehicleData->vehicle_color }}"
                                                    id="color" name="color" class="form-control" placeholder="Color" pattern="^[A-Za-z\s]+$" maxlength="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="biller_code">BPAY Biller Code</label>
                                                <input type="text" autocomplete="color"
                                                    value="{{ $vehicleData->biller_code }}" id="biller_code"
                                                    name="biller_code" class="form-control" placeholder="Biller Code">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="reference_no">BPAY Reference No</label>
                                                <input type="text" autocomplete="color"
                                                    value="{{ $vehicleData->reference_no }}" id="reference_no"
                                                    name="reference_no" class="form-control" placeholder="Reference No">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="admin_fee">Weekly Rent</label>
                                                <input type="number" autocomplete="color"
                                                    value="{{ $vehicleData->admin_fee }}" id="admin_fee"
                                                    name="admin_fee" class="form-control" placeholder="Weekly Rent" step="0.01">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                       <div class="form-group">
                        <label for="exampleInputConfirmPassword1">BPAY Details</label>
                        <input type="text" autocomplete="color" value="{{$vehicleData->bepay_detail}}" id="bepay_detail" name="bepay_detail" class="form-control"  placeholder="Bepay Details">
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
                                                    <input class="custom-control-input" value="Personal" type="radio"
                                                        id="customRadio1" name="vehicle_status"
                                                        <?= $vehicleData->vehicle_status == 'Personal' ? 'checked' : '' ?>>
                                                    <label for="customRadio1" class="custom-control-label">Personal
                                                        Vehicle</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input <?= $vehicleData->vehicle_status == 'Ride Share' ? 'checked' : '' ?>
                                                        class="custom-control-input" value="Ride Share" type="radio"
                                                        id="customRadio3" name="vehicle_status">
                                                    <label for="customRadio3" class="custom-control-label">Ride Share</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input <?= $vehicleData->vehicle_status == 'Other' ? 'checked' : '' ?>
                                                        class="custom-control-input" value="Other" type="radio"
                                                        id="customRadio2" name="vehicle_status">
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
                        <button type="submit" class="btn btn-primary">Update Vehicle</button>
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
    fetchOwners("{{$vehicleData->vehicle_owner->entity_type}}",`{{route('get-owners-based-on-type') }}`,{{$vehicleData->vehicle_owner->customer_id}});
</script>
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