<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('website.home');
    }

    public function bookingForm()
    {
        return view('website.booking_form');
    }

    public function confirmBooking($id)
    {
        $booking = Booking::where('booking_id', $id)->first();
        $vehicle = Vehicle::where('vehicle_id', $booking->vehicle_reg_id)->first();
        $brand = DB::table('brands')->where('brand_id', $vehicle->vehicle_making_company)->first()->name;
        return view('website.confirmBooking', compact(['vehicle', 'booking', 'brand']));
    }

    public function forgotPassword()
    {
        return view('website.forgotPassword');
    }

    public function loginRegister()
    {
        return view('website.login_register');
    }

}
