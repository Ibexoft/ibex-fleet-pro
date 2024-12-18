@extends('layouts.app')

@section('admincontent')



    <!-- Content Header (Page header) -->

    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0">Dashboard</h1>

                </div><!-- /.col -->

            </div><!-- /.row -->

        </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->

            <div class="row">

                @if (Auth::user()->hasPermissionTo('view-owner'))
                    <div class="col-lg-3 col-6">

                        <!-- small box -->

                        <div class="small-box bg-info">

                            <div class="inner">



                                <h3>{{ $count_owner }}</h3>



                                <p>Total Owners</p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-users setting-icon"></i>

                            </div>

                            <a href="{{ route('owners') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                @endif

                <!-- ./col -->

                @if (Auth::user()->hasPermissionTo('view-vehicle'))
                    <div class="col-lg-3 col-6">

                        <!-- small box -->

                        <div class="small-box bg-success">

                            <div class="inner">

                                <h3>{{ $count_vehicle }}<sup style="font-size: 20px"></sup></h3>



                                <p>Total Vehicles</p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-car"></i>

                            </div>

                            <a href="{{ route('vehicles') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                @endif

                <!-- ./col -->

                @if (Auth::user()->hasPermissionTo('view-driver'))
                    <div class="col-lg-3 col-6">

                        <!-- small box -->

                        <div class="small-box bg-warning">

                            <div class="inner">

                                <h3>{{ $count_driver }}</h3>



                                <p>Total Drivers</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-person-add"></i>

                            </div>

                            <a href="{{ route('drivers') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                @endif

                <!-- ./col -->

                @if (Auth::user()->hasPermissionTo('view-vehicle'))
                    <div class="col-lg-3 col-6">

                        <!-- small box -->

                        <div class="small-box bg-danger">

                            <div class="inner">

                                <h3>{{ $count_available_vehicles }}</h3>



                                <p>Available Vehicles</p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-car"></i>

                            </div>

                            <a href="{{ route('available.vehicles') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                @endif

                {{-- <div class="col-lg-3 col-6">

            <!-- small box -->

            <div class="small-box bg-success">

              <div class="inner">

                <h3>{{$count_insurance}}<sup style="font-size: 20px"></sup></h3>



                <p>Total Insurance</p>

              </div>

              <div class="icon">

                <i class="ion ion-stats-bars"></i>

              </div>

              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>

          </div> --}}

                <!-- ./col -->

            </div>

            <!-- /.row -->

            <!-- Main row -->

            @if (Auth::user()->hasPermissionTo('view-booking'))
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <!-- Line chart -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Booking Trends
                                </h3>

                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="line-chart" style="height: 331px;"></canvas>
                            </div>
                            <!-- /.card-body-->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <h4 class="dashboard-title center-sm mb-0">Off-Road Vehicles</h4>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="btn-align">
                                        <a class="btn btn-outline-primary sm" href="{{ route('vehicles') }}">
                                            <i class="nav-icon fas fa-car mr-1"></i>
                                            Fleet
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dashboard">
                              <table id="vehicle-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Registration No</th>
                                        <th>Model</th>
                                        <th class="p-0">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $vehicleData)
                                        <tr class="clickable-row"
                                            data-href="{{ route('vehicle.show', $vehicleData['vehicle']->vehicle_id) }}">
                                            <td>{{ $vehicleData['vehicle']->vehicle_registration_no }}</td>
                                            <td>{{ $vehicleData['vehicle']->vehicle_model }}</td>
                                            <td>{{ $vehicleData['vehicle']->vehicle_type }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                  </div>
                </div>
            @endif

            <div class="row">
                @if (Auth::user()->hasPermissionTo('view-booking'))
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-6">
                                        <h4 class="dashboard-title center-sm mb-0">Recent Bookings</h4>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="btn-align">
                                            <a class="btn btn-outline-primary sm" href="{{ route('bookings') }}">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                Bookings
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive dashboard">
                                    <table id="bookings-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Vehicle</th>
                                                <th>Driver</th>
                                                <th>Weekly Rent</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latest_bookings as $booking)
                                                <tr class="clickable-row"
                                                    data-href="{{ route('booking.show', $booking->booking_id) }}">
                                                    <td>{{ $booking->vehicle_registration_no }}</td>
                                                    <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                                    <td>${{ number_format($booking->amount, 2) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($booking->start_date)) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($booking->end_date)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                @endif
            </div>
            @if (Auth::user()->hasPermissionTo('view-maintenance'))
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8">
                                    <h4 class="dashboard-title center-sm mb-0">Recent Vehicle Maintenance</h4>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="btn-align">
                                        <a class="btn btn-outline-primary sm" href="{{ route('maintenance') }}">
                                            <i class="fas fa-wrench mr-1"></i>
                                            Maintenance
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dashboard">
                                <table id="maintenances-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Maintenance Id</th>
                                            <th>Vehicle</th>
                                            <th>Driver</th>
                                            <th>Maintenance Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latest_maintenances as $maintenance)
                                            <tr class="clickable-row"
                                                data-href="{{ route('maintenance.show', $maintenance->id) }}">
                                                <td>M-{{ str_pad($maintenance->id, 5, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $maintenance->getVehicle->vehicle_registration_no }}</td>
                                                <td>{{ $maintenance->getDriver->first_name }}
                                                    {{ $maintenance->getDriver->last_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($maintenance->maintenance_date)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            @endif
            <!-- /.row (main row) -->


        </div><!-- /.container-fluid -->

    </section>

    <!-- /.content -->

@endsection

@section('script')
    <script>
        $(document).ready(function() {
          $('#vehicle-table').DataTable({
                "scrollY": "200px", // Adjust height as needed
                "scrollCollapse": true,
                "lengthChange": true,
                "paging": true,
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
            });
            $('#bookings-table').DataTable({
                "scrollY": "200px", // Adjust height as needed
                "scrollCollapse": true,
                "lengthChange": true,
                "paging": true,
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
            });
            $('#maintenances-table').DataTable({
                "scrollY": "200px", // Adjust height as needed
                "scrollCollapse": true,
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
            });
        });
    </script>
@endsection
