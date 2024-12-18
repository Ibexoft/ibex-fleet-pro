@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Add Insurance Company</h1>

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

                        <form method="POST" enctype="multipart/form-data" action="{{ route('insurance-company.store') }}">

                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="incompany_name">Insurance Company Name<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" required autocomplete="incompany_name"
                                                value="{{ old('incompany_name') }}" id="incompany_name"
                                                name="incompany_name" class="form-control" placeholder="Company Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="incompany_reg_no">Telephone<span aria-hidden="true"
                                                    class="required">*</span> <small>Format: XXXXXXXXXX</small></label>

                                            <input type="tel" pattern="[0-9]{10}" required
                                                autocomplete="incompany_reg_no" value="{{ old('incompany_reg_no') }}"
                                                id="incompany_reg_no" name="incompany_reg_no" class="form-control"
                                                placeholder="Enter Telephone">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="incompany_address">Company Address<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" required autocomplete="incompany_address"
                                                value="{{ old('incompany_address') }}" id="incompany_address"
                                                name="incompany_address" class="form-control" placeholder="Company Address">

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
