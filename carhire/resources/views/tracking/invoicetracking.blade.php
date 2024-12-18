@extends('layouts.app')

@section('admincontent')

<section class="content-header mb-0 pb-0">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h1>Tracker Details</h1>  
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                    </button>
                    @if (Auth::user()->hasPermissionTo('edit-tracking'))
                    <a href="{{ route('tracking.edit', $tracking->tracking_id) }}" class="btn btn-outline-primary btn-sm sm">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    @endif
            </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="dashboard-title">Tracker</h4>
                    </div>
                    <div class="card-body custom-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="profile-data">
                                    <div class="data-key">Name:</div>
                                    <div class="data-value">{{$tracking->tracker_name}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="profile-data">
                                    <div class="data-key">IMEI Number:</div>
                                    <div class="data-value">{{$tracking->tracker_imei}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="profile-data">
                                    <div class="data-key">Cell Provider:</div>
                                    <div class="data-value">{{$tracking->cell_provider}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="profile-data">
                                    <div class="data-key">Mobile No:</div>
                                    <div class="data-value">{{$tracking->mobile_no}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="profile-data">
                                    <div class="data-key">ICCID Number:</div>
                                    <div class="data-value">{{$tracking->iccid_no}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="profile-data">
                                    <div class="data-key">Vehicle:</div>
                                    <div class="data-value">{{$vehicle->vehicle_registration_no}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

