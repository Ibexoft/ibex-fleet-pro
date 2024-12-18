@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
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
                                        <th>Name</th>
                                        @if (Auth::user()->hasAnyPermission(['edit-role', 'delete-role']))
                                        <th class="reduce-width"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role as $roleData)
                                        <tr 
                                        @if (Auth::user()->hasPermissionTo('edit-role'))
                                            class="clickable-row" data-href="{{ route('role.edit', $roleData->id) }}"
                                        @endif>
                                            @php $unserialize = json_decode($roleData->permissions)@endphp
                                            <td>R-{{str_pad($roleData->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $roleData->name }}</td>
                                            @if (Auth::user()->hasAnyPermission(['edit-role', 'delete-role']))
                                            <td class="reduce-width">
                                                <div class="dropdown">
                                                    <button class="action-button" type="button" id="actionsDropdown{{ $roleData->id }}"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!-- Three vertical dots icon -->
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionsDropdown{{ $roleData->id }}">
                                                    @if (Auth::user()->hasPermissionTo('edit-role'))
                                                        <a class="dropdown-item" href="{{ route('role.edit', $roleData->id) }}">
                                                            Edit
                                                        </a>
                                                    @endif
                                                        @if ($roleData->name !== 'Super-Admin' && Auth::user()->hasPermissionTo('delete-role'))
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteRoles({{ $roleData->id }},`{{ route('role.delete') }}`)">
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
                                        <th>Name</th>
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
                "searching": true,
                "ordering": true,
                "info": true,
                'lengthChange': false,
                'language': {
                    'search': 'Filter:',
                    'info': 'Total _TOTAL_ items',
                    'infoEmpty': 'Total 0 items',
                    'emptyTable': 'No data available in table',
                    'zeroRecords': 'No matching records found'
                },
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "<span><</span>",
                        "sNext": "<span>></span>"
                    }
                },
            });
            @if (Auth::user()->hasPermissionTo('create-role'))
                $("#example1_wrapper .dataTables_filter").append(`<a id="datatable-button" href="{{ route('role.create') }}" class="btn btn-primary btn-sm table-btn">Add Role</a>`);
            @endif
        });

    </script>
@endsection
