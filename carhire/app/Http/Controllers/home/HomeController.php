<?php



namespace App\Http\Controllers\home;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Customer;

use App\Models\Vehicle;

use App\Models\Driver;

use App\Models\Contract;

use App\Models\Insurance;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Models\Maintenance;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()

    {
        if (Auth::user()->hasRole('System-Driver')) {
            return redirect()->back();
        }
        
        $count_owner = Customer::where('is_deleted', '!=', 1)->count();

        $count_vehicle = Vehicle::where('is_deleted', '!=', 1)->where('is_active', true)->count();

        $count_driver = Driver::where('is_deleted', '!=', 1)->count();

        $vehicles = Vehicle::with('vehicle_owner', 'maintenance', 'booking')
            ->where('is_deleted', '!=', 1)
            ->get()
            ->map(function ($vehicle) {
                $now = Carbon::now()->startOfDay(); // Truncate time component
                $status = 'Available'; // Default status

                // Check if any booking is active for the current date
                $bookingExists = $vehicle->booking->first(function ($booking) use ($now) {
                    return !$booking->is_deleted && $now->between($booking->start_date, $booking->end_date);
                });

                // If a booking is active, set status to 'rented'
                if ($bookingExists) {
                    $status = 'Rented';
                } else {
                    // Check if any maintenance is active for the current date
                    $maintenanceExists = $vehicle->maintenance->first(function ($maintenance) use ($now) {
                        return $now->diffInDays($maintenance->maintenance_date) == 0 && $maintenance->job_status == 1;
                    });

                    // If maintenance is active, set status to 'maintenance'
                    if ($maintenanceExists) {
                        $status = 'Maintenance';
                    }
                }

                return [
                    'vehicle' => $vehicle,
                    'status' => $status,
                ];
            });

        $vehicles= $vehicles->filter(function ($vehicle) {
            return $vehicle['status'] === 'Available';
        });
        
        $count_available_vehicles = $vehicles->count();

        $count_booking = Booking::where('is_deleted', '!=', 1)->count();

        $latest_maintenances = Maintenance::with('getVehicle', 'getDriver')->orderBy('id', 'desc')->get();
        $maintenance_type = [];

        $latest_bookings = Booking::join('vehicle', 'booking.vehicle_reg_id', 'vehicle.vehicle_id')
            ->join('driver', 'booking.driver_id', 'driver.driver_id')
            ->select('vehicle.vehicle_registration_no', 'booking.*', 'driver.first_name', 'driver.last_name')
            ->where('booking.is_deleted', '!=', 1)
            ->orderBy('booking.booking_id', 'desc')->get();


        if (Auth::user()->hasRole('System-Driver')) {
            return view('website.home', get_defined_vars());
        } else {
            return view('dashboard.dashboard', get_defined_vars());
        }
    }
}
