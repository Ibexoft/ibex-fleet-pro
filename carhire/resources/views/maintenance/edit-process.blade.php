@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Maintenance</h1>
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
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('maintenance.update-processed', $maintenance->id) }}"
                            aria-label="{{ __('maintenance.update-processed') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Driver<span aria-hidden="true" class="required">*</span></label>
                                            <input type="text" class="form-control" id="driver_full_name"
                                                name="driver_full_name"
                                                value="{{ $maintenance->getDriver->first_name }} {{ $maintenance->getDriver->last_name }}"
                                                required readonly>
                                            <input type="hidden" class="form-control" id="driver_id" name="driver_id"
                                                value="{{ $maintenance->getDriver->driver_id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vehicle<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control" id="vehicle_registration_no"
                                                name="vehicle_registration_no"
                                                value="{{ $maintenance->getVehicle->vehicle_registration_no }}" required
                                                readonly>
                                            <input type="hidden" class="form-control" id="vehicle_reg_id"
                                                name="vehicle_reg_id" value="{{ $maintenance->getVehicle->vehicle_id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="odo_meter">OdoMeter(km)<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="number" class="form-control" id="odo_meter" name="odo_meter"
                                                value="{{ $maintenance->odo_meter }}" required>
                                            <span id="odo-meter-error" class="text-danger d-none">
                                                Odometer reading must be less than Next Service
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="next_service">Next Service(km)<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="number" class="form-control" id="next_service" name="next_service"
                                                value="{{ $maintenance->next_service }}" required>
                                            <span id="next-service-error" class="text-danger d-none">
                                                Next Service reading must be greater than Odometer
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="mt-4">Repair/Service Completed</h3>
                                <hr>
                                <div id="maintenance-area">
                                    @foreach ($maintenance->getMaintenanceTypeDetails as $type)
                                        <div class="maintenance-types @if (!$loop->first) mt-3 @endif">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Maintenance Type<span aria-hidden="true"
                                                                class="required">*</span></label>
                                                        <select required id="maintenance_type[]" name="maintenance_type[]"
                                                            class="form-control">
                                                            @foreach ($types as $maintenance_type)
                                                                <option
                                                                    value="{{ $maintenance_type->maintenance_type_id }}"
                                                                    @if ($type->maintenance_type_id == $maintenance_type->maintenance_type_id) selected @endif>
                                                                    {{ $maintenance_type->maintenance_type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Labour time taken in minutes<span aria-hidden="true"
                                                                class="required">*</span></label>
                                                        <input type="number" step="any" required class="form-control"
                                                            id="labour_time[]" name="labour_time[]"
                                                            value="{{ $type->labour }}"
                                                            placeholder="Labour time taken in minutes">
                                                    </div>
                                                </div>
                                                <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                    <i class="fa fa-minus-circle fa-2x text-primary cursor-pointer"
                                                        onclick="removeMaintenance(this)" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div id="maintenance-item-area">
                                                @foreach ($type->maintenance_type_item as $item)
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Parts used<span aria-hidden="true"
                                                                        class="required">*</span></label>
                                                                <input type="text" required
                                                                    name="m_part_used[{!! $loop->parent->index !!}][]"
                                                                    id="m_part_used[]" class="form-control"
                                                                    value="{{ $item->parts_used }}" placeholder="Part #">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>RRP ($)<span aria-hidden="true"
                                                                        class="required">*</span></label>
                                                                <input type="number" step="0.01" required
                                                                    class="form-control" id="m_rrp[]"
                                                                    value="{{ $item->rrp }}"
                                                                    name="m_rrp[{!! $loop->parent->index !!}][]"
                                                                    placeholder="RRP ($)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>Qty<span aria-hidden="true"
                                                                        class="required">*</span></label>
                                                                <input type="number" step="any" required
                                                                    class="form-control" id="m_qty[]"
                                                                    value="{{ $item->quantity }}"
                                                                    name="m_qty[{!! $loop->parent->index !!}][]"
                                                                    placeholder="Qty">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Invoice<span aria-hidden="true"
                                                                        class="required">*</span></label>
                                                                <input type="number" step="0.01" required
                                                                    value="{{ $item->rrp * $item->quantity }}"
                                                                    class="form-control" readonly id="m_invoice[]"
                                                                    placeholder="Invoice">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-md-1 d-flex justify-content-center align-items-center">
                                                            <i class="fa fa-minus-circle text-primary cursor-pointer"
                                                                onclick="removeMaintenanceItem(this)"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-right invoice-border">
                                                    <button type="button" class="btn btn-primary my-3"
                                                        id="add-maintenance-item" onclick="addMaintenanceItem(this)">Add
                                                        Maintenance Item</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="form-group">
                                            <label>Start time - End time<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type='text' class="form-control datetimes" data-value="{{ $maintenance->start_time }} - {{ $maintenance->end_time }}"
                                                name="maintenance_time" />
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="d-flex align-items-center justify-content-center">
                                                <strong> Total Repair Cost: </strong><span id="total-repair-time"
                                                    class="mx-1">0</span>
                                            </span>
                                            <button type="button" class="btn btn-primary" id="add-maintenance"
                                                onclick="addMaintenance()">Add Maintenance</button>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <h3 class="mt-4">Workshop Job Log</h3>
                                <hr>
                                <div id="workshop-area">
                                    @php
                                        $allWorkshopsTotal = 0;
                                    @endphp
                                    @foreach ($maintenance->getWorkshopDetails as $getWorkshopDetail)
                                        @php
                                            $totalWorkshopInvoice = 0;
                                        @endphp
                                        <div class="card inverted-box-shadow p-3">
                                            <div class="workshops">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Workshop<span aria-hidden="true"
                                                                    class="required">*</span></label>
                                                            <select required name="workshop_id[]" class="form-control">
                                                                <option value="">Select Workshop</option>
                                                                @foreach ($workshops as $workshop)
                                                                    <option value="{{ $workshop->workshop_id }}"
                                                                        @if ($getWorkshopDetail->workshop_id == $workshop->workshop_id) selected @endif>
                                                                        {{ $workshop->workshop_name }}</option>
                                                                    {{ $workshop->workshop_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-5'>
                                                        <div class="form-group">
                                                            <label>Clock On - Clock Off<span aria-hidden="true"
                                                                    class="required">*</span></label>
                                                            <input type='text' class="form-control datetimes" data-value="{{ $getWorkshopDetail->clock_on }} - {{ $getWorkshopDetail->clock_off }}"
                                                                name="workshop_time[]" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex justify-content-end align-items-center">
                                                        <i class="fa fa-minus-circle fa-2x text-primary cursor-pointer"
                                                            onclick="removeWorkshop(this)" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <div id="workshop-item-area">
                                                    @foreach ($getWorkshopDetail->getMaintenanceWorkshopItems as $getWorkshopItem)
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Parts used<span aria-hidden="true"
                                                                            class="required">*</span></label>
                                                                    <input type="text" required id="part_used[]"
                                                                        name="part_used[]" class="form-control"
                                                                        value="{{ $getWorkshopItem->parts_used }}"
                                                                        placeholder="Part #">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>RRP ($)<span aria-hidden="true"
                                                                            class="required">*</span></label>
                                                                    <input type="number" step="0.01" required
                                                                        class="form-control" id="rrp[]"
                                                                        name="rrp[]"
                                                                        value="{{ $getWorkshopItem->rrp }}"
                                                                        placeholder="RRP ($)">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Qty<span aria-hidden="true"
                                                                            class="required">*</span></label>
                                                                    <input type="number" step="any" required
                                                                        class="form-control" id="qty[]"
                                                                        name="qty[]"
                                                                        value="{{ $getWorkshopItem->quantity }}"
                                                                        placeholder="Qty">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Invoice<span aria-hidden="true"
                                                                            class="required">*</span></label>
                                                                    <input type="number" step="0.01" required
                                                                        class="form-control" readonly id="invoice[]"
                                                                        value="{{ $getWorkshopItem->rrp * $getWorkshopItem->quantity }}"
                                                                        placeholder="Invoice">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-1 d-flex justify-content-center align-items-center">
                                                                <i class="fa fa-minus-circle text-primary cursor-pointer"
                                                                    onclick="removeWorkshopItem(this)"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $totalWorkshopInvoice +=
                                                                $getWorkshopItem->rrp * $getWorkshopItem->quantity;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-right invoice-border">
                                                        <button type="button" class="btn btn-primary my-3"
                                                            id="add-workshop-item" onclick="addWorkshopItem(this)">Add
                                                            Workshop Item</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row invoice-border align-items-center">
                                                <div class="col-md-6">
                                                    <div class="d-flex justify-content-start">
                                                        <span class="d-flex align-items-center justify-content-center">
                                                            <strong> Workshop Invoice: </strong><span
                                                                id="workshop-invoice[]"
                                                                class="mx-1">${{ $totalWorkshopInvoice }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $allWorkshopsTotal += $totalWorkshopInvoice;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="d-flex align-items-center justify-content-center">
                                                <strong> All Workshops Total: </strong><span id="all-workshops-total"
                                                    class="mx-1">${{ $allWorkshopsTotal }}</span>
                                            </span>
                                            <button type="button" class="btn btn-primary" id="add-workshop"
                                                onclick="addWorkshop()">Add Workshop</button>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
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
            addMaintenanceEventListeners();
            addWorkshopEventListeners();
            reIndexWorkshops();
            calculateMaintenanceCost();
        });
        $('#odo_meter, #next_service').on('change', function() {
            ServiceKMCheck(this);
        });
    </script>
@endsection
