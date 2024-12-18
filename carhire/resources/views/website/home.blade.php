@extends('website.layouts.app')


@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="row w-100 m-0 columns-container">
                <div
                    class="col-12 col-lg-6 left-content d-flex align-items-lg-center align-items-end  position-relative overflow-hidden">
                    <div class="text ms-md-5 ms-3">
                        <h1 class="h1-main lg-left z-index-1 d-none d-lg-block">Enjoy <br> the journey <br> with your family!
                        </h1>
                        <h1 class="h1-main lg-left z-index-1 d-block d-lg-none pt-5">Enjoy the journey with your family!</h1>
                        <p class="h1-text">Ibex Fleet Pro! Book your car</p>
                    </div>
                    <div class="bg-opacity"></div>
                </div>
                <div class="col-12 col-lg-6 d-flex align-items-lg-center align-items-start justify-content-center">
                    <div class="w-100">
                        <div class="search-area w-100 d-none d-lg-block ps-5">
                            <div class="water-mark-text">find now</div>
                        </div>
                        <div class="box-full-h ps-md-5 ps-3 pe-md-5 pe-3">
                            <div class="find-car-group mt-md-0 mt-lg-3 mt-0">
                                <span class="find-car-label">Find your car</span>
                                <form action="{{ route('vehicles.search') }}" method="GET" class="mt-2">
                                    <div class="inputs-wrapper">
                                        <input type="text" class="form-control text-search" id="name" name="name"
                                            placeholder="SEARCH" />
                                        <input class="form-control" type="date" id="start_date" name="start_date"
                                            required value="{{ date('Y-m-d') }}" onchange="dateValidation()">
                                        <input class="form-control" type="date" id="end_date" name="end_date" required
                                            value="{{ date('Y-m-d') }}" onchange="dateValidation()">
                                        <button type="submit" class="btn btn-search">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <i class="bi bi-search search-placeholder-icon"></i>
                                    </div>
                                    <div class="form-check p-0">
                                        <span class="text-danger" id="error-message"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-opacity-two d-lg-none d-block"></div> <!-- This div will create the overlay -->
            </div>
        </div>

        <div class="bottom-area">
            <div class="btn-wrapper">
                <button>
                  Rent Now
                  <small>To get exclusive deals!</small>
                </button>
              </div>
            <div class="car-info">
                <ul>
                    <li>
                        <h5 class="car-name text-white m-0 mt-2">Unlock Your Next Adventure!</h5>
                        <p class="text-white fw-normal">Find the Perfect Ride with Us, Anytime, Anywhere!</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="car-image-wrapper">
            <img src="panelslayout/website/assets/images/landing-page/landing_page_car.png" class="car-image"
                alt="car-image" />
        </div>
    </div>
    <script>
        $(document).ready(function() {
            restrictPastDates();
        })
    </script>
@endsection
