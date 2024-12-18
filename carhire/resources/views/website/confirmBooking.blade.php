@extends('website.layouts.app')


@section('content')
    <div class="bg-white pb-5">
        <div class="container mt-4 mb-5">
            <div class="col-8 mx-auto text-center py-5">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#5EC017"
                        class="bi bi-check-circle mb-4" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                    </svg>

                    <h2 class="mb-4">Your booking was Successful!</h2>

                </div>
                <a href="{{ route('reservations') }}">
                    <button type="submit" class="btn btn-danger">Go to My Reservations</button>
                </a>
            </div>

            <div class="text-center border-top pt-3">
                <p class="">Booking information</strong></p>
            </div>

            <div class="container border d-flex">

                <div class="row py-4 m-auto">
                    <div class="col-lg-3 col-md-4 col-sm-12 my-auto order-lg-1 order-md-1">
                        <img class="img-fluid"
                            src="{{ asset('panelslayout/website/assets/images/landing-page/car_placeholder_3.svg') }}"
                            alt="">
                    </div>

                    <div
                        class="col-lg-3 col-md-4 col-sm-12 my-auto order-lg-2 order-md-4 ps-lg-0 ps-md-4 pt-lg-0 pt-md-1 pt-3">
                        <h6 class="mt-3">{{ $brand}} {{ $vehicle->vehicle_model }}</h6>
                        <div class="d-flex">
                            <div class="d-flex">
                                <span class="badge text-dark text-muted p-0 me-1"> <img
                                    src="/panelslayout/website/assets/icons/fuel-type.svg" alt="fueltype">
                                {{ strtoupper($vehicle->fuel_type) }}</span>
                            <span class="badge text-dark text-muted p-0 me-1"> <img
                                    src="/panelslayout/website/assets/icons/vehicle-type.svg" alt="fueltype">
                                {{ strtoupper($vehicle->vehicle_type) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-12 my-auto order-lg-3 order-md-2 pt-lg-0 pt-md-5 pt-2 mt-md-auto mt-4">
                        <div class="">
                            <div class="d-flex mb-3">
                                <div class="me-2">
                                    <img src="/panelslayout/website/assets/icons/car-in-icon.svg" alt="start-date">
                                </div>
                                <div>
                                    <p class="m-0">{{ date('d-m-Y', strtotime($booking->start_date)) }}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-2">
                                    <img src="/panelslayout/website/assets/icons/car-out-icon.svg" alt="end-date">
                                </div>
                                <div>
                                    <p class="m-0">{{ date('d-m-Y', strtotime($booking->end_date)) }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 m-auto order-lg-4 order-md-3 pt-lg-0 pt-md-5 pt-3 text-center">
                        <h1 class="text-danger text-break"><span class="fs-3">$</span>{{ $booking->amount }}<small class="fs-6 d-xl-inline d-md-none d-inline">/week</small> <small class="fs-6 d-xl-none d-md-block d-none">per week</small> </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
