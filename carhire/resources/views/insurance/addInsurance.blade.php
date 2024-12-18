@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Add Insurance</h1>

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

                        <form method="POST" enctype="multipart/form-data" action="{{ route('insurance.store') }}"
                            aria-label="{{ __('save-insurance') }}">

                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Vehicle<span aria-hidden="true" class="required">*</span></label>

                                            <input type="text" autocomplete="vehicle_reg_id" required
                                                value="{{ $vehicle->vehicle_registration_no  }}" id="vehicle_reg_id"
                                                 class="form-control" readonly
                                                placeholder="Vehicle Registration Number">
                                            <input type="hidden" name="vehicle_reg_id" value="{{ $vehicle->vehicle_id }}">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Vehicle Owner<span aria-hidden="true" class="required">*</span></label>

                                            <input class="form-control"
                                            id="carModels" value="{{ $vehicle->vehicle_owner->c_first_name }} @if ($vehicle->vehicle_owner->c_last_name != null){{ $vehicle->vehicle_owner->c_last_name }}@endif" readonly>
                                            <input type="hidden"  name="owner" value="{{ $vehicle->vehicle_owner->customer_id }}">
                                        </div>



                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Insurance Company<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <select required name="inurance_company" class="form-control">

                                                <option value="">Select Insurance Company</option>

                                                @foreach ($insurance_company as $insuranceCompany)
                                                    <option value="{{ $insuranceCompany->ic_id }}">
                                                        {{ $insuranceCompany->icompany_name }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="policy_number">Policy Number<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" autocomplete="policy_number" name="policy_number"
                                                value="{{ old('policy_number') }}" id="policy_number" required
                                                class="form-control" placeholder="Policy Number">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="insurance_premium">Insurance Premium<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="number" autocomplete="insurance_premium" name="insurance_premium" step="0.01"
                                                value="{{ old('insurance_premium') }}" id="insurance_premium" required
                                                class="form-control" placeholder="Insurance Premium">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="ins_prem_direct_debit">Insurance Premium Direct Debit<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="number" autocomplete="ins_prem_direct_debit" required
                                                value="{{ old('ins_prem_direct_debit') }}" id="ins_prem_direct_debit"
                                                name="ins_prem_direct_debit" class="form-control"
                                                placeholder="Insurance Premium Direct Debit" min="1" max="31">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="insurance_start_date">Insurance Start Date<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" autocomplete="insurance_start_date" required
                                                value="{{ old('insurance_start_date') }}" id="insurance_start_date"
                                                name="insurance_start_date" class="date-input form-control"
                                                placeholder="Insurance Start Date">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="insurance_end_date">Insurance End Date<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" autocomplete="insurance_end_date" required
                                                value="{{ old('insurance_end_date') }}" id="insurance_end_date"
                                                name="insurance_end_date" class="date-input form-control"
                                                placeholder="Insurance End Date">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="payment_method_id">Payment Method<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <select id="payment_method_select" required name="payment_method_id"
                                                onchange="bankChange()" class="form-control">

                                                <option value="">Select Payment Method</option>

                                                <option value="0">Bank direct debit </option>

                                                <option value="1">Card (Debit/Credit)</option>

                                            </select>



                                        </div>

                                    </div>

                                    <div class="col-md-6 showBsb" style="display: none">

                                        <div class="form-group">

                                            <label for="bsb">BSB<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="number" autocomplete="bsb" required
                                                value="{{ old('bsb') }}" id="bsb" name="bsb"
                                                class="form-control" placeholder="Enter BSB">

                                        </div>

                                    </div>

                                    <div class="col-md-6 showLastFourDigit" style="display: none">

                                        <div class="form-group">

                                            <label for="four_digit">Last Four Digit<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="number" required autocomplete="four_digit"
                                                value="{{ old('four_digit') }}" id="four_digit" name="four_digit"
                                                class="form-control" placeholder="Enter Last Four Digit">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6  showAccountName" style="display: none">

                                        <div class="form-group">

                                            <label for="account_name">Account Name<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" required autocomplete="account_name"
                                                value="{{ old('account_name') }}" id="account_name" name="account_name"
                                                class="form-control" placeholder="Account Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6  showAccounNumber" style="display: none">

                                        <div class="form-group">

                                            <label for="account_no">Account Number<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" autocomplete="account_no" required
                                                value="{{ old('account_no') }}" id="account_no" name="account_no"
                                                class="form-control" placeholder="Account Number">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">Save</button>

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
        function bankChange() {

            var selectedValue = $('#payment_method_select').find(":selected").val();

            if (selectedValue == 0) {

                $('.showBsb').css('display', 'block');

                $('.showAccountName').css('display', 'block');

                $('.showAccounNumber').css('display', 'block');

                $('.showLastFourDigit').css('display', 'none');



                $('#bsb').prop('required', 'true');

                $('#account_no').prop('required', 'true');

                $('#account_name').prop('required', 'true');



                $('#four_digit').prop('required', '');
                $('#four_digit').val('');



            } else {



                $('.showLastFourDigit').css('display', 'block');

                $('.showAccountName').css('display', 'block');

                $('.showBsb').css('display', 'none');

                $('.showAccounNumber').css('display', 'none');



                $('#account_name').prop('required', 'true');

                $('#four_digit').prop('required', 'true');

                $('#bsb').prop('required', '');
                $('#bsb').val('');

                $('#account_no').prop('required', '');
                $('#account_no').val('');



            }

        }

        function FetchCarInsurance(event) {

            var carID = this.options[this.selectedIndex].value;

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type: 'POST',

                url: "{{ route('fetch-car-owner') }}",

                data: {

                    id: carID

                },

                success: function(response) {

                    obj1 = JSON.parse(response);

                    if (obj1.success == 1)

                    {

                        console.log(obj1.model);

                        var modelData = obj1.model;

                        var assetsHtml = '';

                        $('#carModels').html();

                        // assetsHtml+='<option value="">Select Owner </option>';

                        for (var i = 0; i < modelData.length; i++) {

                            assetsHtml += '<option value="' + modelData[i].customer_id + '">' + modelData[i]
                                .c_first_name + ' ' + modelData[i].c_last_name + '</option>';

                        }

                        $("#carModels").html(assetsHtml);

                    }



                }

            });

        }
    </script>

@endsection
