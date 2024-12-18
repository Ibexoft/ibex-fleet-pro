@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Add User</h1>

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

                        <form method="POST" enctype="multipart/form-data" action="{{ route('user.store') }}">

                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputName1">Name<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input value="{{ old('name') }}" autocomplete="name" id="name"
                                                type="text" name="name" required class="form-control"
                                                id="exampleInputName1" placeholder="Enter Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputEmail1">Email<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="email" value="{{ old('email') }}" autocomplete="email"
                                                id="email" name="email" required class="form-control"
                                                placeholder="Enter Email">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Role<span aria-hidden="true" class="required">*</span></label>

                                            <select required name="role_id" id="role_id" class="form-control select2 err-tooltip">

                                                <option value="">Select Role</option>

                                                @foreach ($role as $roleData)
                                                    <option value="{{ $roleData->id }}">{{ $roleData->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputPassword1">Password<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="password" required value="{{ old('password') }}"
                                                autocomplete="password" id="password" name="password" class="form-control"
                                                placeholder="Password">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Confirm Password<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="password" required autocomplete="password_confirmation"
                                                value="{{ old('password_confirmation') }}" id="password_confirmation"
                                                name="password_confirmation" class="form-control"
                                                placeholder="Confirm Password">

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

@section('script')
    <script>
        function RemoveAlert(btn) {
            btn.parentElement.parentElement.remove();
        }

        $(document).ready(function() {
            initializeSelect2Dropdown("#role_id", "Select Role");
        });
    </script>
@endsection
