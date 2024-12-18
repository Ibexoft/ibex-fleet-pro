@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bookings</h1>
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
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Weekly Rent</th>
                                            <th class="p-0">Status</th>
                                            @if (Auth::user()->hasAnyPermission(['edit-booking', 'delete-booking']))
                                                <th class="reduce-width"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking as $bookingData)
                                            <tr class="clickable-row"
                                                data-href="{{ route('booking.show', $bookingData->booking_id) }}">
                                                <td>B-{{ str_pad($bookingData->booking_id, 5, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $bookingData->vehicle_registration_no }}</td>
                                                <td>{{ $bookingData->first_name }} {{ $bookingData->last_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($bookingData->start_date)) }}</td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($bookingData->end_date)) }}
                                                </td>
                                                {{-- <td>{{$bookingData->end_date}}</td> --}}
                                                <td>${{ number_format($bookingData->amount, 2) }}</td>
                                                <td class="p-0">
                                                    @if ($bookingData['status'] == 'Booked')
                                                        <div class="badge badge-danger">
                                                            {{ $bookingData['status'] }}
                                                        </div>
                                                    @elseif ($bookingData['status'] == 'Pending')
                                                        <div class="badge badge-warning">
                                                            {{ $bookingData['status'] }}
                                                        </div>
                                                    @else
                                                        <div class="badge badge-success">
                                                            {{ $bookingData['status'] }}
                                                        </div>
                                                    @endif
                                                </td>
                                                @if (Auth::user()->hasAnyPermission(['edit-booking', 'delete-booking']))
                                                    <td class="reduce-width">
                                                        <div class="dropdown">
                                                            <button class="action-button" type="button"
                                                                id="actionsDropdown{{ $bookingData->booking_id }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <!-- Three vertical dots icon -->
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="actionsDropdown{{ $bookingData->booking_id }}">
                                                                @if (Auth::user()->hasPermissionTo('edit-booking'))
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('booking.edit', $bookingData->booking_id) }}">
                                                                        Edit
                                                                    </a>
                                                                @endif
                                                                @if (Auth::user()->hasPermissionTo('delete-booking'))
                                                                    <a class="dropdown-item text-danger" href="#"
                                                                        onclick="deletebookingConfirmation({{ $bookingData->booking_id }},`{{ route('booking.delete') }}`)">
                                                                        Cancel
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
                                            <th>From</th>
                                            <th>To</th>
                                            <th class="p-0">Weekly Rent</th>
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
            @if (Auth::user()->hasPermissionTo('create-booking'))
                $("#example1_wrapper .dataTables_filter").append(
                    `<a id="datatable-button" href="{{ route('booking.create') }}" class="btn btn-primary btn-sm table-btn">Add Booking</a>`
                    );
            @endif
        });
    </script>
@endsection
