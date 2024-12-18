@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Maintenace Type</h1>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('maintenance-type.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Maintenance Type Name<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" autocomplete="maintenance_type_name"
                                                value="{{ old('maintenance_type_name') }}" id="maintenance_type_name"
                                                name="maintenance_type_name" required class="form-control"
                                                placeholder="Enter Maintenance Type Name">
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
