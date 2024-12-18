@extends('layouts.app')
@section('admincontent')
    <!-- Content Header (Page header) -->
    <section class="content-header mb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1>Driver Profile</h1>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 col-md-6">
                            <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                                <i class="fas fa-arrow-left mr-1"></i>
                            </button>
                        </div>
                        <div class="col-8 col-md-6">
                            <ul class="navbar-nav btn-list right">
                                <li class="nav-item">
                                    <a target="_blank" type="button" href="{{ route('driver.print', $id) }}"
                                        class="btn btn-outline-primary btn-sm sm">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    @if (Auth::user()->hasPermissionTo('edit-driver') && $driver->is_deleted == 0)
                                        <a class="btn btn-outline-primary btn-sm sm" href="{{ route('driver.edit', $id) }}">
                                            <i class="fas fa-pencil-alt"></i>
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (empty($driver->driver_image))
                                    <div class="driver-image-wrapper">
                                        <img src="{{ asset('panelslayout/dist/img/driver-placeholder.png') }}"
                                            alt="User profile placeholder">
                                    </div>
                                @else
                                    <div class="driver-image-wrapper">
                                        <img src="{{ asset('') . $driver->driver_image }}" alt="User profile picture">
                                    </div>
                                @endif
                            </div>

                            <h3 class="profile-username text-center driver-name">
                                {{ $driver->first_name }} {{ $driver->last_name }}</h3>

                            <p class="text-muted text-center driver-email">{{ $driver->email }}</p>

                            <ul class="list-group list-group-unbordered left-card mb-3">
                                <li class="list-group-item">
                                    <b>Date of Birth</b> <a class="float-right">
                                        @if (empty($driver->dob))
                                            N/A
                                        @else
                                            {{ date('d-m-Y', strtotime($driver->dob)) }}
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Telephone</b> <a class="float-right">
                                        @if (empty($driver->contact))
                                            N/A
                                        @else
                                            {{ $driver->contact }}
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b>
                                    <div class="address-data">
                                        <div class="address-container">
                                            <div class="left">
                                                <span>Street Address</span>
                                            </div>
                                            <div class="right">
                                                <span>
                                                    @if (empty($driver->street))
                                                        N/A
                                                    @else
                                                        {{ $driver->street }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="address-container">
                                            <div class="left">
                                                <span>Suburb</span>
                                            </div>
                                            <div class="right">
                                                <span>
                                                    @if (empty($driver->suburb))
                                                        N/A
                                                    @else
                                                        {{ $driver->suburb }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="address-container">
                                            <div class="left">
                                                <span>Postal Code</span>
                                            </div>
                                            <div class="right">
                                                <span>
                                                    @if (empty($driver->postal_code))
                                                        N/A
                                                    @else
                                                        {{ $driver->postal_code }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="address-container">
                                            <div class="left">
                                                <span>State</span>
                                            </div>
                                            <div class="right">
                                                <span>
                                                    @if (empty($driver->state))
                                                        N/A
                                                    @else
                                                        {{ $driver->state }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="address-container">
                                            <div class="left">
                                                <span>Country</span>
                                            </div>
                                            <div class="right">
                                                <span>
                                                    @if (empty($countries->country_name))
                                                        N/A
                                                    @else
                                                        {{ $countries->country_name }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <!-- <a target="_blank" type="button" href="{{ url('/print-driver-profile') }}/{{ $id }}" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a> -->
                                    <!-- <a class="nav-link active" href="#activity" data-toggle="tab"> Driving Detail</a> -->
                                </li>
                                <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                                                                                          <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="profile-data">
                                                <div class="data-key">Driver's Licence Number:</div>
                                                <div class="data-value">
                                                    @if (empty($driver->driver_license_no))
                                                        N/A
                                                    @else
                                                        {{ $driver->driver_license_no }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="profile-data">
                                                <div class="data-key">Driver's Licence State:</div>
                                                <div class="data-value">
                                                    @if (empty($driver->driver_license_state))
                                                        N/A
                                                    @else
                                                        {{ $driver->driver_license_state }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="profile-data">
                                                <div class="data-key">Driver's Licence Expiration Date:</div>
                                                <div class="data-value">
                                                    @if (empty($driver->license_expiry_date))
                                                        N/A
                                                    @else
                                                        {{ date('d-m-Y', strtotime($driver->license_expiry_date)) }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <h4 class="doc-title">
                                                    @if (empty($driver->p_m_value))
                                                        Passport
                                                    @else
                                                        {{ $driver->p_m_value }}
                                                    @endif
                                                    <h4>
                                                        <div class="doc-img">
                                                            @if (empty($driver->p_m_image))
                                                                <img src="{{ asset('panelslayout/dist/img/passport-placeholder-1.png') }}"
                                                                    class="no-print" alt="Passport-placeholder">
                                                            @else
                                                                @if (pathinfo($driver->p_m_image, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset('') . $driver->p_m_image }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                                            alt="pdf">
                                                                    </a>
                                                                @else
                                                                    <a href="{{ asset('') . $driver->p_m_image }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('') . $driver->p_m_image }}"
                                                                            alt="Passport-placeholder">
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </div>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <h4 class="doc-title">Driver Licence</h4>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <div class="doc-img">
                                                            @if (empty($driver->license_front_image))
                                                                <img src="{{ asset('panelslayout/dist/img/license-front.png') }}"
                                                                    alt="Licence-front">
                                                            @else
                                                                @if (pathinfo($driver->license_front_image, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset('') . $driver->license_front_image }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                                            alt="pdf">
                                                                    </a>
                                                                @else
                                                                    {{-- <img src="{{ asset('') . $driver->license_front_image }}"
                                                                        alt="Licence-front"> --}}
                                                                    <a href="{{ asset('') . $driver->license_front_image }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('') . $driver->license_front_image }}"
                                                                            alt="Licence-front">
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <div class="doc-img">
                                                            @if (empty($driver->license_back_image))
                                                                <img src="{{ asset('panelslayout/dist/img/license-back.png') }}"
                                                                    alt="Licence-back">
                                                            @else
                                                                @if (pathinfo($driver->license_back_image, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset('') . $driver->license_back_image }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                                            alt="pdf">
                                                                    </a>
                                                                @else
                                                                    {{-- <img src="{{ asset('') . $driver->license_back_image }}"
                                                                            alt="Licence-back"> --}}
                                                                    <a href="{{ asset('') . $driver->license_back_image }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('') . $driver->license_back_image }}"
                                                                            alt="Licence-back">
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.post -->
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
