@extends('layouts.app')
@section('admincontent')
    <!-- Content Header (Page header) -->

    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0">Settings</h1>

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



                            <h3>{{ $totalOwners }}</h3>



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

                @if (Auth::user()->hasPermissionTo('view-insurance-company'))

                <div class="col-lg-3 col-6">

                    <!-- small box -->

                    <div class="small-box bg-success">

                        <div class="inner">

                            <h3>{{ $totalInuranceCompanies }}<sup style="font-size: 20px"></sup></h3>



                            <p>Insurance Companies</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-handshake setting-icon"></i>

                        </div>

                        <a href="{{ route('insurance-companies') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>

                    </div>

                </div>

                @endif

                <!-- ./col -->

                @if (Auth::user()->hasPermissionTo('view-workshop'))

                <div class="col-lg-3 col-6">

                    <!-- small box -->

                    <div class="small-box bg-warning">

                        <div class="inner">

                            <h3>{{ $totalWorkshops }}</h3>



                            <p>Total Workshops</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-warehouse setting-icon"></i>

                        </div>

                        <a href="{{ route('workshops') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right "></i></a>

                    </div>

                </div>

                @endif

                <!-- ./col -->

                @if (Auth::user()->hasPermissionTo('view-user'))

                <div class="col-lg-3 col-6">

                    <!-- small box -->

                    <div class="small-box bg-danger">

                        <div class="inner">

                            <h3>{{ $totalUsers }}</h3>



                            <p>Total Users</p>

                        </div>

                        <div class="icon">

                            <i class="ion ion-person-add"></i>

                        </div>

                        <a href="{{ route('users') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>

                    </div>

                </div>

            </div>

            @endif

            <!-- /.row -->

            <!-- Main row -->


            <div class="row">
                @if (Auth::user()->hasPermissionTo('view-workshop'))
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-6">
                                        <h4 class="dashboard-title center-sm mb-0">Recent Workshops</h4>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="btn-align">
                                            <a class="btn btn-outline-primary sm" href="{{ route('workshops') }}">
                                                <i class="fas fa-warehouse mr-1"></i>
                                                Workshops
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive dashboard">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                              <th>Workshop Name</th>
                                              <th>Contact Person Name</th>
                                              <th class="p-0">Contact Person Telephone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentWorkshops as $workshopData)
                                                <tr class="clickable-row" data-href="{{ route('workshop.show', $workshopData->workshop_id) }}">
                                                  <td>{{ $workshopData->workshop_name }}</td>
                                                  <td>{{ $workshopData->organizer_name }}</td>
                                                  <td class="p-0">{{ $workshopData->organizer_contact }}</td>
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
                    @if (Auth::user()->hasPermissionTo('view-insurance-company'))
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-8">
                                        <h4 class="dashboard-title center-sm mb-0">Recent Insurance Companies</h4>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="btn-align">
                                            <a class="btn btn-outline-primary sm" href="{{ route('insurance-companies') }}">
                                                <i class="fas fa-handshake mr-1"></i>
                                                Companies
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive dashboard">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                              <th>Company Name</th>
                                              <th>Telephone</th>
                                              <th>Comapny Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentInsuranceCompanies as $companyData)
                                                <tr class="clickable-row" data-href="{{ route('insurance-company.show', $companyData->ic_id) }}">
                                                  <td>{{ $companyData->icompany_name }}</td>
                                                  <td>{{ $companyData->icompany_reg_no }}</td>
                                                  <td>{{ $companyData->icompany_address }}</td>
                                                </tr>
                                            @endforeach
                                            </tr>
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
       $(function() {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
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
