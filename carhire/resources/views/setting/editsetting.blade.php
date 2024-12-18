@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Maintenance Type</h1>
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                                        <i class="fas fa-arrow-left mr-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('maintenance-type.update', $setting->maintenance_type_id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Maintenance Type Name<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input value="{{ $setting->maintenance_type_name }}" id="maintenance_type_name"
                                                type="text" name="maintenance_type_name" required class="form-control"
                                                id="exampleInputName1" placeholder="Enter Maintenance Type Name">
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Maintenance Type</button>
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
