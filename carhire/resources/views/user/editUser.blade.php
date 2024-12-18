@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Edit User</h1>

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

                        <form method="POST" enctype="multipart/form-data" action="{{ route('user.update', $user->id) }}">

                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputName1">Name<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input value="{{ $user->name }}" id="name" type="text" name="name"
                                                required class="form-control" id="exampleInputName1"
                                                placeholder="Enter Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputEmail1">Email<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="email" value="{{ $user->email }}" id="email" name="email"
                                                required class="form-control" placeholder="Enter Email">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="name">Role<span aria-hidden="true"
                                                class="required">*</span></label>

                                            <select required name="role_id" id="role_id" class="form-control select2 err-tooltip">

                                                @foreach ($role as $roleData)
                                                    <option
                                                        <?= $roleData->id == $user->roles->first()->id ? 'selected' : '' ?>
                                                        value="{{ $roleData->id }}">{{ $roleData->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputPassword1">Password<span
                                                    style="font-weight: 450; font-size: 13px;"> (Leave blank if you want to
                                                    keep previous password)</span></label>

                                            <input type="password" value="{{ old(' password ') }}" id="password"
                                                name="password" class="form-control" placeholder="Password">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Confirm Password</label>

                                            <input type="password" value="{{ old(' password_confirmation ') }}"
                                                id="password_confirmation" name="password_confirmation" class="form-control"
                                                placeholder="Confirm Password">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">Update User</button>

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
    $(document).ready(function() {
        initializeSelect2Dropdown("#role_id", "Select Role");
    });
</script>
@endsection
