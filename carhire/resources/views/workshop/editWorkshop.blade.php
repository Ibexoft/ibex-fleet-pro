@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Update Workshop</h1>

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
                            action="{{ route('workshop.update', $workshop->workshop_id) }}">

                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputEmail1">Workshop Name<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" value="{{ $workshop->workshop_name }}" id="workshop_name"
                                                name="workshop_name" required class="form-control"
                                                placeholder="Workshop Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputPhone1">Workshop Address<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" name="workshop_address"
                                                value="{{ $workshop->workshop_address }}" id="workshop_address" required
                                                class="form-control" placeholder="Workshop Address">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="workshop_type">Workshop Type<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <select required class="select2 err-tooltip" name="workshop_type[]"
                                                multiple="multiple" data-placeholder="Select Applicable Workshop Types"
                                                style="width: 100%;">

                                                @foreach ($allTypes as $typeData)
                                                    <option value="{{ $typeData->workshop_type_id }}"
                                                        @if (in_array($typeData->workshop_type_id, $typeIds)) selected @endif>
                                                        {{ $typeData->workshop_type_name }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputPassword1">Contact Person Name<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" required value="{{ $workshop->organizer_name }}"
                                                id="organizer_name" name="organizer_name" class="form-control"
                                                placeholder="Contact Person Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Contact Person Email<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="email" required value="{{ $workshop->organizer_email }}"
                                                id="organizer_email" name="organizer_email" class="form-control"
                                                placeholder="Contact Person Email">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Contact Person Telephone<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="text" required value="{{ $workshop->organizer_contact }}"
                                                id="organizer_contact" name="organizer_contact" class="form-control"
                                                placeholder="Contact Person Telephone">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">Update Workshop</button>

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
