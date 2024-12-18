@extends('layouts.app')

@section('admincontent')



    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Edit Insurance</h1>

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
                            action="{{ route('insurance.update', $insurance->insurance_id) }}">

                            @csrf

                            <div class="card-body">

                                <!-- <div class="row">

                                <div class="col-md-6">

                              <div class="form-group">

                                <label>Vehicle</label>

                                <select  onchange="FetchCarInsurance.call(this, event)" name="vehicle_reg_id" class="form-control">

                                  <option>Select Vehicle</option>

                                  @foreach ($vehicle as $vehicleData)
    <option <?= $vehicleData->vehicle_id == $insurance->vehicle_reg_id ? 'selected' : '' ?> value="{{ $vehicleData->vehicle_id }}">{{ $vehicleData->fuel_type }} {{ $vehicleData->vehicle_registration_no }}</option>
    @endforeach

                                </select>

                              </div>

                             </div>

                             <div class="col-md-6">

                              <div class="form-group">

                                <label>Vehicle Owner</label>

                                <select class="form-control car_model custom_dropDownArrow" name="owner"  id="carModels">

                                     @foreach ($owner as $ownerData)
    <option <?= $ownerData->customer_id == $insurance->owner_id ? 'selected' : '' ?> value="{{ $ownerData->customer_id }}">{{ $ownerData->c_first_name }}</option>
    @endforeach

                                </select>

                            </div>



                             </div>

                             </div> -->

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Vehicle<span aria-hidden="true" class="required">*</span></label>

                                            <select onchange="FetchCarInsurance.call(this, event)" name="vehicle_reg_id"
                                                class="form-control">

                                                <option>Select Vehicle</option>

                                                @foreach ($vehicle as $vehicleData)
                                                    <option value="{{ $vehicleData->vehicle_id }}"
                                                        @if ($vehicleData->vehicle_id == $insurance->vehicle_reg_id)
                                                            selected
                                                        @endif
                                                        >
                                                        {{ $vehicleData->vehicle_registration_no }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Vehicle Owner<span aria-hidden="true" class="required">*</span></label>

                                            <div class="dropdown-container">

                                                <select class="form-control car_model custom_dropDownArrow" name="owner"
                                                    id="carModels">
                                                    <option>Select Owner</option>
                                                    @foreach ($owner as $ownerData)
                                                        <option value="{{ $ownerData->customer_id }}"
                                                            @if ($ownerData->customer_id == $insurance->owner_id)
                                                                selected
                                                            @endif
                                                            >
                                                            {{ $ownerData->c_first_name }} @if ($ownerData->c_last_name != null){{ $ownerData->c_last_name }} @endif
                                                        </option>
                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>



                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Insurance Company<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <select required name="inurance_company" class="form-control">

                                                <option>Select Insurance Company</option>

                                                @foreach ($insurance_company as $insuranceCompany)
                                                    <option
                                                        <?= $insuranceCompany->ic_id == $insurance->insurance_company_id ? 'selected' : '' ?>
                                                        value="{{ $insuranceCompany->ic_id }}">
                                                        {{ $insuranceCompany->icompany_name }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputPhone1">Policy Number<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="text" name="policy_number"
                                                value="{{ $insurance->policy_number }}" id="policy_number" required
                                                class="form-control" placeholder="Policy Number">

                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone1">Insurance Premium<span aria-hidden="true"
                                                    class="required">*</span></label>
                                            <input type="number" name="insurance_premium" step="0.01"
                                                value="{{ $insurance->insurance_premium }}" id="insurance_premium" required
                                                class="form-control" placeholder="Insurance Premium">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Insurance Premium Direct Debit<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="number" required value="{{ $insurance->ins_prem_direct_debit }}"
                                                id="ins_prem_direct_debit" name="ins_prem_direct_debit" class="form-control"
                                                placeholder="Insurance Premium Direct Debit">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputPassword1">Insurance Start Date<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" required value="{{ date('d-m-Y', strtotime($insurance->insurance_start_date)) }}"
                                                id="insurance_start_date" name="insurance_start_date"
                                                class="date-input form-control" placeholder="Insurance Start Date">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputPassword1">Insurance End Date<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" required value="{{ date('d-m-Y', strtotime($insurance->insurance_end_date)) }}"
                                                id="insurance_end_date" name="insurance_end_date"
                                                class="date-input form-control" placeholder="Insurance End Date">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Payment Method<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <select required id="payment_method_select" name="payment_method_id"
                                                onchange="bankChange()" class="form-control">

                                                <option value="">Select Payment Method</option>

                                                <option value="0"
                                                @if ($insurance->payment_method_id == 0)
                                                    selected
                                                @endif
                                                >Bank direct debit </option>

                                                <option value="1"
                                                @if ($insurance->payment_method_id == 1)
                                                    selected
                                                @endif
                                                > Card (Debit/Credit) </option>

                                            </select>

                                            <!-- <input type="text" autocomplete="payment_method_id" required value="{{ old('payment_method_id') }}" id="payment_method_id" name="payment_method_id" class="form-control"  placeholder="Payment Method Id"> -->

                                        </div>

                                    </div>

                                    <div class="col-md-6 showBsb"
                                    @if ($insurance->payment_method_id == 0)
                                        style="display: block;"
                                    @else
                                        style="display: none;"
                                    @endif>

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">BSB</label>

                                            <input type="number" autocomplete="bsb" required
                                                value="{{ $insurance->bsb }}" id="bsb" name="bsb"
                                                class="form-control" placeholder="Enter Last Four Digit">

                                        </div>

                                    </div>

                                    <div class="col-md-6 showLastFourDigit"
                                    @if ($insurance->payment_method_id == 0)
                                        style="display: none;"
                                    @else
                                        style="display: block;"
                                    @endif>


                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Last Four Digit</label>

                                            <input type="number" autocomplete="four_digit"
                                                value="{{ $insurance->four_digit }}" id="four_digit" name="four_digit"
                                                class="form-control" placeholder="Enter Last Four Digit">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6  showAccountName"
                                        style="display: block;"
                                    >

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Account Name<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" autocomplete="account_name" required
                                                value="{{ $insurance->account_name }}" id="account_name"
                                                name="account_name" class="form-control" placeholder="Account Name">

                                        </div>

                                    </div>

                                    <div class="col-md-6  showAccounNumber"
                                    @if ($insurance->payment_method_id == 0)
                                        style="display: block;"
                                    @else
                                        style="display: none;"
                                    @endif>

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Account Number<span
                                                    aria-hidden="true" class="required">*</span></label>

                                            <input type="text" autocomplete="account_no" required
                                                value="{{ $insurance->account_no }}" id="account_no" name="account_no"
                                                class="form-control" placeholder="Account Number">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">Update Insurance</button>

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

@endsection

@section('script')
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

    $(document).ready(function() {

        bankChange();

    });
</script>
@endsection
