<?php

namespace App\Http\Controllers\tracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-tracking');
        $tracking = Tracking::join('vehicle', 'tracking.vehicle_id', 'vehicle.vehicle_id')->select('vehicle.vehicle_registration_no', 'tracking.*')->where('tracking.is_deleted', '!=', 1)->get();
        return view('tracking.trackingList', compact('tracking'));
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-tracking');
        $tracking = Tracking::where('tracking_id', $id)->first();
        $vehicle = DB::table('vehicle')->where('vehicle_id', $tracking->vehicle_id)->first();
        $driver = DB::table('driver')->where('driver_id', $tracking->allocated_to)->first();
        //    $incompany = DB::table('insurance_company')->where('ic_id',$insurance->insurance_company_id)->first();
        return view('tracking.invoicetracking', compact('tracking', 'vehicle', 'driver', 'id'));
    }
    public function create($id)
    {
        Auth::user()->checkPermission('create-tracking');
        $vehicle = Vehicle::where('vehicle_id', $id)->first();
        $driver = Driver::where('is_deleted', '!=', 1)->get();
        return view('tracking.addTracking', compact('vehicle', 'driver'));
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-tracking');
        $addedBy = Auth::id();
        $request->validate([
            'tracker_name' => 'required|string|max:255',
            'vehicle_reg_id' => 'required',
            'iccid_no' => 'required',
            'mobile_no' => 'required|regex:/^[0-9]{10}$/',
            'tracker_imei' => 'required|unique:tracking,tracker_imei',
        ]);
        $user = Tracking::create([
            'tracker_name' => $request->tracker_name,
            'tracker_imei' => $request->tracker_imei,
            'cell_provider' => $request->cell_provider,
            'mobile_no' => $request->mobile_no,
            'iccid_no' => $request->iccid_no,
            'vehicle_id' => $request->vehicle_reg_id,
            'added_by' => $addedBy,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);
        if (isset($user->id)) {
            $request->session()->flash('alert-success', 'Tracker added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('vehicle.show', $request->vehicle_reg_id);
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-tracking');
        $tracking = Tracking::where('tracking_id', $id)->first();
        $vehicle = Vehicle::where('is_deleted', '!=', 1)->get();
        $driver = Driver::where('is_deleted', '!=', 1)->get();
        return view('tracking.editTracking', compact('tracking', 'driver', 'vehicle'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-tracking');
        $request->validate([
            'tracker_name' => 'required|string|max:255',
            'vehicle_reg_id' => 'required',
            'iccid_no' => 'required',
            'mobile_no' => 'required',
        ]);
        $tracker_name = $request->tracker_name;
        $tracker_imei = $request->tracker_imei;
        $cell_provider = $request->cell_provider;
        $mobile_no = $request->mobile_no;
        $iccid_no = $request->iccid_no;
        $vehicle_id = $request->vehicle_reg_id;
        Tracking::where('tracking_id', $id)->limit(1)->update(array('vehicle_id' => $vehicle_id, 'tracker_name' => $tracker_name, 'tracker_imei' => $tracker_imei, 'cell_provider' => $cell_provider, 'mobile_no' => $mobile_no, 'iccid_no' => $iccid_no));
        $request->session()->flash('alert-success', 'Tracker updated successfully');
        return redirect()->route('vehicle.show', $request->vehicle_reg_id);
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-tracking');
        $id = $request->id;
        Tracking::where('tracking_id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'Tracker successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-tracking');
        $id = $request->id;
        $status = $request->status;
        Tracking::where('tracking_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
}
