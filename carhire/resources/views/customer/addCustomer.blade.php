@extends('layouts.app')

@section('admincontent')
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Add Owner</h1>

                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->

    <style>
        .required {
            color: red;
        }

        .feildset-wrapper {
            border: 1px solid #d3d3d3;
            margin-bottom: 10px;
            padding: 20px;
            border-radius: 3px;
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

                        <form method="POST" id="create-form">

                            @csrf

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 col-12 col-md-6">
                                        <div class="form-group">

                                            <label>Entity Type<span aria-hidden="true" class="required">*</span></label>

                                            <select id="entity_type_select" required name="entity_type" class="form-control select2 err-tooltip"
                                                onchange="EntityType()">

                                                <option value="" id="select_none">Select Entity</option>

                                                <option value="Company">Company</option>

                                                <option value="Trust">Trust</option>

                                                <option value="Individual">Individual</option>

                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div id="field-container" class="d-none">
                                    <hr class="entity_hr">

                                    <fieldset class="feildset-wrapper entity_info">
                                        <legend><b id="entity_info">Company Info</b></legend>
                                        <div class="row">
                                            <div class="col-12 col-md-4 f_name" style="display: none;">
                                                <div class="form-group">
                                                    <label for="first_name">First Name<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="first_name" autocomplete="first_name"
                                                        required class="form-control" value="{{ old('first_name') }}"
                                                        id="f_name" placeholder="Enter First Name">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 l_name" style="display: none;">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="last_name" required autocomplete="last_name"
                                                        class="form-control" value="{{ old('last_name') }}" id="l_name"
                                                        placeholder="Enter Last Name">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 dob" style="display: none;">
                                                <div class="form-group">
                                                    <label for="date_of_birth">Date of Birth<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="date_of_birth"
                                                        value="{{ old('date_of_birth') }}" class="date-input form-control"
                                                        id="date_of_birth" placeholder="Enter Date of Birth" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 company_name">
                                                <div class="form-group">
                                                    <label for="company_name">Company Name<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="company_name" autocomplete="company_name"
                                                        required class="form-control" value="{{ old('company_name') }}"
                                                        id="company_name" placeholder="Enter Company Name">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 trust_name" style="display: none;">
                                                <div class="form-group">
                                                    <label for="trust_name">Trust Name<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="trust_name" autocomplete="trust_name"
                                                        required class="form-control" value="{{ old('trust_name') }}"
                                                        id="trust_name" placeholder="Enter Trust Name">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 entity_email">
                                                <div class="form-group">
                                                    <label for="email">Email<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="email" required name="email" autocomplete="email"
                                                        class="form-control" value="{{ old('email') }}" id="email"
                                                        placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 entity_phone">
                                                <div class="form-group">
                                                    <label for="contact">Telephone<span aria-hidden="true"
                                                            class="required">*</span>
                                                        <small>Format: XXXXXXXXXX</small></label>

                                                    <input type="tel" pattern="[0-9]{10}" name="contact"
                                                        autocomplete="contact" required class="form-control"
                                                        value="{{ old('contact') }}" id="phone"
                                                        placeholder="Enter Telephone">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="feildset-wrapper entity_address">
                                        <legend><b>Address Info</b></legend>
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="street">Street<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="street" autocomplete="street" required
                                                        class="form-control" value="{{ old('street') }}"
                                                        placeholder="Enter Street">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="suburb">Suburb<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="suburb" autocomplete="suburb"
                                                        class="form-control" value="{{ old('suburb') }}"
                                                        placeholder="Enter Suburb" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="state">State<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="text" name="state" autocomplete="state" required
                                                        class="form-control" value="{{ old('state') }}"
                                                        placeholder="Enter State" pattern="^[A-Za-z\s]+$">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Country<span aria-hidden="true"
                                                            class="required">*</span></label>
                                                    <select required name="country" class="form-control select2 err-tooltip" id="country">
                                                        <option value="">Select Country</option>
                                                        @foreach ($countries as $countries)
                                                            <option value="{{ $countries->countries_id }}"
                                                                @if ($countries->country_name == 'Australia') selected @endif>
                                                                {{ $countries->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="postal_code">Postal Code<span aria-hidden="true"
                                                            class="required">*</span></label>

                                                    <input type="number" name="postal_code" autocomplete="postal_code"
                                                        required class="form-control" value="{{ old('postal_code') }}"
                                                        placeholder="Enter Postal code" pattern="^\d+$">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="row">

                                        <div class="col-12 col-md-6 trustee_names" style="display: none;">
                                            <div class="form-group">

                                                <label>Trustee Type<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <div class="form-group clearfix text-center mt-2">
                                                    <div class="icheck-danger d-inline">
                                                        <input type="radio" name="radio_option" id="radio_individual"
                                                            value="Individual" checked>
                                                        <label for="radio_individual">Individual</label>
                                                    </div>
                                                    <div class="icheck-danger d-inline mr-2">
                                                        <input type="radio" name="radio_option" id="radio_company"
                                                            value="Company">
                                                        <label for="radio_company">Company</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 trustee_names" style="display: none;">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col" id="trustee_company_div">
                                                        <label>
                                                            Company
                                                            <span aria-hidden="true" class="required">*</span></label>
                                                        <select required id="trustee_company" name="trustee_company"
                                                            class="form-control">

                                                            <option value="">Select Company</option>

                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label>
                                                            <span id="trustee_label">Individual</span>
                                                            <span aria-hidden="true" class="required">*</span></label>
                                                        <select required id="trustee_contact_person"
                                                            name="trustee_contact_person" class="form-control">

                                                            <option value="">Select Contact Person</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 showCRN">

                                            <div class="form-group">

                                                <label for="crn">CRN<span aria-hidden="true"
                                                        class="required">*</span></label>

                                                <input required type="number" autocomplete="crn" name="crn"
                                                    class="form-control" value="{{ old('crn') }}" id="crn"
                                                    placeholder="Enter CRN" pattern="^\d+$">

                                            </div>

                                        </div>

                                        <div class="col-12 col-md-6 showACN">

                                            <div class="form-group">

                                                <label for="acn">ACN<span aria-hidden="true"
                                                        class="required">*</span></label>

                                                <input type="number" autocomplete="acn" required name="acn"
                                                    class="form-control" value="{{ old('acn') }}" id="acn"
                                                    placeholder="Enter ACN" pattern="^\d+$">

                                            </div>

                                        </div>

                                        <div class="col-12 col-md-6 showABN">

                                            <div class="form-group">

                                                <label for="abn">ABN<span aria-hidden="true"
                                                        class="required">*</span></label>

                                                <input required type="text" autocomplete="abn" name="abn"
                                                    class="form-control" value="{{ old('abn') }}" id="abn"
                                                    placeholder="Enter ABN">

                                            </div>

                                        </div>

                                        <div class="col-12 col-md-6 c_name">
                                            <div class="form-group">

                                                <label>Contact Person<span aria-hidden="true"
                                                        class="required">*</span></label>

                                                <select required name="company_contact_person" class="form-control"
                                                    id="company_contact_person">

                                                    <option value="">Select Contact Person</option>
                                                    @foreach ($owners as $owner)
                                                        <option value="{{ $owner->customer_id }}">
                                                            {{ $owner->c_first_name }}
                                                            @if ($owner->c_last_name != null)
                                                                {{ $owner->c_last_name }}
                                                            @endif
                                                        </option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">

                                                <label>Bond Eligibility<span aria-hidden="true"
                                                        class="required">*</span></label>
                                                <div class="form-group clearfix text-center mt-2">
                                                    <div class="icheck-danger d-inline">
                                                        <input type="radio" name="eligibility" id="eligible"
                                                            value="Eligible">
                                                        <label for="eligible">Eligible</label>
                                                    </div>
                                                    <div class="icheck-danger d-inline mr-2">
                                                        <input type="radio" name="eligibility" id="ineligible"
                                                            value="Ineligible" checked>
                                                        <label for="ineligible">Ineligible</label>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#create-form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('owner.store') }}",
                    type: 'POST',
                    data: formData,
                    beforeSend: function() {
                        swal.fire({
                            title: 'Please Wait',
                            html: 'Processing...',
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                swal.showLoading()
                            },
                            customClass: {
                                loader: 'custom-loader'
                            }
                        });
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            window.location.href = "{{ route('owners') }}";
                        } else {
                            swal.fire("Error", data.message, "error");
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        if (data.responseJSON && data.responseJSON.errors) {
                            const errors = data.responseJSON.errors;
                            let errorMessage = '';
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    const errorMessages = errors[key];
                                    errorMessages.forEach(message => {
                                        errorMessage += `${message}<br>`;
                                    });
                                }
                            }
                            swal.fire("Error", errorMessage, "error");
                        } else {
                            swal.fire("Error", "An error occurred", "error");
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
            $('input[type=radio][name=radio_option]').change(function() {
                console.log(this.value);
                PopulateContactPerson(this.value);
            });
            PopulateContactPerson('Individual');
        });

        $(document).ready(function() {
            initializeSelect2Dropdown("#entity_type_select", "Select Entity");
            removeSelect2Search("#entity_type_select");
            initializeSelect2Dropdown("#country", "Select Country");
        });
    </script>
@endsection