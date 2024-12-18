@extends('layouts.app')
@section('admincontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insurance Companies</h1>
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
                                            <th>Company Name</th>
                                            <th>Telephone</th>
                                            <th>Company Address</th>
                                            <th class="p-0">Status</th>
                                            @if (Auth::user()->hasAnyPermission(['edit-insurance-company', 'delete-insurance-company']))
                                                <th class="reduce-width"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($incompanyList as $companyData)
                                            <tr class="clickable-row"
                                                data-href="{{ route('insurance-company.show', $companyData->ic_id) }}">
                                                <td>IC-{{str_pad($companyData->ic_id, 5, '0', STR_PAD_LEFT)}}</td>
                                                <td>{{ $companyData->icompany_name }}</td>
                                                <td>{{ $companyData->icompany_reg_no }}</td>
                                                <td>{{ $companyData->icompany_address }}</td>
                                                <td class="p-0">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input insuranceSwitch1"
                                                                data-url="{{ route('insurance-company.status') }}"
                                                                id="<?php echo $companyData->ic_id; ?>" type="checkbox" <?php echo $companyData->is_active == 1 ? 'checked' : ''; ?>
                                                                value="<?php echo $companyData->is_active == 1 ? 0 : 1; ?>"><label
                                                                class="custom-control-label"
                                                                for="{{ $companyData->ic_id }}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                @if (Auth::user()->hasAnyPermission(['edit-insurance-company', 'delete-insurance-company']))
                                                    <td class="reduce-width">
                                                        <div class="dropdown">
                                                            <button class="action-button" type="button"
                                                                id="actionsDropdown{{ $companyData->ic_id }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <!-- Three vertical dots icon -->
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="actionsDropdown{{ $companyData->ic_id }}">
                                                                @if (Auth::user()->hasPermissionTo('edit-insurance-company'))
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('insurance-company.edit', $companyData->ic_id) }}">
                                                                        Edit
                                                                    </a>
                                                                @endif
                                                                @if (Auth::user()->hasPermissionTo('delete-insurance-company'))
                                                                    <a class="dropdown-item text-danger" href="#"
                                                                        onclick="deleteIncompanyConfirmation({{ $companyData->ic_id }},`{{ route('insurance-company.delete') }}`)">
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
                                            <th>Company Name</th>
                                            <th>Telephone</th>
                                            <th>Company Address</th>
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
    <script type="text/javascript">
        $(".insuranceSwitch1").click(function() {
            if ($(this).prop("checked") == true) {
                var id = $(this).attr("id");
                status = 1;
            } else if ($(this).prop("checked") == false) {
                var id = $(this).attr("id");
                status = 0;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('insurance-company.status') }}",
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    console.log(data.success);
                    obj1 = JSON.parse(data);
                    if (obj1.success == 1) {
                        $('.successAlert').css('display', 'block');
                        $(".successMessage").html(obj1.message);
                        window.setInterval('location.reload()', 5000);
                    }
                }
            });
        });

        function deleteIncompanyConfirmation(id) {
            swal.fire({
                title: "Delete?",
                icon: 'question',
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('insurance-company.delete') }}",
                        data: {
                            id: id
                        },
                        success: function(resp) {
                            if (resp.success) {
                                swal.fire("Done!", resp.message, "success");
                                window.setInterval('location.reload()', 5000);
                            } else {
                                swal.fire("Error!", 'Sumething went wrong.', "error");
                            }
                        },
                        error: function(resp) {
                            swal.fire("Error!", 'Sumething went wrong.', "error");
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            })
        }
    </script>
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
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "<span><</span>",
                        "sNext": "<span>></span>"
                    }
                },
                
            });
            @if (Auth::user()->hasPermissionTo('create-insurance-company'))
                $("#example1_wrapper .dataTables_filter").append(
                    `<a id="datatable-button" href="{{ route('insurance-company.create') }}" class="btn btn-primary btn-sm table-btn">Add Company</a>`
                    );
            @endif
        });
    </script>
@endsection
