<?php

namespace App\Http\Controllers\vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Role;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Setting;
use App\Models\Workshop;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-vehicle');

        $heading = "Fleet";

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
                }

                // Check if any maintenance is active for the current date
                $maintenanceExists = $vehicle->maintenance->first(function ($maintenance) use ($now) {
                    return $now->diffInDays($maintenance->maintenance_date) == 0 && $maintenance->job_status == 1;
                });

                // If maintenance is active, set status to 'maintenance'
                if ($maintenanceExists) {
                    $status = 'Maintenance';
                }

                if($vehicle->sell_status == 1){
                    $status = 'Sold';
                }
                return [
                    'vehicle' => $vehicle,
                    'status' => $status,
                ];
            });

        return view('vehicle.vehicleList', compact('vehicles', 'heading'));
    }

    public function availableVehicles()
    {
        Auth::user()->checkPermission('view-vehicle');

        $heading = "Available Vehicles";

        // Get all vehicles that are not deleted
        $vehicles = Vehicle::with('vehicle_owner', 'maintenance', 'booking')
            ->where('is_deleted', '!=', 1)
            ->get()
            ->filter(function ($vehicle) {
                $now = Carbon::now()->startOfDay(); // Truncate time component

                // Check if any booking is active for the current date
                $bookingExists = $vehicle->booking->first(function ($booking) use ($now) {
                    return !$booking->is_deleted && $now->between($booking->start_date, $booking->end_date);
                });

                // Check if any maintenance is active for the current date
                $maintenanceExists = $vehicle->maintenance->first(function ($maintenance) use ($now) {
                    return $now->diffInDays($maintenance->maintenance_date) == 0 && $maintenance->job_status == 1;
                });

                // Filter out vehicles that are currently in booking or maintenance
                return !$bookingExists && !$maintenanceExists;
            })
            ->map(function ($vehicle) {
                return [
                    'vehicle' => $vehicle,
                    'status' => 'Available', // Set status to 'Available' for all filtered vehicles
                ];
            });

        return view('vehicle.vehicleList', compact('vehicles', 'heading'));
    }

    public function show($id)
    {
        Auth::user()->checkPermission('view-vehicle');
        $vehicle = Vehicle::where('vehicle_id', $id)->with('vehicle_owner.getCompany', 'vehicle_owner.contactPerson')->first();
        $vehicles = Vehicle::with('vehicle_owner', 'maintenance', 'booking')
            ->where('vehicle_id', $id)
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
                        return $now->diffInDays($maintenance->maintenance_date) != 0 && $maintenance->job_status == 1;
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
        $vehicleStatus = $vehicles[0]['status'];
        $brand = DB::table('brands')->where('brand_id', $vehicle->vehicle_making_company)->first();
        $insurance = DB::table('insurance')->where('vehicle_reg_id', $id)->first();
        if ($insurance) {
            $incompany = DB::table('insurance_company')->where('ic_id', $insurance->insurance_company_id)->first();
        } else {
            $incompany = null;
        }
        $tracking = DB::table('tracking')->where('vehicle_id', $id)->first();
        $maintenance = Maintenance::where('vehicle_reg_id', $id)->with('getDriver')
            ->orderBy('id', 'desc')->first();
        return view('vehicle.invoicevehicle', compact('vehicle', 'brand', 'id', 'insurance', 'incompany', 'tracking', 'maintenance', 'vehicleStatus'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-vehicle');
        $making_companies = DB::table('brands')->get();
        $owner = DB::table('customer')->where('is_deleted', '!=', 1)->get();
        return view('vehicle.addVehicle', compact('making_companies', 'owner'));
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-vehicle');
        $adminId = Auth::id();
        $request->validate([
            'vehicle_registration_no' => 'required|string|max:25|unique:vehicle',
            'vehicle_engine_no' => 'required|string|max:25|unique:vehicle',
            'vehicle_making_id' => 'required',
            'model' => 'required|max:20',
            'year' => 'required|max:10',
            'color' => 'required|max:20',
            'type' => 'required',
            'vehicle_owner' => 'required',
        ]);
        Vehicle::create([
            'fuel_type' => $request->fuel_type,
            'owner' => $request->vehicle_owner,
            'vehicle_registration_no' => $request->vehicle_registration_no,
            'vehicle_engine_no' => $request->vehicle_engine_no,
            'vehicle_type' => $request->type,
            'vehicle_making_company' => $request->vehicle_making_id,
            'vehicle_model' => $request->model,
            'vehicle_year' => $request->year,
            'vehicle_color' => $request->color,
            'vehicle_status' => $request->vehicle_status,
            'biller_code' => $request->biller_code,
            'reference_no' => $request->reference_no,
            'vin' => $request->vin,
            'admin_fee' => $request->admin_fee,
            'added_by' => $adminId,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);
        $request->session()->flash('alert-success', 'Vehicle added successfully');
        return redirect()->route('vehicles');
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-vehicle');
        $vehicleData = Vehicle::where('vehicle_id', $id)->with('vehicle_owner')->first();
        $making_companies = DB::table('brands')->get();
        return view('vehicle.editVehicle', compact('vehicleData', 'making_companies'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-vehicle');
        $request->validate([
            'vehicle_registration_no' => [
                'required',
                'string',
                'max:25',
                Rule::unique('vehicle')->ignore($id, 'vehicle_id'),
            ],
            'vehicle_engine_no' => [
                'required',
                'string',
                'max:25',
                Rule::unique('vehicle')->ignore($id, 'vehicle_id'),
            ],
            'vehicle_making_id' => 'required',
            'model' => 'required|max:20',
            'year' => 'required|max:10',
            'color' => 'required|max:20',
            'type' => 'required',
        ]);
        $adminId = Auth::id();
        $fuel_type = $request->fuel_type;
        $vehicle_registration_no = $request->vehicle_registration_no;
        $vehicle_engine_no = $request->vehicle_engine_no;
        $vehicle_making_id = $request->vehicle_making_id;
        $model = $request->model;
        $year = $request->year;
        $color = $request->color;
        $type = $request->type;
        $owner = $request->vehicle_owner;
        $vehicle_status = $request->vehicle_status;
        $biller_code = $request->biller_code;
        $reference_no = $request->reference_no;
        $vin = $request->vin;
        $admin_fee = $request->admin_fee;
        Vehicle::where('vehicle_id', $id)->limit(1)->update(array('fuel_type' => $fuel_type, 'vehicle_type' => $type, 'vehicle_registration_no' => $vehicle_registration_no, 'vehicle_engine_no' => $vehicle_engine_no, 'vehicle_making_company' => $vehicle_making_id, 'vehicle_model' => $model, 'vehicle_year' => $year, 'vehicle_color' => $color, 'owner' => $owner, 'vehicle_status' => $vehicle_status, 'biller_code' => $biller_code, 'reference_no' => $reference_no, 'vin' => $vin, 'admin_fee' => $admin_fee));
        $request->session()->flash('alert-success', 'Vehicle updated successfully');
        return redirect()->route('vehicles');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-vehicle');
        $id = $request->id;
        $vehicles = Vehicle::with('vehicle_owner', 'maintenance', 'booking')
            ->where('is_deleted', '!=', 1)->where('vehicle_id', $id)
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
                        $maintenanceDate = Carbon::parse($maintenance->maintenance_date)->startOfDay();
                        return $maintenanceDate->isSameDay($now) && $maintenance->job_status == 1;
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


        if ($vehicles[0]['status'] == "Available") {

            Vehicle::where('vehicle_id', $id)->limit(1)->update(array('is_deleted' => 1));
            return response()->json([
                'success' => true,
                'message' => 'Vehicle successfully deleted',
            ]);
        } elseif ($vehicles[0]['status'] == "Rented") {

            return response()->json([

                'success' => false,

                'message' => 'Vehicle is booked'

            ]);
        } else {
            return response()->json([

                'success' => false,

                'message' => 'Vehicle is booked for maintenance'

            ]);
        }
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-vehicle');
        $id = $request->id;
        $status = $request->status;
        Vehicle::where('vehicle_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }

    public function getVehicleOwner(Request $request)
    {
        $owner = Vehicle::where('vehicle_id', $request->id)->with('vehicle_owner')->first();
        return response()->json([
            'owner' => $owner->vehicle_owner,
            'success' => true,
        ]);
    }

    public function search(Request $request)
    {
        $query = Vehicle::query()->excludeDeleted();

        $filtersApplied = false;

        if ($request->filled('name')) {
            $query->filterByName($request->input('name'));
            $filtersApplied = true;
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->format('Y-m-d');
            $endDate = Carbon::parse($request->input('end_date'))->format('Y-m-d');
            $query->filterByDateRange($startDate, $endDate);
            $filtersApplied = true;
        } else {
            $request->merge([
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => Carbon::now()->format('Y-m-d')
            ]);
        }

        if ($request->filled('colors')) {
            $query->filterByColors($request->input('colors'));
            $filtersApplied = true;
        }

        if ($request->has('vehicle_types')) {
            $query->filterByVehicleTypes($request->input('vehicle_types'));
            $filtersApplied = true;
        }

        if ($request->has('fuel_types')) {
            $query->filterByFuelTypes($request->input('fuel_types'));
            $filtersApplied = true;
        }

        // If no filters are applied, show only available vehicles based on default date range
        if (!$filtersApplied) {
            $currentDate = now()->format('Y-m-d');
            $query->filterByDateRange($currentDate, $currentDate);
        }


        $vehicles = $query->leftJoin('brands', 'vehicle.vehicle_making_company', '=', 'brands.brand_id')
            ->select('vehicle.*', 'brands.name as brand_name')
            ->get();

        return view('website.list', [
            'vehicles' => $vehicles,
            'oldInputs' => $request->all()
        ]);
    }

    public function toggleSellStatus(Request $request, $id)
    {
        // dd();
        $currentStatus = Vehicle::where('vehicle_id', $id)
            ->value('sell_status');

        // dd($currentStatus);

        if ($currentStatus == 0) {
            // Toggle the sell status
            Vehicle::where('vehicle_id', $id)
                ->update(['sell_status' => 1, 'is_active' => 0]);
        }
        if ($currentStatus == 1) {
            Vehicle::where('vehicle_id', $id)
                ->update(['sell_status' => 0, 'is_active' => 1]);
        }
        return redirect()->back();
    }
}
