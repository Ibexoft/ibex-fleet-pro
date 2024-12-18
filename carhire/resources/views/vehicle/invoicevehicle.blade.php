@extends('layouts.app')

@section('admincontent')
    <section class="content-header mb-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1>Vehicle Details</h1>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                                <i class="fas fa-arrow-left mr-1"></i>
                            </button>
                        </div>
                        <div class="col-12 col-md-8">
                            <ul class="navbar-nav btn-list">
                                @if ($vehicle->is_active == 1 && $vehicle->is_deleted == 0)
                                    @if (Auth::user()->hasPermissionTo('create-booking'))
                                        <li class="nav-item">
                                            <a class="btn btn-outline-primary btn-sm sm"
                                                href="{{ route('booking.create', $vehicle->vehicle_id) }}">
                                                <span>
                                                    <i class="fas fa-plus-circle mr-1"></i>
                                                    Booking
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasPermissionTo('create-insurance'))
                                        <li class="nav-item">
                                            <a class="btn btn-outline-primary btn-sm sm"
                                                href="{{ route('insurance.create', $vehicle->vehicle_id) }}">
                                                <span>
                                                    <i class="fas fa-plus-circle mr-1"></i>
                                                    Insurance
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasPermissionTo('create-maintenance'))
                                        <li class="nav-item">
                                            <a class="btn btn-outline-primary btn-sm sm"
                                                href="{{ route('maintenance.create', $vehicle->vehicle_id) }}">
                                                <span>
                                                    <i class="fas fa-plus-circle mr-1"></i>
                                                    Maintenance
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasPermissionTo('create-tracking'))
                                        <li class="nav-item">
                                            @if (isset($tracking))
                                                <button class="btn btn-outline-primary btn-sm sm" disabled>
                                                    <span>
                                                        <i class="fas fa-plus-circle mr-1"></i>
                                                        Tracker
                                                    </span>
                                                </button>
                                            @else
                                                <a class="btn btn-outline-primary btn-sm sm"
                                                    href="{{ route('tracking.create', $vehicle->vehicle_id) }}">
                                                    <span>
                                                        <i class="fas fa-plus-circle mr-1"></i>
                                                        Tracker
                                                    </span>
                                                </a>
                                            @endif
                                        </li>
                                    @endif
                                @endif
                                <li class="nav-item">
                                    @if (Auth::user()->hasPermissionTo('edit-vehicle') && $vehicle->is_deleted == 0)
                                        <a class="btn btn-outline-primary btn-sm sm adj-sm-icon"
                                            href="{{ route('vehicle.edit', $vehicle->vehicle_id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="dashboard-title">Vehicle</h4>
                                <form action="{{ route('vehicle.toggleSellStatus', $vehicle->vehicle_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm sm adj-sm-icon">
                                        @if ($vehicle->sell_status)
                                            <i class="fas fa-times"></i> Mark as Not Sold
                                        @else
                                            <i class="fas fa-check"></i> Mark as Sold
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Make:</div>
                                        <div class="data-value">{{ $brand->name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Vehicle Owner:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_owner->c_first_name }} @if ($vehicle->vehicle_owner->c_last_name != null)
                                                {{ $vehicle->vehicle_owner->c_last_name }}
                                            @endif
                                            @if ($vehicle->vehicle_owner->entity_type == 'Trust')
                                                @if ($vehicle->vehicle_owner->company != null)
                                                    ( C-{{ $vehicle->vehicle_owner->getCompany->c_first_name }} )
                                                @else
                                                    ( I-{{ $vehicle->vehicle_owner->contactPerson->c_first_name }}
                                                    {{ $vehicle->vehicle_owner->contactPerson->c_last_name ?? '' }} )
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Registration No:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_registration_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Model:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_model }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">VIN:</div>
                                        <div class="data-value">{{ $vehicle->vin }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Engine No:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_engine_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Type:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_type }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Year:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_year }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Color:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_color }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">BPAY Biller Code:</div>
                                        <div class="data-value">{{ $vehicle->biller_code }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">BPAY Reference No:</div>
                                        <div class="data-value">{{ $vehicle->reference_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Weekly Rent:</div>
                                        <div class="data-value">${{ number_format($vehicle->admin_fee, 2) }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Vehicle Type:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_status }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Fuel Type:</div>
                                        <div class="data-value">{{ $vehicle->fuel_type }}</div>
                                    </div>
                                </div>
                                <div iv class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Road Status:</div>
                                        <div class="data-value">
                                            @if ($vehicleStatus == 'Rented')
                                                <div class="badge badge-danger">
                                                    On Road
                                                </div>
                                            @endif
                                            @if ($vehicleStatus == 'Maintenance' || $vehicleStatus == 'Available')
                                                <div class="badge badge-secondary">
                                                    Off Road
                                                </div>
                                            @endif
                                            @if ($vehicle->sell_status == 1)
                                                <div class="badge badge-warning">
                                                    Sold
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        @if (isset($insurance))
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h4 class="dashboard-title mb-0">Insurance</h4>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <a href="{{ route('insurance.show', $insurance->insurance_id) }}"
                                                class="btn btn-outline-primary sm adj-sm-icon">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Insurance Company:</div>
                                            <div class="data-value">{{ $incompany->icompany_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Policy Number:</div>
                                            <div class="data-value">{{ $insurance->policy_number }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">
                                                <span>Insurance Premium:</span>
                                            </div>
                                            <div class="data-value">
                                                <span>${{ number_format($insurance->insurance_premium, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">
                                                <span>Premium Direct Debit:</span>
                                            </div>
                                            <div class="data-value">
                                                <span>{{ $insurance->ins_prem_direct_debit }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Start Date:</div>
                                            <div class="data-value">
                                                {{ date('d-m-Y', strtotime($insurance->insurance_start_date)) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">End Date:</div>
                                            <div class="data-value">
                                                {{ date('d-m-Y', strtotime($insurance->insurance_end_date)) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="dashboard-title">Insurance</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body placeholder">
                                This vehicle is not Insured.
                            </div>
                        @endif
                    </div>
                    <div class="card">
                        @if (isset($tracking))
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h4 class="dashboard-title mb-0">Tracker</h4>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <a href="{{ route('tracking.show', $tracking->tracking_id) }}"
                                                class="btn btn-outline-primary sm adj-sm-icon">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Name:</div>
                                            <div class="data-value">{{ $tracking->tracker_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">IMEI Number:</div>
                                            <div class="data-value">{{ $tracking->tracker_imei }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Cell Provider:</div>
                                            <div class="data-value">{{ $tracking->cell_provider }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Telephone:</div>
                                            <div class="data-value">{{ $tracking->mobile_no }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">ICCID Number:</div>
                                            <div class="data-value">{{ $tracking->iccid_no }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card-header">
                                <h4 class="dashboard-title">Tracker</h4>
                            </div>
                            <div class="card-body placeholder">
                                Tracker is not installed.
                            </div>
                        @endif
                    </div>
                    <div class="card">
                        @if (isset($maintenance))
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h4 class="dashboard-title mb-0">Maintenance</h4>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <a href="{{ route('maintenance.show', $maintenance->id) }}"
                                                class="btn btn-outline-primary sm adj-sm-icon">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Vehicle Registration:</div>
                                            <div class="data-value">{{ $vehicle->vehicle_registration_no }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Driver:</div>
                                            <div class="data-value">{{ $maintenance->getDriver->first_name }}
                                                {{ $maintenance->getDriver->last_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">OdoMeter :</div>
                                            <div class="data-value">{{ $maintenance->odo_meter }} km</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Next Service :</div>
                                            <div class="data-value">{{ $maintenance->next_service }} km</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Maintenance Scheduled:</div>
                                            <div class="data-value">
                                                {{ date('d-m-Y', strtotime($maintenance->maintenance_date)) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Comments :</div>
                                            <div class="data-value">{{ $maintenance->comments }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Job Status:</div>
                                            <div class="data-value">
                                                @if ($maintenance->job_status == 1)
                                                    Pending
                                                @elseif($maintenance->job_status == 2)
                                                    Completed
                                                @else
                                                    In Progress
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Paid By:</div>
                                            <div class="data-value">
                                                {{ $vehicle->vehicle_owner->c_first_name }} @if ($vehicle->vehicle_owner->c_last_name != null)
                                                    {{ $vehicle->vehicle_owner->c_last_name }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card-header">
                                <h4 class="dashboard-title">Maintenance</h4>
                            </div>
                            <div class="card-body placeholder">
                                No maintenance applicable for now.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{--  --}}
@endsection

<style>
    .table .thead-dark th {
        background-color: #111111 !important;
        color: #fff;
    }
</style>
