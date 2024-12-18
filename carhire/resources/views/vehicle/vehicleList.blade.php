@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0">{{$heading}}</h1>

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
                                            <th>Registration No</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Owner</th>
                                            <th>Fuel</th>
                                            <th class="p-0">Status</th>
                                            <th class="reduce-width"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $vehicleData)
                                            <tr class="clickable-row"
                                                data-href="{{ route('vehicle.show', $vehicleData['vehicle']->vehicle_id) }}">
                                                <td>V-{{ str_pad($vehicleData['vehicle']->vehicle_id, 5, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $vehicleData['vehicle']->vehicle_registration_no }}</td>
                                                <td>{{ $vehicleData['vehicle']->vehicle_model }}</td>
                                                <td>{{ $vehicleData['vehicle']->vehicle_type }}</td>
                                                <td>{{ $vehicleData['vehicle']->vehicle_owner->c_first_name }} @if ($vehicleData['vehicle']->vehicle_owner->c_last_name != null){{ $vehicleData['vehicle']->vehicle_owner->c_last_name }}@endif
                                                </td>
                                                <td>{{ $vehicleData['vehicle']->fuel_type }}</td>
                                                <td class="p-0">
                                                    @if ($vehicleData['status'] == 'Rented' || $vehicleData['status'] == 'Sold')
                                                        <div class="badge badge-danger">
                                                            {{ $vehicleData['status'] }}
                                                        </div>
                                                    @elseif ($vehicleData['status'] == 'Maintenance')
                                                        <div class="badge badge-secondary">
                                                            {{ $vehicleData['status'] }}
                                                        </div>
                                                    @else
                                                        <div class="badge badge-success">
                                                            {{ $vehicleData['status'] }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="reduce-width">
                                                    <div class="dropdown">
                                                        <button class="action-button" type="button"
                                                            id="actionsDropdown{{ $vehicleData['vehicle']->vehicle_id }}"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <!-- Three vertical dots icon -->
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="actionsDropdown{{ $vehicleData['vehicle']->vehicle_id }}">
                                                            @if (Auth::user()->hasPermissionTo('edit-vehicle'))
                                                                <a class="dropdown-item"
                                                                    href="{{ route('vehicle.edit', $vehicleData['vehicle']->vehicle_id) }}">
                                                                    Edit
                                                                </a>
                                                            @endif
                                                            @if (Auth::user()->hasPermissionTo('delete-vehicle'))
                                                                <a class="dropdown-item text-danger" href="#"
                                                                    onclick="deleteVehicleConfirmation({{ $vehicleData['vehicle']->vehicle_id }},`{{ route('vehicle.delete') }}`)">
                                                                    Delete
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Registration No</th>
                                            <th>Name</th>
                                            <th>Owner</th>
                                            <th>Type</th>
                                            <th>Model</th>
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
            @if (Auth::user()->hasPermissionTo('create-vehicle'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('vehicle.create') }}" class="btn btn-primary btn-sm table-btn">Add Vehicle</a>`);
            @endif
        });
    </script>
@endsection
