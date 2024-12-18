@extends('website.layouts.app')


@section('content')
    <div class="bg-white border-top pb-2">
        <div class="container mt-3">
            <h5>Search Result</h5>
            <div>
                <div class="d-flex justify-content-between">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item me-2"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Search Result</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper mt-3">
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 pe-0 pe-md-2 px-2 px-md-0 order-5 order-sm-6">
                        @if ($vehicles->isEmpty())
                            <div class="card mb-3 border-0 rounded-0 shadow-none">
                                <div class="card-body text-center">
                                    <img class="w-50"
                                        src={{ asset('panelslayout/website/assets/images/undraw_electric_car_b-7-hl.svg') }}
                                        alt="Empty_canvas">
                                    <h4 class="text-center text-muted mt-4">No vehicles found.</h4>
                                    <p class="text-center text-muted mt-1">Try changing your filters, adjusting your dates,
                                        or exploring the map</p>
                                </div>
                            </div>
                        @else
                            @foreach ($vehicles as $vehicle)
                                <div class="card mb-3 border-0 rounded-0 shadow-none py-lg-1 pe-lg-1">
                                    <div class="row">
                                        <div class="col-md-3 position-relative">
                                            <div class="d-flex align-items-center h-100">
                                                <img src="panelslayout/website/assets/images/landing-page/car_placeholder_3.svg"
                                                    alt="car" class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column">
                                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                                <h3 class="fw-normal">{{ $vehicle->brand_name }}
                                                    {{ $vehicle->vehicle_model }}</h3>
                                                <div class="align-items-center d-sm-flex d-lg-none">
                                                    <span class="me-2">weekly rent</span>
                                                    <h3 class="text-danger">${{ number_format((float) $vehicle->admin_fee, 2)  }}</h3>
                                                </div>
                                            </div>
                                            <div class="mt-0 mt-md-auto my-3 my-md-auto mx-2">
                                                <div class="row car-features">
                                                    <div
                                                        class="col-3 col-md-2 col-lg-3 icon-wrapper text-center border border-start-0 border p-1 py-2">
                                                        <img src="panelslayout/website/assets/icons/fuel-type.svg" alt="fueltype">
                                                        <p class="m-0 icon-text mt-2">{{ $vehicle->fuel_type }}</p>
                                                    </div>
                                                    <div
                                                        class="col-3 col-md-2 col-lg-3 icon-wrapper text-center border p-1 py-2">
                                                        <img src="panelslayout/website/assets/icons/vehicle-type.svg" alt="vehicle-type">
                                                        <p class="m-0 icon-text mt-2">{{ $vehicle->vehicle_type }}</p>
                                                    </div>
                                                    <div
                                                        class="col-3 col-md-2 col-lg-3 icon-wrapper text-center border p-1 py-2">
                                                        <img src="panelslayout/website/assets/icons/color.svg" alt="vehicle-color">  
                                                        <p class="m-0 icon-text mt-2">{{ $vehicle->vehicle_color }}</p>
                                                    </div>
                                                    <div
                                                        class="col-3 col-md-2 col-lg-3 icon-wrapper text-center border border-end-0 p-1 py-2">
                                                        <img src="panelslayout/website/assets/icons/year.svg" alt="vehicle-year">  
                                                        <p class="m-0 icon-text mt-2">{{ $vehicle->vehicle_year }}</p>
                                                    </div>
                                                </div>
                                                <div class="col d-flex justify-content-evenly p-0">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 d-none d-lg-block">
                                            <div
                                                class="price-wrapper text-center py-2 bg-opacity-10 d-flex flex-column justify-content-center align-items-center">
                                                <div class="mt-sm-0 mt-md-0 mt-lg-auto  ">
                                                    <small class="text-muted">Weekly Rent</small>
                                                    <h1 class="p-0 m-0"><span class="fs-3">$</span>{{ number_format((float) $vehicle->admin_fee, 2) }}</h1>
                                                    <a href="{{ route('booking.create.withdates', ['id' => $vehicle->vehicle_id, 'startdate' => $oldInputs['start_date'], 'enddate' => $oldInputs['end_date']]) }}"
                                                        class="btn btn-sm btn-danger mx-1 mt-3 rounded-0">Book Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('booking.create.withdates', ['id' => $vehicle->vehicle_id, 'startdate' => $oldInputs['start_date'], 'enddate' => $oldInputs['end_date']]) }}"
                                        class="btn btn-sm btn-danger mx-1 mt-3 d-block d-sm-block d-lg-none rounded-0">Book
                                        Now</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-4 ps-1 ps-sm-0 ps-md-2 px-1 px-sm-0 px-md-0 order-6 order-sm-5 mb-4">
                        <div class="card border-0 rounded-0 shadow-none">
                            <h5>Find Your Car</h5>
                            <form action="{{ route('vehicles.search') }}" method="GET" id="search-form">
                                <div class="mt-2 mb-2">
                                    <input type="text" class="form-control text-search" id="name" name="name"
                                        placeholder="Search" value="{{ old('name', $oldInputs['name'] ?? '') }}" />
                                </div>
                                <div class="d-flex gap-1">
                                    <input class="form-control" type="date" id="start_date" name="start_date" required
                                        value="{{ old('start_date', $oldInputs['start_date'] ?? date('Y-m-d')) }}"
                                        onchange="dateValidation()">
                                    <input class="form-control" type="date" id="end_date" name="end_date" required
                                        value="{{ old('end_date', $oldInputs['end_date'] ?? date('Y-m-d')) }}"
                                        onchange="dateValidation()">
                                </div>
                                <div class="mt-1">
                                    <span class="text-danger" id="error-message"></span>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-sm btn-danger mt-3 w-100 btn-search rounded-0">
                                        <i class="bi bi-search me-2"></i>Search
                                    </button>
                                </div>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between" data-bs-toggle="collapse"
                                    data-bs-target="#filterCollapse" aria-expanded="true" aria-controls="filterCollapse"
                                    id="toggleFilter">
                                    <h5>Filter Vehicles</h5>
                                    <i class="bi bi-chevron-down" id="toggleIcon"></i>
                                </div>
                                <div class="collapse" id="filterCollapse">

                                    <h6 class="mt-3">Color</h6>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="colors[]"
                                            id="color_black" value="black"
                                            {{ in_array('black', $oldInputs['colors'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="color_black">Black</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="colors[]"
                                            id="color_blue" value="blue"
                                            {{ in_array('blue', $oldInputs['colors'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1" for="color_blue">Blue</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="colors[]"
                                            id="color_grey" value="grey"
                                            {{ in_array('grey', $oldInputs['colors'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1" for="color_grey">Grey</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="colors[]"
                                            id="color_white" value="white"
                                            {{ in_array('white', $oldInputs['colors'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="color_white">White</label>
                                    </div>
                                    <hr class="my-4">
                                    <h6>Vehicle Type</h6>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="vehicle_types[]"
                                            id="vehicle_type_sedan" value="sedan"
                                            {{ in_array('sedan', $oldInputs['vehicle_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="vehicle_type_sedan">Sedan</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="vehicle_types[]"
                                            id="vehicle_type_suv" value="suv"
                                            {{ in_array('suv', $oldInputs['vehicle_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="vehicle_type_suv">SUV</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="vehicle_types[]"
                                            id="vehicle_type_hatch_back" value="hatch-back"
                                            {{ in_array('hatch-back', $oldInputs['vehicle_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="vehicle_type_hatch_back">Hatch
                                            Back</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="vehicle_types[]"
                                            id="vehicle_type_commercial" value="commercial"
                                            {{ in_array('commercial', $oldInputs['vehicle_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="vehicle_type_commercial">Commercial</label>
                                    </div>
                                    <hr class="my-4">
                                    <h6>Fuel Type</h6>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="fuel_types[]"
                                            id="fuel_type_petrol" value="petrol"
                                            {{ in_array('petrol', $oldInputs['fuel_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="fuel_type_petrol">Petrol</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="fuel_types[]"
                                            id="fuel_type_diesel" value="diesel"
                                            {{ in_array('diesel', $oldInputs['fuel_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="fuel_type_diesel">Diesel</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="fuel_types[]"
                                            id="fuel_type_hybrid" value="hybrid"
                                            {{ in_array('hybrid', $oldInputs['fuel_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="fuel_type_hybrid">Hybrid</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" name="fuel_types[]"
                                            id="fuel_type_electric" value="electric"
                                            {{ in_array('electric', $oldInputs['fuel_types'] ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label filter-checkbox mt-1"
                                            for="fuel_type_electric">Electric</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            restrictPastDates();

            //toggle search filters
            $('#toggleFilter').on('click', function() {
                $('#toggleIcon').toggleClass('bi-chevron-down bi-chevron-up');
            });
        })
    </script>
@endsection
