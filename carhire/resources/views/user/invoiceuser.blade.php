@extends('layouts.app')

@section('admincontent')
    <section class="content-header mb-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1>User Details</h1>
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
                            @if (Auth::user()->hasPermissionTo('edit-user'))
                                <a href="{{ route('user.edit', $user->id) }}"
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
                            <div class="card-header">
                                <h4 class="dashboard-title">User</h4>
                            </div>
                        </div>
                        <div class="card-body custom-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Name:</div>
                                        <div class="data-value">{{ $user->name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Email:</div>
                                        <div class="data-value">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Role:</div>
                                        <div class="data-value">{{ $role->name }}</div>
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
