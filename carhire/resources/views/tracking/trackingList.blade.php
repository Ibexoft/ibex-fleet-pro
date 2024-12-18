@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trackers</h1>
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
                                        <th>Telephone</th>
                                        <th>ICCID</th>
                                        <th>Cell Provider</th>
                                        <th class="p-0">Status</th>
                                        @if (Auth::user()->hasPermissionTo('edit-tracking') || Auth::user()->hasPermissionTo('delete-tracking'))
                                        <th class="reduce-width"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tracking as $trackingData)
                                        <tr class="clickable-row" data-href="{{ route('tracking.show', $trackingData->tracking_id) }}">
                                            <td>T-{{str_pad($trackingData->tracking_id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $trackingData->vehicle_registration_no }}</td>
                                            <td>{{ $trackingData->mobile_no }}</td>
                                            <td>{{ $trackingData->iccid_no }}</td>
                                            <td>{{ $trackingData->cell_provider }}</td>
                                            <td class="p-0">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input trackingStatus" data-url="{{ route('tracking.status') }}"
                                                            id="<?php echo $trackingData->tracking_id; ?>" type="checkbox" <?php echo $trackingData->is_active == 1 ? 'checked' : ''; ?>
                                                            value="<?php echo $trackingData->is_active == 1 ? 0 : 1; ?>"><label class="custom-control-label"
                                                            for="{{ $trackingData->tracking_id }}"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            @if (Auth::user()->hasPermissionTo('edit-tracking') || Auth::user()->hasPermissionTo('delete-tracking'))
                                            <td class="reduce-width">
                                                <div class="dropdown">
                                                    <button class="action-button" type="button" id="actionsDropdown{{ $trackingData->tracking_id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!-- Three vertical dots icon -->
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $trackingData->tracking_id }}">
                                                         @if (Auth::user()->hasPermissionTo('edit-tracking'))
                                                        <a class="dropdown-item" href="{{ route('tracking.edit', $trackingData->tracking_id) }}">
                                                            Edit
                                                        </a>
                                                        @endif
                                                        @if (Auth::user()->hasPermissionTo('delete-tracking'))
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteTrackingConfirmation({{ $trackingData->tracking_id }},`{{ route('tracking.delete') }}`)">
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
                                        <th>Telephone</th>
                                        <th>ICCID</th>
                                        <th>Cell Provider</th>
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
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                },
            });
            @if (Auth::user()->hasPermissionTo('create-tracking'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('tracking.create') }}" class="btn btn-primary btn-sm table-btn">Add Tracking</a>`);
            @endif
        });

    </script>
@endsection
