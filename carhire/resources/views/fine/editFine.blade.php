@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Fine</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <style>
        /* apply CSS to the select tag of
                             .dropdown-container div*/
        .dropdown-container select {
            /* for Firefox */
            -moz-appearance: none;
            /* for Safari, Chrome, Opera */
            -webkit-appearance: none;
        }

        /* for IE10 */
        .dropdown-container select::-ms-expand {
            display: none;
        }

        .required {
            color: red;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('fine.update', $fine->fine_id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Offence Date<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="date_of_offence" required
                                                class="date-input form-control"
                                                value="{{ date('d-m-Y', strtotime($fine->date_of_offence)) }}"
                                                id="date_of_offence" placeholder="Enter Date of Offence">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vehicle<span aria-hidden="true" class="required">*</span></label>
                                            {{-- <select name="vehicle_reg_id" class="form-control"> --}}
                                            <select onchange="FetchDriver.call(this, event)" name="vehicle_reg_id"
                                                id="vehicle_reg_id" class="form-control select2 err-tooltip" required>
                                                <option>Select Vehicle</option>
                                                @foreach ($vehicle as $vehicleData)
                                                    <option
                                                        <?= $vehicleData->vehicle_id == $fine->vehicle_reg_id ? 'selected' : '' ?>
                                                        value="{{ $vehicleData->vehicle_id }}">
                                                        {{ $vehicleData->vehicle_registration_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Amount<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="number" name="amount" required class="form-control"
                                                value="{{ $fine->amount }}" id="amount" placeholder="Enter Amount"
                                                min="0" max="99999999" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Notice Number<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" required name="notice" class="form-control"
                                                value="{{ $fine->notice }}" id="notice"
                                                placeholder="Enter Notice Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Notice Type<span aria-hidden="true" class="required">*</span></label>
                                            <select required name="notice_type" class="form-control select2 err-tooltip"
                                                id="notice_type" onchange="toggleNoticeType()">
                                                @foreach ($notice_types as $key => $notice_type)
                                                    <option value="{{ $key }}"
                                                        @if ((int) $fine->notice_type === (int) $key) selected @endif>
                                                        {{ $notice_type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="council-name-field">
                                        <div class="form-group">
                                            <label for="council_name">Council Name<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="council_name" autocomplete="council_name"
                                                class="form-control"
                                                value="{{ isset($fine->notice_type_details['3']) ? $fine->notice_type_details['3'] : '' }}"
                                                id="council_name" placeholder="Enter Council Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="recovery-company-field">
                                        <div class="form-group">
                                            <label for="recovery_company">Recovery Company<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="recovery_company" autocomplete="recovery_company"
                                                class="form-control"
                                                value="{{ isset($fine->notice_type_details['4']) ? $fine->notice_type_details['4'] : '' }}"
                                                id="recovery_company" placeholder="Enter Recovery Company">
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="police-state-field">
                                        <div class="form-group">
                                            <label for="police_state">Police State<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <select name="police_state" class="form-control select2 err-tooltip"
                                                id="police_state">
                                                <option value="" disabled>Select Police State</option>
                                                @foreach ($police_states as $police_state)
                                                    <option value="{{ $police_state }}"
                                                        @if (isset($fine->notice_type_details['2']) && $fine->notice_type_details['2'] === $police_state) selected @endif>
                                                        {{ $police_state }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Due Date<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="due_date" required
                                                class="date-input form-control"
                                                value="{{ date('d-m-Y', strtotime($fine->due_date)) }}" id="due_date"
                                                placeholder="Enter Due Date">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Date Process<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="date_process" required
                                                class="date-input form-control"
                                                value="{{ date('d-m-Y', strtotime($fine->date_process)) }}"
                                                id="date_process" placeholder="Enter Date Process">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status<span aria-hidden="true" class="required">*</span></label>
                                            <select required name="status" class="form-control select2 err-tooltip"
                                                id="status" onchange="toggleCommentField()">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status }}"
                                                        {{ old('status', $fine->status) === $status ? 'selected' : '' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="comment-field">
                                        <div class="form-group">
                                            <label for="comment">Comment<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="comment" class="form-control"
                                                value="{{ $fine->comment }}" id="comment" placeholder="Enter Comment">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Fine</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <br><br>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <script type="text/javascript">
        function init() {
            var input = document.getElementById('company_address');
            var autocomplete = new google.maps.places.Autocomplete(input);
        }
        google.maps.event.addDomListener(window, 'load', init);

        function FetchDriver(event) {
            var carID = this.options[this.selectedIndex].value;
            FetchOwner(carID);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('fetch-driver') }}",
                data: {
                    id: carID
                },
                success: function(response) {
                    obj1 = JSON.parse(response);
                    if (obj1.success == 1) {
                        console.log(obj1.model);
                        var modelData = obj1.model;
                        var assetsHtml = '';
                        $('#carModels').html();
                        // assetsHtml+='<option value="">Select Owner </option>';
                        for (var i = 0; i < modelData.length; i++) {
                            assetsHtml += '<option value="' + modelData[i].driver_id + '">' + modelData[i]
                                .first_name + '</option>';
                        }
                        $("#carModels").html(assetsHtml);
                    }
                }
            });
        }

        function FetchOwner(carID) {
            //var carID= this.options[this.selectedIndex].value;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('fetch-owner') }}",
                data: {
                    id: carID
                },
                success: function(response) {
                    obj2 = JSON.parse(response);
                    if (obj2.success == 1) {
                        console.log(obj2.model);
                        var model_Data = obj2.model;
                        var assets_Html = '';
                        $('#carowner').html();
                        // assetsHtml+='<option value="">Select Owner </option>';
                        for (var i = 0; i < model_Data.length; i++) {
                            assets_Html += '<option value="' + model_Data[i].customer_id + '">' + model_Data[i]
                                .c_first_name + '</option>';
                        }
                        $("#carowner").html(assets_Html);
                    }
                }
            });
        }
    </script>
@endsection

@section('script')
    <script>
        // Select2
        $(document).ready(function() {
            initializeSelect2Dropdown("#vehicle_reg_id", "Select Vehicle");
            initializeSelect2Dropdown("#notice_type", "Select Notice Type");
            toggleCommentField();
            toggleNoticeType();
        });
    </script>
@endsection
