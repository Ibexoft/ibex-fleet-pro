@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Add Role</h1>

                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- left column -->

                <div class="col-md-12">

                    <!-- jquery validation -->

                    <div class="card card-primary">
                        <!-- /.card-header -->

                        <!-- form start -->

                        <form method="POST" action="{{ route('role.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName1">Name<span aria-hidden="true"
                                            class="required">*</span></label>
                                    <input value="{{ old(' name ') }}" id="name" type="text" name="name" required
                                        class="form-control" id="exampleInputName1" placeholder="Enter Name">
                                </div>
                                <div class="row">

                                </div>
                                <div class="row bb-1 align-items-center">
                                    <div class="col-12 col-md-9">
                                        <label for="exampleInputName1">Permissions<span aria-hidden="true"
                                                class="required">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <div class="switchbox-wrapper">
                                                <div class="switchbox-text">Select All</div>
                                                <div class="custom-control custom-switch">
                                                    <input class="custom-control-input" type="checkbox" name="toggle-btn"
                                                         id="toggle-btn" onclick="toggleAllRoles()">
                                                    <label for="toggle-btn" class="custom-control-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="accordion">
                                    <!-- Role -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne" data-toggle="collapse"
                                        data-target="#role" aria-expanded="true" aria-controls="role">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Role
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="role" class="collapse" aria-labelledby="headingOne">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_role" value=1 id="view_role">
                                                                    <label for="view_role"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_role" value=1 id="create_role">
                                                                    <label for="create_role"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_role" value=1 id="edit_role">
                                                                    <label for="edit_role"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_role" value=1 id="delete_role">
                                                                    <label for="delete_role"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Vehicle -->
                                    <div class="card">
                                            <div class="card-header" id="headingTwo" data-toggle="collapse"
                                            data-target="#vehicle" aria-expanded="true" aria-controls="vehicle">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button">
                                                    Vehicle
                                                    </button>
                                                </h5>
                                            </div>
                                        </button>

                                        <div id="vehicle" class="collapse" aria-labelledby="headingTwo">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_vehicle" value=1 id="view_vehicle">
                                                                    <label for="view_vehicle"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_vehicle" value=1 id="create_vehicle">
                                                                    <label for="create_vehicle"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_vehicle" value=1 id="edit_vehicle">
                                                                    <label for="edit_vehicle"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_vehicle" value=1 id="delete_vehicle">
                                                                    <label for="delete_vehicle"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fine -->
                                    <div class="card">
                                        <div class="card-header" id="headingThree"  data-toggle="collapse"
                                        data-target="#fine" aria-expanded="true" aria-controls="fine">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Fine
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="fine" class="collapse" aria-labelledby="headingThree">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_fine" value=1 id="view_fine">
                                                                    <label for="view_fine"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_fine" value=1 id="create_fine">
                                                                    <label for="create_fine"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_fine" value=1 id="edit_fine">
                                                                    <label for="edit_fine"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_fine" value=1 id="delete_fine">
                                                                    <label for="delete_fine"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Insurance-Company -->
                                    <div class="card">
                                        <div class="card-header" id="headingFour" data-toggle="collapse"
                                        data-target="#insurance-company" aria-expanded="true"
                                        aria-controls="insurance-company">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Insurance Company
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="insurance-company" class="collapse" aria-labelledby="headingFour">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_insurance-company" value=1
                                                                        id="view_insurance-company">
                                                                    <label for="view_insurance-company"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_insurance-company" value=1
                                                                        id="create_insurance-company">
                                                                    <label for="create_insurance-company"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_insurance-company" value=1
                                                                        id="edit_insurance-company">
                                                                    <label for="edit_insurance-company"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_insurance-company" value=1
                                                                        id="delete_insurance-company">
                                                                    <label for="delete_insurance-company"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- User -->
                                    <div class="card">
                                        <div class="card-header" id="headingFive" data-toggle="collapse"
                                        data-target="#user" aria-expanded="true" aria-controls="user">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    User
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="user" class="collapse" aria-labelledby="headingFive">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_user" value=1 id="view_user">
                                                                    <label for="view_user"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_user" value=1 id="create_user">
                                                                    <label for="create_user"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_user" value=1 id="edit_user">
                                                                    <label for="edit_user"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_user" value=1 id="delete_user">
                                                                    <label for="delete_user"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingOne" data-toggle="collapse"
                                        data-target="#maintenance" aria-expanded="true"
                                        aria-controls="maintenance">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Maintenance
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="maintenance" class="collapse" aria-labelledby="headingOne">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_maintenance" value=1
                                                                        id="view_maintenance">
                                                                    <label for="view_maintenance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_maintenance" value=1
                                                                        id="create_maintenance">
                                                                    <label for="create_maintenance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_maintenance" value=1
                                                                        id="edit_maintenance">
                                                                    <label for="edit_maintenance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_maintenance" value=1
                                                                        id="delete_maintenance">
                                                                    <label for="delete_maintenance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingTwo" data-toggle="collapse"
                                        data-target="#booking" aria-expanded="true" aria-controls="booking">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Booking
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="booking" class="collapse" aria-labelledby="headingTwo">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_booking" value=1 id="view_booking">
                                                                    <label for="view_booking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_booking" value=1 id="create_booking">
                                                                    <label for="create_booking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_booking" value=1 id="edit_booking">
                                                                    <label for="edit_booking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_booking" value=1 id="delete_booking">
                                                                    <label for="delete_booking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingThree" data-toggle="collapse"
                                        data-target="#maintenance-type" aria-expanded="true"
                                        aria-controls="maintenance-type">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Maintenance Type
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="maintenance-type" class="collapse" aria-labelledby="headingThree">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_maintenance-type" value=1
                                                                        id="view_maintenance-type">
                                                                    <label for="view_maintenance-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_maintenance-type" value=1
                                                                        id="create_maintenance-type">
                                                                    <label for="create_maintenance-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_maintenance-type" value=1
                                                                        id="edit_maintenance-type">
                                                                    <label for="edit_maintenance-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_maintenance-type" value=1
                                                                        id="delete_maintenance-type">
                                                                    <label for="delete_maintenance-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingFour" data-toggle="collapse"
                                        data-target="#owner" aria-expanded="true" aria-controls="owner">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Owner
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="owner" class="collapse" aria-labelledby="headingFour">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_owner" value=1 id="view_owner">
                                                                    <label for="view_owner"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_owner" value=1 id="create_owner">
                                                                    <label for="create_owner"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_owner" value=1 id="edit_owner">
                                                                    <label for="edit_owner"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_owner" value=1 id="delete_owner">
                                                                    <label for="delete_owner"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingFive"  data-toggle="collapse"
                                        data-target="#insurance" aria-expanded="true"
                                        aria-controls="insurance">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Insurance
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="insurance" class="collapse" aria-labelledby="headingFive">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_insurance" value=1 id="view_insurance">
                                                                    <label for="view_insurance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="create_insurance" value=1
                                                                        id="create_insurance">
                                                                    <label for="create_insurance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="edit_insurance" value=1 id="edit_insurance">
                                                                    <label for="edit_insurance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="delete_insurance" value=1
                                                                        id="delete_insurance">
                                                                    <label for="delete_insurance"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="card-header" id="headingOne" data-toggle="collapse"
                                        data-target="#tracking" aria-expanded="true"
                                        aria-controls="tracking">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Tracker
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="tracking" class="collapse" aria-labelledby="headingOne">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="view_tracking" value=1 id="view_tracking">
                                                                    <label for="view_tracking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="create_tracking" value=1
                                                                        id="create_tracking">
                                                                    <label for="create_tracking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="edit_tracking" value=1 id="edit_tracking">
                                                                    <label for="edit_tracking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="delete_tracking" value=1
                                                                        id="delete_tracking">
                                                                    <label for="delete_tracking"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingTwo" data-toggle="collapse"
                                        data-target="#driver" aria-expanded="true" aria-controls="driver">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Driver
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="driver" class="collapse" aria-labelledby="headingTwo">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="view_driver" value=1 id="view_driver">
                                                                    <label for="view_driver"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="create_driver" value=1 id="create_driver">
                                                                    <label for="create_driver"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="edit_driver" value=1 id="edit_driver">
                                                                    <label for="edit_driver"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="delete_driver" value=1 id="delete_driver">
                                                                    <label for="delete_driver"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingThree" data-toggle="collapse"
                                        data-target="#workshop" aria-expanded="true"
                                        aria-controls="workshop">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Workshop
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="workshop" class="collapse" aria-labelledby="headingThree">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="view_workshop" value=1 id="view_workshop">
                                                                    <label for="view_workshop"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="create_workshop" value=1
                                                                        id="create_workshop">
                                                                    <label for="create_workshop"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="edit_workshop" value=1 id="edit_workshop">
                                                                    <label for="edit_workshop"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="delete_workshop" value=1
                                                                        id="delete_workshop">
                                                                    <label for="delete_workshop"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingFour" data-toggle="collapse"
                                        data-target="#workshop-type" aria-expanded="true"
                                        aria-controls="workshop-type">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button" >
                                                    Workshop Type
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="workshop-type" class="collapse" aria-labelledby="headingFour">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">View</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="view_workshop-type" value=1
                                                                        id="view_workshop-type">
                                                                    <label for="view_workshop-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="create_workshop-type" value=1
                                                                        id="create_workshop-type">
                                                                    <label for="create_workshop-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Update</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="edit_workshop-type" value=1
                                                                        id="edit_workshop-type">
                                                                    <label for="edit_workshop-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Delete</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input " type="checkbox"
                                                                        name="delete_workshop-type" value=1
                                                                        id="delete_workshop-type">
                                                                    <label for="delete_workshop-type"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingOne" data-toggle="collapse"
                                        data-target="#back-date" aria-expanded="true"
                                        aria-controls="back-date">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button">
                                                    Back Date
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="back-date" class="collapse" aria-labelledby="headingOne">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <div class="switchbox-wrapper">
                                                                <div class="switchbox-text">Create</div>
                                                                <div class="custom-control custom-switch">
                                                                    <input class="custom-control-input" type="checkbox"
                                                                        name="view_back_date" value=1 id="view_back_date">
                                                                    <label for="view_back_date"
                                                                        class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
