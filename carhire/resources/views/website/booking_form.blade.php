@extends('website.layouts.app')

@section('content')
    <div class="container my-5 pe-0">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9">
                <form id="bookingForm" enctype="multipart/form-data" onsubmit="">
                    @csrf
                    <div class="row bg-white p-md-5 py-5">
                        <h4>Booking Information</h4>
                        <div class="row mt-2">
                            <div class="col-12 col-md-6 mt-3">
                                <label class="form-label input-label">Start Date<span class="required">*</span></label>
                                <input type="date" value="{{ old('starting_date', $startDate ?? date('Y-m-d')) }}"
                                    required class="date-input form-control" placeholder="Start Date" id="start_date"
                                    onchange="dateValidation()" />
                                <input type="hidden" id="starting_date" value="" name="starting_date">
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <label class="form-label input-label">End Date</label><span class="required">*</span>
                                <input type="date" value="{{ old('ending_date', $endDate ?? date('Y-m-d')) }}"
                                    class="date-input form-control" placeholder="End Date" required id="end_date"
                                    onchange="dateValidation()" />
                                <input type="hidden" id="ending_date" value="" name="ending_date">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <span class="text-danger" id="error-message"></span>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <label class="form-label input-label" for="">Comments</label>
                                <input type="type" value="{{ old('comments') }}" id="comments" name="comments"
                                    class="form-control" placeholder="Comments">
                            </div>
                        </div>
                        <input type="hidden" name="amount" value="{{ $vehicle->admin_fee }}">
                        <input type="hidden" required name="vehicle_reg_id" id="vehicle_reg_id"
                            value="{{ $vehicle->vehicle_id }}">
                        <input type="hidden" required name="driver_id" id="driver_id"
                            value="{{ Auth::user()->driver->driver_id }}">
                        <div class="mt-5 d-flex justify-content-end">
                            <button class="btn btn-danger submit-btn account-update-btn rounded-0"
                                id="booking-form-submit-btn" type="submit">Continue</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Side Column -->
            <div class="ps-3 col-12 col-md-4 col-lg-3 my-md-0 my-5">
                <div class="py-5 px-2 bg-white">
                    <div>
                        <div class="text-center mt-3">
                            <img src="{{ asset('panelslayout/website/assets/images/landing-page/car_placeholder_3.svg') }}"
                                alt="{{ $vehicle->vehicle_registration_no }}" class="w-75">
                            <h6 class="fs-6 fw-bold mt-4">{{ $brand }} {{ $vehicle->vehicle_model }}</h6>
                            <span class="badge text-dark text-muted p-0 me-1"> <img
                                    src="/panelslayout/website/assets/icons/fuel-type.svg" alt="fueltype">
                                {{ strtoupper($vehicle->fuel_type) }}</span>
                            <span class="badge text-dark text-muted p-0 me-1"> <img
                                    src="/panelslayout/website/assets/icons/vehicle-type.svg" alt="fueltype">
                                {{ strtoupper($vehicle->vehicle_type) }}</span>
                        </div>
                    </div>
                    <hr class="m-4">
                    <div class="d-flex justify-content-center align-items-center py-5 border border-danger">
                        <div class="text-center">
                            <small class="text-muted">Weekly rent</small>
                            <h1 class="total-price"><span
                                    class="fs-3">$</span>{{ number_format((float) $vehicle->admin_fee, 2) }}</h1>
                        </div>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Booking Store
        $(document).ready(function() {
            restrictPastDates();
            // formatting the dates
            $('#starting_date').val(formatDate($('#start_date').val()));
            $('#ending_date').val(formatDate($('#end_date').val()));

            availabilityCheck();

            document.getElementById('bookingForm').addEventListener('submit', submitBookingForm(
                `{{ route('booking.store') }}`))

            $('#start_date').on('change', () => {
                $('#starting_date').val(formatDate($('#start_date').val()));
                $('#ending_date').val(formatDate($('#end_date').val()));
                if (dateValidation()) {
                    availabilityCheck();
                }
            })

            $('#end_date').on('change', () => {
                $('#starting_date').val(formatDate($('#start_date').val()));
                $('#ending_date').val(formatDate($('#end_date').val()));
                if (dateValidation()) {
                    availabilityCheck();
                }
            })
        });

        // display file input image
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
