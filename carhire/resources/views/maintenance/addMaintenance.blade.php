@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Request Maintenance</h1>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('maintenance.store') }}"
                            aria-label="{{ __('save-maintenance') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Driver<span aria-hidden="true" class="required">*</span></label>
                                            <select required name="driver_id" class="form-control select2 err-tooltip" id="driver_id">
                                                <option value="">Select Driver</option>
                                                @foreach ($driver as $driverData)
                                                    <option value="{{ $driverData->driver_id }}">
                                                        {{ $driverData->first_name }} {{ $driverData->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vehicle<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <select required name="vehicle_reg_id" class="form-control select2 err-tooltip" id="vehicle_reg_id"
                                                onchange="getVehicleOwner(this.value)">
                                                <option value="">Select Vehicle</option>
                                                @foreach ($vehicleData as $vehicle)
                                                    <option value="{{ $vehicle->vehicle_id }}">
                                                        {{ $vehicle->vehicle_registration_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maintenance Type<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <select required class="select2 err-tooltip" name="maintenance_type[]"
                                                multiple="multiple" data-placeholder="Select Applicable Maintenance Types" style="width: 100%;">
                                                @foreach ($type as $typeData)
                                                    <option value="{{ $typeData->maintenance_type_id }}">
                                                        {{ $typeData->maintenance_type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="maintenance_date">Maintenance Date<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" required autocomplete="maintenance_date"
                                                id="maintenance_date" name="maintenance_date" class="date-input form-control"
                                                placeholder="Maintenance Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control" autocomplete="comments" name="comments" id="comments" rows="3"
                                                placeholder="Comments..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputConfirmPassword1">Paid by<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" required autocomplete="paid_by"
                                                id="paid_by" value="" class="form-control" placeholder="Paid By"
                                                readonly>
                                            <input type="hidden" required autocomplete="paid_by" name="paid_by"
                                                id="paid_by_id" value="" class="form-control" placeholder="Paid By"
                                                readonly>
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
            getVehicleOwner($("#vehicle_reg_id").val());
        });
        
        // Select2
        $(document).ready(function() {
            initializeSelect2Dropdown("#vehicle_reg_id", "Select Vehicle");
            initializeSelect2Dropdown("#driver_id", "Select Driver");
        });
    </script>
@endsection
