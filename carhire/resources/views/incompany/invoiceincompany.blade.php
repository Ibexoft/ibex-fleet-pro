@extends('layouts.app')

@section('admincontent')
    <section class="content-header mb-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1>Insurance Company Details</h1>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-6">
                            <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                                <i class="fas fa-arrow-left mr-1"></i>
                            </button>
                        </div>
                        <div class="col-6 col-md-6 text-right">
                            @if (Auth::user()->hasPermissionTo('edit-insurance-company'))
                                <a href="{{ route('insurance-company.edit', $incomapny->ic_id) }}"
                                    class="btn btn-outline-primary btn-sm sm adj-sm-icon">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            @endif
                        </div>
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
                            <h4 class="dashboard-title">Insurance Company</h4>
                        </div>
                        <div class="card-body custom-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Company Name:</div>
                                        <div class="data-value">{{ $incomapny->icompany_name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Telephone:</div>
                                        <div class="data-value">{{ $incomapny->icompany_reg_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Company Address:</div>
                                        <div class="data-value">{{ $incomapny->icompany_address }}</div>
                                    </div>
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
