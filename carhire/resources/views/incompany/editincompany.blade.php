@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Edit Insurance Company</h1>

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
                            action="{{ route('insurance-company.update', $edit->ic_id) }}">

                            @csrf

                            <div class="card-body">









                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Insureance Company Name<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="text" required value="{{ $edit->icompany_name }}"
                                                id="incompany_name" name="incompany_name" class="form-control"
                                                placeholder="Company Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Telephone<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" required value="{{ $edit->icompany_reg_no }}"
                                                id="incompany_reg_no" name="incompany_reg_no" class="form-control"
                                                placeholder="Enter Telephone">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Company Address<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="text" required value="{{ $edit->icompany_address }}"
                                                id="incompany_address" name="incompany_address" class="form-control"
                                                placeholder="Company Address">

                                        </div>

                                    </div>



                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <input type="hidden" name="id" id="id"
                                                value="{{ $edit->ic_id }}" />



                                        </div>

                                    </div>



                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">Update Insurance Company</button>

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
