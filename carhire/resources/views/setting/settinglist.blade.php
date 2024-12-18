@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Maintenance Types</h1>
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
                                        <th class="p-0">Status</th>
                                        @if (Auth::user()->hasAnyPermission(['edit-maintenance-type', 'delete-maintenance-type']))
                                        <th class="reduce-width"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($setting as $list)
                                        <tr 
                                        @if (Auth::user()->hasPermissionTo('edit-maintenance-type'))
                                            class="clickable-row" data-href="{{ route('maintenance-type.edit', $list->maintenance_type_id) }}"
                                        @endif>
                                        <td>MT-{{str_pad($list->maintenance_type_id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $list->maintenance_type_name }}</td>
                                            <td class="p-0">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input adminSwitch1" data-url="{{ route('maintenance-type.status', $list->maintenance_type_id) }}"
                                                            id="<?php echo $list->maintenance_type_id; ?>" type="checkbox" <?php echo $list->is_active == 1 ? 'checked' : ''; ?>
                                                            value="<?php echo $list->is_active == 1 ? 0 : 1; ?>"><label class="custom-control-label"
                                                            for="{{ $list->maintenance_type_id }}"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            @if (Auth::user()->hasAnyPermission(['edit-maintenance-type', 'delete-maintenance-type']))
                                            <td class="reduce-width">
                                                <div class="dropdown">
                                                    <button class="action-button" type="button" id="actionsDropdown{{ $list->maintenance_type_id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!-- Three vertical dots icon -->
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $list->maintenance_type_id }}">
                                                        @if (Auth::user()->hasPermissionTo('edit-maintenance-type'))
                                                        <a class="dropdown-item" href="{{ route('maintenance-type.edit', $list->maintenance_type_id) }}">
                                                            Edit
                                                        </a>
                                                        @endif
                                                        @if (Auth::user()->hasPermissionTo('delete-maintenance-type'))
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteMaintenanceTypeConfirmation({{ $list->maintenance_type_id }},`{{ route('maintenance-type.delete') }}`)">
                                                                Delete
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
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
            @if (Auth::user()->hasPermissionTo('create-maintenance-type'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('maintenance-type.create') }}" class="btn btn-primary btn-sm table-btn">Add Type</a>`);
            @endif
        });

    </script>
@endsection
