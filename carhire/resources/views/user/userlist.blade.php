@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div style="display: none;" class="alert alert-success successAlert" role="alert"><span
                            class="successMessage"></span></div>
                
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="p-0">Status</th>
                                        <th class="reduce-width"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $userData)
                                        <tr class="clickable-row" data-href="{{ route('user.show', $userData->id) }}">
                                            <td>U-{{str_pad($userData->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $userData->name }}</td>
                                            <td>{{ $userData->email }}</td>
                                            <td>{{ $userData->role }}</td>
                                            <td class="p-0">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input userSwitch1" data-url="{{ route('user.status') }}"
                                                            id="<?php echo $userData->id; ?>" type="checkbox" <?php echo $userData->is_active == 1 ? 'checked' : ''; ?>
                                                            value="<?php echo $userData->is_active == 1 ? 0 : 1; ?>"><label class="custom-control-label"
                                                            for="{{ $userData->id }}"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            @if (Auth::user()->hasPermissionTo('edit-user') || Auth::user()->hasPermissionTo('delete-user'))
                                                <td class="reduce-width">
                                                    <div class="dropdown">
                                                        <button class="action-button" type="button" id="actionsDropdown{{ $userData->id }}"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <!-- Three vertical dots icon -->
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $userData->id }}">
                                                            @if (Auth::user()->hasPermissionTo('edit-user'))
                                                            <a class="dropdown-item" href="{{ route('user.edit', $userData->id) }}">
                                                                Edit
                                                            </a>
                                                            @endif
                                                            @if (Auth::user()->hasPermissionTo('delete-user'))
                                                                <a class="dropdown-item text-danger" href="#" onclick="deleteUserConfirmation({{ $userData->id }},`{{ route('user.delete') }}`)">
                                                                    Delete
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="p-0">Status</th>
                                        <th class="reduce-width"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <style type="text/css">
        .roleStyle {
            background-color: green;
            color: white;
            padding-top: 3px;
            padding-bottom: 3px;
            padding-right: 7px;
            padding-left: 7px;
            border-radius: 5px;
        }
        .dt-buttons {
            display: none;
        }
    </style>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
           $("#example1").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "emptyTable": "No records found",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "<span><</span>",
                        "sNext": "<span>></span>"
                    }
                },
            });
            @if (Auth::user()->hasPermissionTo('create-user'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('user.create') }}" class="btn btn-primary btn-sm table-btn">Add User</a>`);
            @endif
        });

    </script>
@endsection