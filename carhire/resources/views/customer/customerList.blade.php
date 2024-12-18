@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Owners</h1>
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
                                            <th>Telephone</th>
                                            <th>Entity Type</th>
                                            <th class="p-0">Status</th>
                                            @if (Auth::user()->hasAnyPermission(['edit-owner', 'delete-owner']))
                                                <th class="reduce-width"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer as $customerData)
                                            <tr class="clickable-row"
                                                data-href="{{ route('owner.show', $customerData->customer_id) }}">
                                                <td>O-{{str_pad($customerData->customer_id, 5, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $customerData->c_first_name }} @if ($customerData->c_last_name != null){{ $customerData->c_last_name }}@endif</td>
                                                <td>{{ $customerData->email }}</td>
                                                <td>{{ $customerData->contact }}</td>
                                                <td>{{ $customerData->entity_type }}</td>
                                                <td class="p-0">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input adminSwitch1" data-url="{{ route('owner.status') }}"
                                                                id="<?php echo $customerData->customer_id; ?>" type="checkbox" <?php echo $customerData->is_active == 1 ? 'checked' : ''; ?>
                                                                value="<?php echo $customerData->is_active == 1 ? 0 : 1; ?>"><label
                                                                class="custom-control-label"
                                                                for="{{ $customerData->customer_id }}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                @if (Auth::user()->hasAnyPermission(['edit-owner', 'delete-owner']))
                                                    <td class="reduce-width">
                                                        <div class="dropdown">
                                                            <button class="action-button" type="button"
                                                                id="actionsDropdown{{ $customerData->customer_id }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <!-- Three vertical dots icon -->
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="actionsDropdown{{ $customerData->customer_id }}">
                                                                @if (Auth::user()->hasPermissionTo('edit-owner'))
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('owner.edit', $customerData->customer_id) }}">
                                                                        Edit
                                                                    </a>
                                                                @endif
                                                                @if (Auth::user()->hasPermissionTo('delete-owner'))
                                                                    <a class="dropdown-item text-danger" href="#"
                                                                        onclick="deleteAdminConfirmation({{ $customerData->customer_id }},`{{ route('owner.delete') }}`)">
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
                                            <th>Telephone</th>
                                            <th>Entity Type</th>
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
            @if (Auth::user()->hasPermissionTo('create-owner'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('owner.create') }}" class="btn btn-primary btn-sm table-btn">Add Owner</a>`);
            @endif
        });
    </script>
@endsection
