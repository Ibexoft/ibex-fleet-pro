<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ibex - Car Rental - {{ auth()->user()->name }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('panelslayout/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('panelslayout/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('panelslayout/custom/css/custom.css?v=1.0.10') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('panelslayout/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('panelslayout/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('panelslayout/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed" id="main-body">
    <div class="wrapper">
        @if (request()->segment(1) != 'print-driver-profile')
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('panelslayout/dist/img/AdminLTELogo.png') }}"
                    alt="AdminLTELogo" height="60" width="60">
            </div>
        @endif
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!--   <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('dashboard') }}" class="nav-link {{ request()->segment(1) == 'dashboard' ? 'topnav' : '' }}">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('manager-deo-list') }}" class="nav-link {{ request()->segment(1) == 'manager-deo-list' ? 'topnav' : '' }} {{ request()->segment(1) == 'add-manager-deo' ? 'topnav' : '' }} {{ request()->segment(1) == 'edit-manager-deo' ? 'topnav' : '' }}">Deo Management</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('manager-client-list') }}" class="nav-link {{ request()->segment(1) == 'manager-client-list' ? 'topnav' : '' }}  {{ request()->segment(1) == 'add-manager-client' ? 'topnav' : '' }}  {{ request()->segment(1) == 'edit-manager-client' ? 'topnav' : '' }} {{ request()->segment(1) == 'view-manager-client-transaction' ? 'topnav' : '' }}">Client Management</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('manager-client-assets-list') }}" class="nav-link {{ request()->segment(1) == 'manager-client-assets-list' ? 'topnav' : '' }} {{ request()->segment(1) == 'add-manager-client-assets' ? 'topnav' : '' }}">Add Client Asset</a>
      </li>
    </ul> -->
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto nav-item-align">
                <!-- Settings icon -->
                <li class="nav-item">
                    @if (Auth::user()->hasPermissionTo('view-insurance-company') ||
                            Auth::user()->hasPermissionTo('view-owner') ||
                            Auth::user()->hasPermissionTo('view-user') ||
                            Auth::user()->hasPermissionTo('view-role') ||
                            Auth::user()->hasPermissionTo('view-workshop') ||
                            Auth::user()->hasPermissionTo('view-workshop-type') ||
                            Auth::user()->hasPermissionTo('view-maintenance-type'))
                        <a class="nav-link" href="{{ route('settings') }}" title="Settings">
                            <i class="fas fa-cog"></i>
                        </a>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" title="Profile">
                        <span>{{ implode(
                            '',
                            array_map(function ($word) {
                                return strtoupper($word[0]);
                            }, preg_split('/\s+/', auth()->user()->name)),
                        ) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile') }}" class="nav-item dropdown-item">
                            <i class="nav-icon fas fa-user-edit navbar-icon"></i>
                            <span class="float-center navbar-font">Profile</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a onclick="event.preventDefault();this.closest('form').submit();"
                                class="dropdown-item logout_admin">
                                <i class="nav-icon fas fa-sign-out-alt navbar-icon"></i>
                                <span class="float-center navbar-font">Log out</span>
                            </a>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" id="main-sidebar">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('panelslayout/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light ml-2">{{ config('app.name') }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('panelslayout/dist/img/test.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>
                <style>
                    .topnav {
                        color: #fff !important;
                        border-radius: 5px;
                    }

                    .childnav {
                        margin-left: 22px !important;
                    }
                </style>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (request()->segment(1) == 'settings')
                            @include('layouts.settingsSidebar')
                        @else
                            @include('layouts.mainSidebar')
                        @endif

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- /.content-header -->
            <!-- Main content -->
            @yield('admincontent')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer text-right">
            Copyright &copy; {{ date('Y') }} <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>.
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('panelslayout/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('panelslayout/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('panelslayout/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('panelslayout/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('panelslayout/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    {{-- <script src="{{ asset('panelslayout/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('panelslayout/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('panelslayout/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('panelslayout/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('panelslayout/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('panelslayout/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('panelslayout/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('panelslayout/dist/js/pages/dashboard.js') }}"></script> --}}
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('panelslayout/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('panelslayout/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('panelslayout/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- AdminLTE App -->
    <!-- <script src="{{ asset('panelslayout/dist/js/adminlte.min.js') }}"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('panelslayout/dist/js/demo.js') }}"></script>
    {{-- <script src="{{ asset('panelslayout/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('panelslayout/plugins/jquery-validation/additional-methods.min.js') }}"></script> --}}
    <script src="{{ asset('panelslayout/custom/js/custom.js?v=1.0.20') }}"></script>
    <script>
        @if (session('alert-success'))
            document.addEventListener('DOMContentLoaded', function() {
                swal.fire({
                    title: 'Success!',
                    text: '{{ session('alert-success') }}',
                    icon: 'success'
                });
            });
        @endif

        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages = '<ol>';
                @foreach ($errors->all() as $error)
                    errorMessages += '<li>{{ $error }}</li>';
                @endforeach
                errorMessages += '</ol>';

                swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: errorMessages,
                });
            });
        @endif

        @if (session('alert-danger'))
            document.addEventListener('DOMContentLoaded', function() {
                swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('alert-danger') }}'
                });
            });
        @endif
        @if (session('exception-type'))
            swal.fire("Access Denied!", "{{ session('message') }}", "error");
        @endif
        $(function() {
            $('#example2').DataTable({
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
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        })
        @if (Auth::user()->hasPermissionTo('view-back-date'))
            var minDate = null;
        @else
            var minDate = moment();
        @endif
        // Initialize the date picker with appropriate options
        $('.date-input').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            showMonthsShort: true,
            locale: {
                format: 'DD-MM-YYYY'
            },
            minDate: minDate
        });
    </script>
    @yield('script')
</body>

</html>
