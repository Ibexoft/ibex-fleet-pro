@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Maintenance</h1>
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
                                        <th>Vehicle</th>
                                        <th>Driver</th>
                                        <th class="text-center">Odometer(km)</th>
                                        <th class="text-center">Next Service(km)</th>
                                        <th>Maintenance Scheduled</th>
                                        <th class="p-0">Status</th>
                                        @if (Auth::user()->hasAnyPermission(['edit-maintenance', 'delete-maintenance']))
                                        <th class="reduce-width"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maintenance as $maintenanceData)
                                        <tr class="clickable-row" data-href="{{ route('maintenance.show', $maintenanceData->id) }}">
                                            <td>M-{{str_pad($maintenanceData->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $maintenanceData->getVehicle->vehicle_registration_no }}</td>
                                            <td>{{ $maintenanceData->getDriver->first_name }} {{ $maintenanceData->getDriver->last_name }}</td>
                                            <td class="text-center">
                                                @if ($maintenanceData->odo_meter)
                                                {{ $maintenanceData->odo_meter }} km
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($maintenanceData->next_service)
                                                {{ $maintenanceData->next_service }} km
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($maintenanceData->maintenance_date))}}</td>
                                            <td class="p-0">
                                                @if ($maintenanceData->job_status == 1)
                                                <div class="badge badge-warning">Pending</div>
                                                @else
                                                <div class="badge badge-success">Completed</div>
                                                @endif
                                            
                                            @if (Auth::user()->hasAnyPermission(['edit-maintenance', 'delete-maintenance']))
                                            <td class="reduce-width">
                                                <div class="dropdown">
                                                    <button class="action-button" type="button" id="actionsDropdown{{ $maintenanceData->id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!-- Three vertical dots icon -->
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $maintenanceData->id }}">
                                                        @if (Auth::user()->hasPermissionTo('edit-maintenance'))
                                                        <a class="dropdown-item" href="@if ($maintenanceData->job_status == 1)
                                                            {{ route('maintenance.edit', $maintenanceData->id) }}
                                                        @else
                                                            {{ route('maintenance.edit-processed', $maintenanceData->id) }}
                                                        @endif">
                                                            Edit
                                                        </a>
                                                        @endif
                                                        @if (Auth::user()->hasPermissionTo('delete-maintenance'))
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteMaintenanceConfirmation({{ $maintenanceData->id }},`{{ route('maintenance.delete') }}`)">
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
                                        <th>Vehicle</th>
                                        <th>Driver</th>
                                        <th class="text-center">Odometer(km)</th>
                                        <th class="text-center">Next Service(km)</th>
                                        <th>Maintenance Scheduled</th>
                                        <th class="p-0">Status</th>
                                        @if (Auth::user()->hasAnyPermission(['edit-maintenance', 'delete-maintenance']))
                                        <th class="reduce-width"></th>
                                        @endif
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

        .returnActualData {
            background-color: #007bff;
            color: #fff;
            padding: 7px;
            border-radius: 4px;
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
            @if (Auth::user()->hasPermissionTo('create-maintenance'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('maintenance.create') }}" class="btn btn-primary ml-3">Request Maintenance</a>`);
            @endif
          
        });

    </script>
@endsection