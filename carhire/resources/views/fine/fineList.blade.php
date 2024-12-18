@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fines</h1>
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
                                        <th>Vehicle Registration</th>
                                        <th>Owner</th>
                                        <th>Driver</th>
                                        <th>Notice</th>
                                        <th>Amount</th>
                                        <th class="p-0">Due Date</th>
                                        @if (Auth::user()->hasAnyPermission(['edit-fine', 'delete-fine']))
                                        <th class="reduce-width"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fine as $fineData)
                                        <tr class="clickable-row" data-href="{{ route('fine.show', $fineData->fine_id) }}">
                                            <td>F-{{ str_pad($fineData->fine_id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $fineData->vehicle->vehicle_registration_no }}</td>
                                            <td>{{ $fineData->vehicle->vehicle_owner->c_first_name }} @if ($fineData->vehicle->vehicle_owner->c_last_name != null){{ $fineData->vehicle->vehicle_owner->c_last_name }}@endif</td>
                                            <td>
                                            @if($fineData->payable_type == 'App\Models\Driver')
                                                {{ $fineData->payable->first_name }} {{ $fineData->payable->last_name }}
                                            @else
                                                {{ $fineData->payable->c_first_name }} {{ $fineData->payable->c_last_name }}
                                            @endif
                                           </td>
                                            <td>{{ $fineData->notice }}</td>
                                            <td>${{ number_format($fineData->amount, 2) }}</td>
                                            <td class="p-0">{{ date('d-m-Y', strtotime($fineData->due_date))}}</td>
                                            @if (Auth::user()->hasAnyPermission(['edit-fine', 'delete-fine']))
                                            <td class="reduce-width">
                                                <div class="dropdown">
                                                    <button class="action-button" type="button" id="actionsDropdown{{ $fineData->fine_id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!-- Three vertical dots icon -->
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $fineData->fine_id }}">
                                                        @if (Auth::user()->hasPermissionTo('edit-fine'))
                                                        <a class="dropdown-item" href="{{ route('fine.edit', $fineData->fine_id) }}">
                                                            Edit
                                                        </a>
                                                        @endif
                                                        @if (Auth::user()->hasPermissionTo('delete-fine'))
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteFineConfirmation({{ $fineData->fine_id }},`{{ route('fine.delete') }}`)">
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
                                        <th>Vehicle Registration</th>
                                        <th>Owner</th>
                                        <th>Driver</th>
                                        <th>Notice</th>
                                        <th>Amount</th>
                                        <th class="p-0">Due Date</th>
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
            @if (Auth::user()->hasPermissionTo('create-fine'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('fine.create') }}" class="btn btn-primary btn-sm table-btn">Add Fine</a>`);
            @endif
        });

    </script>
@endsection
