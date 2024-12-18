@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insurance</h1>
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
                                        <th>Policy Number</th>
                                        <th>Insurance Premium</th>
                                        <th>Account Name</th>
                                        <th>Insurance Start Date</th>
                                        <th>Insurance End Date</th>
                                        <th class="p-0">Status</th>
                                        @if (Auth::user()->hasAnyPermission(['edit-insurance', 'delete-insurance']))
                                        <th class="reduce-width"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($insurance as $insuranceData)
                                        <tr class="clickable-row" data-href="{{ route('insurance.show', $insuranceData->insurance_id) }}">
                                            <td>I-{{str_pad($insuranceData->insurance_id, 5, '0', STR_PAD_LEFT)}}</td>
                                            <td>{{ $insuranceData->vehicle_registration_no }}</td>
                                            <td>{{ $insuranceData->policy_number }}</td>
                                            <td>{{ $insuranceData->insurance_premium }}</td>
                                            <td>{{ $insuranceData->account_name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($insuranceData->insurance_start_date))}}</td>
                                            <td>{{ date('d-m-Y', strtotime($insuranceData->insurance_end_date))}}</td>
                                            <td class="p-0">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input class="custom-control-input insuranceSwitch1" data-url="{{ route('insurance.status') }}"
                                                            id="<?php echo $insuranceData->insurance_id; ?>" type="checkbox" <?php echo $insuranceData->is_active == 1 ? 'checked' : ''; ?>
                                                            value="<?php echo $insuranceData->is_active == 1 ? 0 : 1; ?>"><label class="custom-control-label"
                                                            for="{{ $insuranceData->insurance_id }}"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            @if (Auth::user()->hasAnyPermission(['edit-insurance', 'delete-insurance']))
                                            <td class="reduce-width">
                                                <div class="dropdown">
                                                    <button class="action-button" type="button" id="actionsDropdown{{ $insuranceData->insurance_id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!-- Three vertical dots icon -->
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $insuranceData->insurance_id }}">
                                                        @if (Auth::user()->hasPermissionTo('edit-insurance'))
                                                        <a class="dropdown-item" href="{{ route('insurance.edit', $insuranceData->insurance_id) }}">
                                                            Edit
                                                        </a>
                                                        @endif
                                                        @if (Auth::user()->hasPermissionTo('delete-insurance'))
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteInsuranceConfirmation({{ $insuranceData->insurance_id }},`{{ route('insurance.delete') }}`)">
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
                                        <th>Policy Number</th>
                                        <th>Insurance Premium</th>
                                        <th>Account Name</th>
                                        <th>Insurance Start Date</th>
                                        <th>Insurance End Date</th>
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
            @if (Auth::user()->hasPermissionTo('create-insurance'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ url('add-insurance') }}" class="btn btn-primary btn-sm table-btn">Add Insurance</a>`);
            @endif
        });

    </script>
@endsection
