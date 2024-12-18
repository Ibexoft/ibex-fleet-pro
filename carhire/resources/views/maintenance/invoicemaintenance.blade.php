@extends('layouts.app')

@section('admincontent')
    <br><br>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }
    </style>


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Maintenance Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active">Date: <span>{{$maintenance->created_at}}</span></li> --}}
                    </ol>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm adj-sm-icon">
                                <i class="fas fa-arrow-left mr-1"></i>
                            </button>
                        </div>
                        <div class="col-12 col-md-8 text-right">
                            @if (Auth::user()->hasPermissionTo('edit-maintenance'))
                                @if ($maintenance->job_status == 1)
                                    <a href="{{ route('maintenance.process', $maintenance->id) }}"
                                        class="btn btn-outline-primary btn-sm sm">
                                        <span>
                                            <i class="fas fa-wrench"></i>
                                            Process Maintenance
                                        </span>
                                    </a>
                                @endif
                                <a href="
                                @if ($maintenance->job_status == 1) {{ route('maintenance.edit', $maintenance->id) }}
                                @else
                                    {{ route('maintenance.edit-processed', $maintenance->id) }} @endif"
                                    class="btn btn-outline-primary btn-sm sm adj-sm-icon">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="maintenance-show-card">

                <div class="row">
                    <div class="col-12 col-md-12 @if ($maintenance->job_status == 1) col-lg-12 @else col-lg-6 @endif">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h4 class="dashboard-title mb-0">Maintenance</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Vehicle:</div>
                                            <div class="data-value">{{ $maintenance->getVehicle->vehicle_registration_no }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Driver:</div>
                                            <div class="data-value">{{ $maintenance->getDriver->first_name }}
                                                {{ $maintenance->getDriver->last_name }}</div>
                                        </div>
                                    </div>
                                    @if ($maintenance->job_status == 2)
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
                                    @endif
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Maintenance Scheduled:</div>
                                            <div class="data-value">
                                                {{ date('d-m-Y', strtotime($maintenance->maintenance_date)) }}</div>
                                        </div>
                                    </div>
                                    @if ($maintenance->start_time)
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="profile-data">
                                                <div class="data-key">Start Time:</div>
                                                <div class="data-value">
                                                    {{ date('d-m-Y h:i A', strtotime($maintenance->start_time)) }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($maintenance->end_time)
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="profile-data">
                                                <div class="data-key">End Time:</div>
                                                <div class="data-value">
                                                    {{ date('d-m-Y h:i A', strtotime($maintenance->end_time)) }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($maintenance->comments)
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="profile-data">
                                                <div class="data-key">Comments :</div>
                                                <div class="data-value">{{ $maintenance->comments }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Job Status:</div>
                                            <div class="data-value">
                                                @if ($maintenance->job_status == 1)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($maintenance->job_status == 2)
                                                    <span class="badge badge-success">Completed</span>
                                                @else
                                                    <span class="badge badge-danger">Cancelled</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Paid By:</div>
                                            <div class="data-value">{{ $owner->c_first_name }} @if ($owner->c_last_name != null){{ $owner->c_last_name }}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($maintenance->job_status == 2)
                        <div class="col-12 col-md-12 col-lg-6">
                            @if ($maintenance->getMaintenanceTypeDetails)
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="dashboard-title mb-0">Repairs/Services</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="service_accordion">
                                            @php $totalCost = 0; @endphp
                                            @foreach ($maintenance->getMaintenanceTypeDetails as $maintenanceType)
                                                <div class="card">
                                                    <div class="card-header" id="maintenance_{{ $maintenanceType->id }}"
                                                        data-target="#maintenance_{{ $maintenanceType->id }}_heading"
                                                        data-toggle="collapse" aria-expanded="true"
                                                        aria-controls="maintenance_{{ $maintenanceType->id }}_heading">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" type="button">
                                                                <span class="text-primary">
                                                                    {{ $maintenanceType->maintenance_type->maintenance_type_name }} </span>
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="maintenance_{{ $maintenanceType->id }}_heading" class="collapse"
                                                        aria-labelledby="{{ $maintenanceType->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12 col-lg-12">
                                                                    <div class="profile-data">
                                                                        <div class="data-key">Labour Time taken:</div>
                                                                        <div
                                                                            class="data-value
                                                                        ">
                                                                            {{ $maintenanceType->labour}} minutes
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 col-lg-12 mt-3">
                                                                    <table class="table table-bordered">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Parts Used</th>
                                                                                <th>RRP ($)</th>
                                                                                <th>Quantity</th>
                                                                                <th>Total ($)</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @php
                                                                                $total = 0;
                                                                            @endphp
                                                                            @foreach ($maintenanceType->maintenance_type_item as $item)
                                                                                @php
                                                                                    $total +=
                                                                                        $item->rrp * $item->quantity;
                                                                                @endphp
                                                                                <tr>
                                                                                    <td>{{ $item->parts_used }}</td>
                                                                                    <td>${{ $item->rrp }}</td>
                                                                                    <td>{{ $item->quantity }}</td>
                                                                                    <td>${{ $item->rrp * $item->quantity }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <tfoot class="invoice-border">
                                                                            <tr>
                                                                                <td colspan="3" class="text-right">
                                                                                    Total</td>
                                                                                <td>${{ $total }}
                                                                                </td>
                                                                            </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $totalCost += $total;
                                                @endphp
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="profile-data">
                                                    <div class="data-key">Start Time:</div>
                                                    <div
                                                        class="data-value
                                                    ">
                                                        {{ date('d-m-Y h:i A', strtotime($maintenance->start_time)) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="profile-data">
                                                    <div class="data-key">End Time:</div>
                                                    <div
                                                        class="data-value
                                                    ">
                                                        {{ date('d-m-Y h:i A', strtotime($maintenance->end_time)) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="profile-data">
                                                    <div class="data-key">Overall Cost:</div>
                                                    <div
                                                        class="data-value
                                                    ">
                                                    {{-- TOTAL: (Total Labour x $55/hr) + Total Parts Used --}} 
                                                    ${{ number_format(($totalCost + ($maintenance->getMaintenanceTypeDetails->sum('labour') * 0.91666667)), 2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($maintenance->getWorkshopDetails)
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="dashboard-title mb-0">Workshop Jobs</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="workshop_accordion">
                                            <!-- Role -->
                                            @foreach ($maintenance->getWorkshopDetails as $workshop)
                                                <div class="card">
                                                    <div class="card-header" id="workshop_{{ $workshop->id }}"
                                                        data-target="#workshop_{{ $workshop->id }}_heading"
                                                        data-toggle="collapse" aria-expanded="true"
                                                        aria-controls="workshop_{{ $workshop->id }}_heading">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" type="button">
                                                                <span class="text-primary">
                                                                    {{ $workshop->getWorkshops->workshop_name }} </span>
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="workshop_{{ $workshop->id }}_heading" class="collapse"
                                                        aria-labelledby="{{ $workshop->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-12 col-lg-12">
                                                                    <div class="profile-data">
                                                                        <div class="data-key">Clock On:</div>
                                                                        <div
                                                                            class="data-value
                                                                        ">
                                                                            {{ date('d-m-Y h:i A', strtotime($workshop->clock_on)) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 col-lg-12">
                                                                    <div class="profile-data">
                                                                        <div class="data-key">Clock Off:</div>
                                                                        <div
                                                                            class="data-value
                                                                        ">
                                                                            {{ date('d-m-Y h:i A', strtotime($workshop->clock_off)) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-12 col-lg-12 mt-3">
                                                                    <table class="table table-bordered">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Parts Used</th>
                                                                                <th>RRP ($)</th>
                                                                                <th>Quantity</th>
                                                                                <th>Total ($)</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @php
                                                                                $total = 0;
                                                                            @endphp
                                                                            @foreach ($workshop->getMaintenanceWorkshopItems as $item)
                                                                                @php
                                                                                    $total +=
                                                                                        $item->rrp * $item->quantity;
                                                                                @endphp
                                                                                <tr>
                                                                                    <td>{{ $item->parts_used }}</td>
                                                                                    <td>${{ $item->rrp }}</td>
                                                                                    <td>{{ $item->quantity }}</td>
                                                                                    <td>${{ $item->rrp * $item->quantity }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <tfoot class="invoice-border">
                                                                            <tr>
                                                                                <td colspan="3" class="text-right">
                                                                                    Total</td>
                                                                                <td>${{ $total }}
                                                                                </td>
                                                                            </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>


            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

<style>
    .table .thead-dark th {
        background-color: #111111 !important;
        color: #fff;
    }
</style>
