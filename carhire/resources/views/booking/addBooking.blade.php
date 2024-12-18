@extends('layouts.app')

@section('admincontent')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .required {


            color: red;

        }
    </style>
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Add Booking</h1>

                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- left column -->

                <div class="col-md-12">

                    <!-- jquery validation -->

                    <div class="card card-primary">



                        <!-- /.card-header -->

                        <!-- form start -->

                        <form id="booking-form" enctype="multipart/form-data" onsubmit="">

                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Start Date<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" value="{{ old('starting_date') }}" id="starting_date"
                                                required name="starting_date" class="date-input form-control"
                                                placeholder="Start Date">

                                        </div>

                                    </div>

                                    <?php $today = date('Y-m-d'); ?>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <div class="showInput">

                                                <label for="exampleInputConfirmPassword1">End Date <span aria-hidden="true"
                                                        class="required">*</span></label>

                                                <input type="text" name="ending_date" value="{{ old('ending_date') }}"
                                                    class="date-input form-control" id="ending_date" placeholder="End Date"
                                                    required>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Vehicle<span aria-hidden="true" class="required">*</span></label>

                                            <select required name="vehicle_reg_id" id="vehicle_reg_id" class="form-control select2 err-tooltip">
                                                
                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Driver<span aria-hidden="true" class="required">*</span></label>

                                            <select required name="driver_id" id="driver_id" class="form-control select2 err-tooltip">

                                                <option value="">Select Driver</option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Weekly Rent<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="number" required value="{{ old('amount') }}" id="amount"
                                                min="0" max="99999999" step="0.01" name="amount"
                                                class="form-control" placeholder="Weekly Rent">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputConfirmPassword1">Comments</span></label>

                                            <input type="type" value="{{ old('comments') }}" id="comments"
                                                name="comments" class="form-control" placeholder="Comments">

                                        </div>

                                    </div>

                                </div>


                                <fieldset
                                    style="border: 1px solid #d3d3d3; margin-bottom: 10px; padding: 20px; border-radius: 3px;">

                                    <legend><b>Bond</b></legend>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label>Held By</label>

                                                <select name="bond_held" class="form-control select2 err-tooltip" id="bond_held">

                                                    <option value="">Bond Held By</option>

                                                    @foreach ($bond_held as $owner)
                                                        <option value="{{ $owner->customer_id }}"
                                                            @if (old('bond_held') == $owner->customer_id) selected @endif>
                                                            {{ $owner->c_first_name . ' ' . $owner->c_last_name }}</option>
                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="bond_amount">Amount</label>

                                                <input type="number"  value="{{ old('bond_amount') }}"
                                                    id="bond_amount" name="bond_amount" class="form-control"
                                                    placeholder="Amount" min="0" max="99999999" step="0.01">

                                            </div>

                                        </div>

                                    </div>

                                </fieldset>

                                <br>
                                <hr>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="card img-placeholder-card">
                                            <div id="contract_img_name" class="img-name" style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'contract_image')">
                                                <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                    id="contractPreviewImage" class="img-fluid"
                                                    alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="contract-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('contract_img_name', 'contractPreviewImage', 'contract-remove-container', 'contract_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group w-100">

                                            <label for="image">Contract<small> (PDF, JPEG, JPG and PNG
                                                    only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="contract_image" id="contract_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'contract_img_name', 'contractPreviewImage', 'contract-remove-container', 'contract_image')"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="card img-placeholder-card">
                                            <div id="ezidebit_img_name" class="img-name" style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'ezidebit_image')">
                                                <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                    id="ezidebitPreviewImage" class="img-fluid"
                                                    alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="ezidebit-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('ezidebit_img_name', 'ezidebitPreviewImage', 'ezidebit-remove-container', 'ezidebit_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1"><span id="radio-span">EziDebit
                                                    Form</span><small> (PDF, JPEG, JPG and PNG only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="ezidebit_image" id="ezidebit_image"
                                                    class="upload"
                                                    onchange="displayImage(event, 'ezidebit_img_name', 'ezidebitPreviewImage', 'ezidebit-remove-container' , 'ezidebit_image')"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="card img-placeholder-card">
                                            <div id="insurance_declaration_img_name" class="img-name"
                                                style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'insurance_declaration_image')">
                                                <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                    id="insurance_declarationPreviewImage" class="img-fluid"
                                                    alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="insurance_declaration-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('insurance_declaration_img_name', 'insurance_declarationPreviewImage', 'insurance_declaration-remove-container', 'insurance_declaration_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1"><span id="radio-span">Insurance
                                                    Declaration</span><small> (PDF, JPEG, JPG and PNG
                                                    only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="insurance_declaration_image"
                                                    id="insurance_declaration_image" class="upload"
                                                    onchange="displayImage(event, 'insurance_declaration_img_name', 'insurance_declarationPreviewImage', 'insurance_declaration-remove-container' , 'insurance_declaration_image')"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="card img-placeholder-card">
                                            <div id="handover_checklist_img_name" class="img-name"
                                                style="display: none;">
                                                <span class="name"></span>
                                            </div>
                                            <div class="card-body" ondragover="handleDragOver(event)"
                                                ondragleave="handleDragLeave(event)"
                                                ondrop="handleDrop(event, 'handover_checklist_image')">
                                                <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                    id="handover_checklistPreviewImage" class="img-fluid"
                                                    alt="document-placeholder">
                                            </div>
                                            <div class="card-footer" id="handover_checklist-remove-container"
                                                style="display: none;">
                                                <button type="button" class="btn btn-outline-danger btn-block sm"
                                                    onclick="removeDocImage('handover_checklist_img_name', 'handover_checklistPreviewImage', 'handover_checklist-remove-container', 'handover_checklist_image')">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group w-100">
                                            <label for="exampleInputPhone1"><span id="radio-span">Handover
                                                    Checklist</span><small> (PDF, JPEG, JPG and PNG
                                                    only)</small></label><br>
                                            <div class="ch-file-upload">
                                                <span>Choose File</span>
                                                <input type="file" name="handover_checklist_image"
                                                    id="handover_checklist_image" class="upload"
                                                    onchange="displayImage(event, 'handover_checklist_img_name', 'handover_checklistPreviewImage', 'handover_checklist-remove-container' , 'handover_checklist_image')"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Save</button>

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

    <!-- Modal -->
    <div class="modal w-100" tabindex="-1" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content booking-modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title">Confirm Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-primary" id="saveChangesButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var today = new Date();

        var dd = String(today.getDate()).padStart(2, '0');

        var mm = String(today.getMonth() + 1).padStart(2, '0');

        var yyyy = today.getFullYear();



        today = yyyy + '-' + mm + '-' + dd;

        $('#date_picker').attr('min', today);
    </script>

    <script type="text/javascript">
        function DateSelection() {

            var facility = $("#facility_id option:selected").val();

            // alert(facility);

            if (facility == 0) {

                $('#facility_id').css('display', 'none');

                $('.currentDate').css('display', 'block');

                $('#dateTypeCheck').val(facility);

            } else {



                $('#facility_id').css('display', 'none');

                $('.showInput').css('display', 'block');

                $('#dateTypeCheck').val(facility);

            }

        }

        function radioOnClick() {

            var facility = $('input[name="end"]:checked').val();

            // alert(facility);

            if (facility == 0) {



                $('#facility_id').css('display', 'none');

                $('.currentDate').css('display', 'block');

                $('.showInput').css('display', 'none');

                $('#dateTypeCheck').val(facility);

                $('.raios').css('display', 'none');



            } else {

                $('#facility_id').css('display', 'none');

                $('.showInput').css('display', 'block');

                $('.currentDate').css('display', 'none');

                $('.raios').css('display', 'none');



                $('#dateTypeCheck').val(facility);

            }

        }
    </script>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            showModalOnFormSubmit(`{{ asset('panelslayout/dist/img/pdf.png') }}`);
            submitFormOnSaveChanges(`{{ route('booking.store') }}`, `{{ route('bookings') }}`);

            availabilityCheck();

            // Add event listeners to the starting and ending date
            let previousStartingDate = $("#starting_date").val();
            let previousEndingDate = $("#ending_date").val();
            $('#starting_date').change(function() {
                if (parseStringDate($('#starting_date').val()) > parseStringDate($('#ending_date').val())) {
                    swal.fire("Error!", "The end date must be a date after or equal to start date.",
                        "error");
                    $("#starting_date").val(previousStartingDate);
                    $('#starting_date').data('daterangepicker').setStartDate(previousStartingDate);
                    $('#starting_date').data('daterangepicker').setEndDate(previousStartingDate);
                } else {
                    previousStartingDate = $("#starting_date").val();
                    availabilityCheck();
                }
            });

            $('#ending_date').change(function() {
                if (parseStringDate($('#starting_date').val()) > parseStringDate($('#ending_date').val())) {
                    swal.fire("Error!", "The end date must be a date after or equal to start date.",
                        "error");
                    $("#ending_date").val(previousEndingDate);
                    $('#ending_date').data('daterangepicker').setStartDate(previousEndingDate);
                    $('#ending_date').data('daterangepicker').setEndDate(previousEndingDate);
                } else {
                    previousEndingDate = $("#ending_date").val();
                    availabilityCheck();
                }
            });
        });

        // Select2
        $(document).ready(function() {
            initializeSelect2Dropdown("#vehicle_reg_id", "Select Vehicle");
            initializeSelect2Dropdown("#driver_id", "Select Driver");
            initializeSelect2Dropdown("#bond_held", "Bond Held");
        });
    </script>
    <script>
        function displayImage(event, nameId, prevImgId, removeId, imageId) {

            var previewImage = document.getElementById(prevImgId);
            previewImage.parentNode.classList.add('card-body-img');
            var imageName = document.getElementById(nameId);
            var imageNameChild = imageName.children[0];

            var removeContainer = document.getElementById(removeId);
            var image = document.getElementById(imageId);
            if (!image.value) {
                removeDocImage(nameId, prevImgId, removeId, imageId);
                return false;
            }
            let imageType = event.target.files[0].type;
            let fileName = event.target.files[0].name


            if (imageType === "application/pdf") {
                previewImage.src = "{{ asset('panelslayout/dist/img/pdf.png') }}";
            } else {
                previewImage.src = URL.createObjectURL(event.target.files[0])
            }

            imageNameChild.textContent = fileName;

            removeContainer.style.display = 'block'
            imageName.style.display = 'block'
        }

        function removeDocImage(nameId, prevImgId, removeId, imageId) {
            var image = document.getElementById(prevImgId);
            image.parentNode.classList.remove('card-body-img');
            var imageName = document.getElementById(nameId);
            var imageInput = document.getElementById(imageId);
            var removeContainer = document.getElementById(removeId);

            imageInput.value = ''; // Clear the file input
            image.src = "{{ asset('panelslayout/dist/img/placholder-img.jpg') }}";
            removeContainer.style.display = 'none';
            imageName.style.display = 'none';
        }
    </script>
@endsection
