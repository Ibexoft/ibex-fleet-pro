@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Drivers</h1>
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
                    <div id="error"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>EziDebit Driver Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th class="p-0">Status</th>
                                            @if (Auth::user()->hasAnyPermission(['edit-driver', 'delete-driver']))
                                                <th class="reduce-width"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($driver as $driverData)
                                            <tr class="clickable-row"
                                                data-href="{{ route('driver.show', $driverData->driver_id) }}">
                                                <td>D-{{ str_pad($driverData->driver_id, 5, '0', STR_PAD_LEFT) }}</td>
                                                <td>
                                                    @if (empty($driverData->ezi_debt))
                                                        -
                                                    @else
                                                        {{ $driverData->ezi_debt }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($driverData->first_name))
                                                        -
                                                    @else
                                                        {{ $driverData->first_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($driverData->last_name))
                                                        -
                                                    @else
                                                        {{ $driverData->last_name }}
                                                    @endif
                                                </td>
                                                <td>{{ $driverData->email }}</td>
                                                <td>
                                                    @if (empty($driverData->contact))
                                                        -
                                                    @else
                                                        {{ $driverData->contact }}
                                                    @endif
                                                </td>
                                                <td class="p-0">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input driverStatusChange"
                                                                data-url="{{ route('driver.status') }}"
                                                                id="<?php echo $driverData->driver_id; ?>" type="checkbox" <?php echo $driverData->is_active == 1 ? 'checked' : ''; ?>
                                                                value="<?php echo $driverData->is_active == 1 ? 0 : 1; ?>"><label
                                                                class="custom-control-label"
                                                                for="{{ $driverData->driver_id }}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                @if (Auth::user()->hasAnyPermission('edit-driver'))
                                                    <td class="reduce-width">
                                                        <div class="dropdown">
                                                            <button class="action-button" type="button"
                                                                id="actionsDropdown{{ $driverData->driver_id }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <!-- Three vertical dots icon -->
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="actionsDropdown{{ $driverData->driver_id }}">
                                                                @if (Auth::user()->hasPermissionTo('edit-driver'))
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('driver.edit', $driverData->driver_id) }}">
                                                                        Edit
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
                                            <th>EziDebit Driver Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
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
            @if (Auth::user()->hasPermissionTo('create-driver'))
                $("#example1_wrapper .dataTables_filter").append(
                    `<a id="datatable-button" href="{{ route('driver.create') }}" class="btn btn-primary btn-sm table-btn">Add Driver</a>`
                );
            @endif
        });
    </script>
@endsection
