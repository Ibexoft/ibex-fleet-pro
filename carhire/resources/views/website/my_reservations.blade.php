@extends('website.layouts.app')


@section('content')
    <div class="container mt-5 pe-0">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9 py-5 px-lg-5  px-4 bg-white order-md-1 order-2">
                <h4 class="mb-5">My Reservations</h4>
                @if ($bookings->isEmpty())
                    <div class="text-center">
                        <img class="w-25" src={{ asset('panelslayout/website/assets/images/no_reservations.svg') }}
                            alt="Empty_canvas">
                        <h4 class="text-center text-muted mt-4">No bookings found.</h4>
                        <p class="text-center text-muted mt-1">It looks like there are no car reservations at the moment.
                            <a href="{{ route('vehicles.search') }}">Explore our available options. <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </a>
                        </p>

                    </div>
                @else
                    <div class="d-lg-block d-none">
                        <div class="row p-2 bg-light mb-2">
                            <div class="col-lg-4 text-center">Vehicle Information</div>
                            <div class="col-lg-5 text-center">Rental Information</div>
                            <div class="col-lg-3 text-center">Pricing</div>
                        </div>
                    </div>
                @endif
                @foreach ($bookings as $booking)
                    <div class="reservation-card mb-4 row p-0 border">
                        <div class="col-lg-4 text-center py-2 d-flex align-items-center justify-content-center">
                            <div>
                                <div class="d-lg-block d-none">
                                    <img src="panelslayout/website/assets/images/landing-page/car_placeholder_3.svg"
                                        alt="Audi A7 Sportback" class="car-image">
                                </div>
                                <div class="d-lg-none d-block">
                                    <img src="panelslayout/website/assets/images/landing-page/car_placeholder_3.svg"
                                        alt="Audi A7 Sportback" class="w-50">
                                </div>
                                <h5 class="fw-bold text-center mt-4">{{ $booking->brand_name }}
                                    {{ $booking->vehicle_model }}</h5>
                                <span class="badge text-dark text-muted p-0 me-1"> <img
                                        src="panelslayout/website/assets/icons/fuel-type.svg" alt="fueltype">
                                    {{ strtoupper($booking->fuel_type) }}</span>
                                <span class="badge text-dark text-muted p-0 me-1"> <img
                                        src="panelslayout/website/assets/icons/vehicle-type.svg" alt="fueltype">
                                    {{ strtoupper($booking->vehicle_type) }}</span>
                                <span class="badge text-dark text-muted p-0 me-1"> <img
                                        src="panelslayout/website/assets/icons/color.svg" alt="vehicle-color">
                                    {{ strtoupper($booking->vehicle_color) }}</span>
                            </div>
                        </div>
                        <div class="col-lg-5 py-2" id="info-col">
                            <div class="row py-3 mt-lg-0 mt-3 d-flex justify-content-center">
                                <div class="px-3 row mb-xl-4 mb-2">
                                    <div class="d-flex col-xl-6 col-12 mt-3">
                                        <div class="me-2">
                                            <img src="panelslayout/website/assets/icons/car-in-icon.svg" alt="start-date">
                                        </div>
                                        <div class="text">
                                            <div class="date font-weight-bold">
                                                <strong>{{ date('d-m-Y', strtotime($booking->start_date)) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex col-xl-6 col-12 mt-3">
                                        <div class="me-2">
                                            <img src="panelslayout/website/assets/icons/car-out-icon.svg" alt="end-date">
                                        </div>
                                        <div class="text">
                                            <div class="date font-weight-bold">
                                                <strong>{{ date('d-m-Y', strtotime($booking->end_date)) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-xl-5 mt-2 px-4 border-top pt-2">
                                    <small class="extra-options">
                                        <strong>Booked On:</strong>
                                        {{ date('d-m-Y h:i A', strtotime($booking->booking_created_at)) }}
                                    </small> &nbsp; &nbsp;
                                    <small class="extra-options">
                                        <strong>Serial no:</strong>
                                        B-{{ str_pad($booking->booking_id, 5, '0', STR_PAD_LEFT) }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex justify-content-center align-items-center text-center p-2">
                            <div>
                                <small class="text-muted">Weekly Rent</small>
                                <div class="d-flex justify-content-center">
                                    <h1 class="p-0 m-0 total-price"><span
                                            class="fs-3">$</span>{{ number_format((float) $booking->amount, 2) }}
                                    </h1>
                                </div>
                                <button class="btn btn-primary reservation-code rounded-pill fw-bold mt-2 px-4 py-2"
                                    type="submit">{{ $booking->vehicle_registration_no }}</button>
                                @if ($booking->status == 'Pending')
                                    <p class="text-success fw-bold mt-2 text-warning"> {{ $booking->status }} <i
                                            class="bi bi-hourglass-split me-2"></i></p>
                                @elseif($booking->status == 'Booked')
                                    <p class="fw-bold mt-2 text-primary"> {{ $booking->status }} <i
                                            class="bi bi-journal-check"></i></p>
                                @elseif($booking->status == 'Completed')
                                    <p class="fw-bold mt-2 text-success"> {{ $booking->status }} <i
                                            class="bi bi-check-circle me-2"></i></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 col-md-4 col-lg-3 my-md-0 my-5 order-md-2 order-1">
                <div class="pb-5 text-white account-profile-card">
                    <div class="img-container text-center pt-5 px-5">
                        <h4 class="mb-3 text-truncate text-white">Hi,<br> {{ auth()->user()->name }}!</h4>
                    </div>
                    <div class="mt-2 pt-2">
                        <ul class="text-white p-0">
                            <hr class="m-0">
                            <a href="{{ route('profile') }}" class="text-white">
                                <li class="p-2">
                                    <i class="bi bi-info-circle mx-2"></i>
                                    My Profile
                                </li>
                            </a>
                            <hr class="m-0">
                            <a href="{{ route('reservations') }}" class="text-white">
                                <li class="p-2 active cursor-pointer">
                                    <i class="bi bi-calendar4-range mx-2"></i>
                                    Reservations
                                </li>
                            </a>
                            <hr class="m-0">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
