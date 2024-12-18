@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Workshops</h1>
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
                                        <th>Workshop Name</th>
                                        <th>Contact Person Name</th>
                                        <th>Contact Person Telephone</th>
                                        <th class="p-0">Workshop Address</th>
                                        <th class="reduce-width"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workshop as $workshopData)
                                        <tr class="clickable-row" data-href="{{ route('workshop.show', $workshopData->workshop_id) }}">
                                            <td>W-{{str_pad($workshopData->workshop_id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $workshopData->workshop_name }}</td>
                                            <td>{{ $workshopData->organizer_name }}</td>
                                            <td>{{ $workshopData->organizer_contact }}</td>
                                            <td class="p-0">{{ $workshopData->workshop_address }}</td>
                                            <td class="reduce-width">
                                                <div class="dropdown">
                                                    <button class="action-button" type="button" id="actionsDropdown{{ $workshopData->workshop_id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!-- Three vertical dots icon -->
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $workshopData->workshop_id }}">
                                                        @if (Auth::user()->hasPermissionTo('edit-workshop'))
                                                        <a class="dropdown-item" href="{{ route('workshop.edit', $workshopData->workshop_id) }}">
                                                            Edit
                                                        </a>
                                                        @endif
                                                        @if (Auth::user()->hasPermissionTo('delete-workshop'))
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteWorkShopConfirmation({{ $workshopData->workshop_id }},`{{ route('workshop.delete') }}`)">
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
                                        <th>Workshop Name</th>
                                        <th>Contact Person Name</th>
                                        <th>Contact Person Telephone</th>
                                        <th class="p-0">Workshop Address</th>
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
            @if (Auth::user()->hasPermissionTo('create-workshop'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('workshop.create') }}" class="btn btn-primary btn-sm table-btn">Add Workshop</a>`);
            @endif
        });

    </script>
@endsection
