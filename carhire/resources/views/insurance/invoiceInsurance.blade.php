@extends('layouts.app')

@section('admincontent')
    <section class="content-header mb-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1>Insurance Details</h1>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                            <i class="fas fa-arrow-left mr-1"></i>
                        </button>
                        @if (Auth::user()->hasPermissionTo('edit-insurance'))
                            <a href="{{ route('insurance.edit', $insurance->insurance_id) }}"
                                class="btn btn-outline-primary btn-sm sm">
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
                            <h4 class="dashboard-title">Insurance</h4>
                        </div>
                        <div class="card-body custom-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Vehicle Registration:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ $vehicle->vehicle_registration_no }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Vehicle Owner:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ $customer->c_first_name }} @if ($customer->c_last_name != null){{ $customer->c_last_name }} @endif</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Insurance Company:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ $incompany->icompany_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Policy Number:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ $insurance->policy_number }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Insurance Premium:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ $insurance->insurance_premium }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Insurance Premium Direct Debit:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ $insurance->ins_prem_direct_debit }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Insurance Start Date:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ date('d-m-Y', strtotime($insurance->insurance_start_date)) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Insurance End Date:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ date('d-m-Y', strtotime($insurance->insurance_end_date)) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            <span>Account Name:</span>
                                        </div>
                                        <div class="data-value">
                                            <span>{{ $insurance->account_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if ($insurance->account_no)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">
                                                <span>Account Number:</span>
                                            </div>
                                            <div class="data-value">
                                                <span>{{ $insurance->account_no }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($insurance->bsb)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">
                                                <span>BSB:</span>
                                            </div>
                                            <div class="data-value">
                                                <span>{{ $insurance->bsb }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($insurance->four_digit)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">
                                                <span>Four Digit Code:</span>
                                            </div>
                                            <div class="data-value">
                                                <span>{{ $insurance->four_digit }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
