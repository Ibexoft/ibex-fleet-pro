<?php

namespace App\Http\Controllers\maintenance;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceWorkshopDetail;
use App\Models\MaintenanceWorkshopItem;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Workshop;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceTypeDetail;
use App\Models\MaintenanceTypeItem;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-maintenance');
        $maintenance = Maintenance::with('getVehicle', 'getDriver')->get();
        // dd($maintenance);
        return view('maintenance.maintenanceList', compact('maintenance'));
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-maintenance');
        $maintenance = Maintenance::where('id', $id)->with('getVehicle', 'getDriver', 'getMaintenanceTypeDetails', 'getMaintenanceTypeDetails.maintenance_type', 'getMaintenanceTypeDetails.maintenance_type_item' , 'getWorkshopDetails', 'getWorkshopDetails.getMaintenanceWorkshopItems', 'getWorkshopDetails.getWorkshops')->first();
        $owner = DB::table('customer')->where('customer_id', $maintenance->paid_by)->first();
        // dd($maintenance);
        return view('maintenance.invoicemaintenance', compact('maintenance', 'owner'));
    }
    public function create($id = null)
    {
        Auth::user()->checkPermission('create-maintenance');
        if ($id == null) {
            $vehicleData = Vehicle::where('is_deleted', '!=', 1)->get();
        } else {
            $vehicleData = Vehicle::where('vehicle_id', $id)->with('vehicle_owner')->get();
        }
        $Workshop = Workshop::where('is_deleted', '!=', 1)->get();
        $type = Setting::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->get();
        $driver = DB::table('driver')->where('is_deleted', '!=', 1)->where('is_active', '=', 1)->get();
        return view('maintenance.addMaintenance', compact('vehicleData', 'Workshop', 'type', 'driver'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        Auth::user()->checkPermission('create-maintenance');
        $request->validate([
            'vehicle_reg_id' => 'required',
            'maintenance_type' => 'required',
            'driver_id' => 'required',
            'maintenance_date' => 'required',
            'paid_by' => 'required',
        ]);
        $checkMaintenance = Maintenance::where('vehicle_reg_id', $request->vehicle_reg_id)->where('job_status', 1)->first();
        if ($checkMaintenance != null) {
            $request->session()->flash('alert-danger', 'Maintenance is already in progress for this vehicle');
            return redirect()->route('maintenance');
        }
        $maintenance = Maintenance::create([
            'vehicle_reg_id' => $request->vehicle_reg_id,
            'driver_id' => $request->driver_id,
            'maintenance_date' => Carbon::createFromFormat('d-m-Y', $request->maintenance_date)->format('Y-m-d'),
            'comments' => $request->comments,
            'paid_by' => $request->paid_by,
            'added_by' => Auth::id(),
            'is_active' => 1,
            'job_status' => 1,
        ]);
        foreach ($request->maintenance_type as $key => $value) {
            $maintenance_type = new MaintenanceTypeDetail();
            $maintenance_type->maintenance_id = $maintenance->id;
            $maintenance_type->maintenance_type_id = $value;
            $maintenance_type->save();
        }
        if (isset($maintenance->id)) {
            $request->session()->flash('alert-success', 'Maintenance request generated successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('maintenance');
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-maintenance');
        $maintenance = Maintenance::where('id', $id)->with('getVehicle', 'getDriver', 'getMaintenanceTypeDetails', 'getMaintenanceTypeDetails.maintenance_type', 'getWorkshopDetails', 'getWorkshopDetails.getMaintenanceWorkshopItems', 'getWorkshopDetails.getWorkshops')->first();
        $owner = DB::table('customer')->where('customer_id', $maintenance->paid_by)->first();
        $vehicleData = Vehicle::with('vehicle_owner')->get();
        $driver = DB::table('driver')->where('is_deleted', '!=', 1)->where('is_active', '=', 1)->get();
        $type = Setting::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->get();

        return view('maintenance.editMaintenance', compact('maintenance', 'owner', 'vehicleData', 'driver', 'type'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-maintenance');
        $request->validate([
            'vehicle_reg_id' => 'required',
            'maintenance_type' => 'required',
            'driver_id' => 'required',
            'maintenance_date' => 'required',
            'paid_by' => 'required',
        ]);
        $maintenance = Maintenance::where('id', $id)->with('getMaintenanceTypeDetails')->first();
        $maintenance->vehicle_reg_id = $request->vehicle_reg_id;
        $maintenance->driver_id = $request->driver_id;
        $maintenance->maintenance_date = Carbon::createFromFormat('d-m-Y', $request->maintenance_date)->format('Y-m-d');
        $maintenance->comments = $request->comments;
        $maintenance->paid_by = $request->paid_by;
        $maintenance->save();

        $maintenanceTypeIds = $maintenance->getMaintenanceTypeDetails->pluck('maintenance_type_id')->toArray();
        $requestMaintenanceTypeIds = $request->maintenance_type;
        $toDelete = array_diff($maintenanceTypeIds, $requestMaintenanceTypeIds);
        MaintenanceTypeDetail::whereIn('id', $toDelete)->delete();
        foreach ($request->maintenance_type as $key => $value) {
            $maintenance_type = MaintenanceTypeDetail::where('maintenance_id', $id)->where('maintenance_type_id', $value)->first();
            if ($maintenance_type == null) {
                $maintenance_type = new MaintenanceTypeDetail();
            }
            $maintenance_type->maintenance_id = $id;
            $maintenance_type->maintenance_type_id = $value;
            $maintenance_type->save();
        }

        $request->session()->flash('alert-success', 'Maintenance request updated successfully');
        return redirect()->route('maintenance');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-maintenance');
        $id = $request->id;
        Maintenance::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Maintenance successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        //        $id = $request->id;
        //        $status = $request->status;
        //        Maintenance::where('id', $id)->limit(1)->update(array('is_active' => $status));
        //        $response = array("success" => "1", "message" => "Status Updated successfully");
        //        echo json_encode($response);
    }
    public function returndate(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-maintenance');
        $date = date('Y-m-d');
        $result =  Maintenance::where('id', $id)->limit(1)->update(array('actual_return_date' => $date));
        return redirect()->route('maintenance');
    }
    public function returnActualDate(Request $request)
    {
        Auth::user()->checkPermission('edit-maintenance');
        $id = $request->id;
        $status = $request->status;
        Maintenance::where('id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }

    public function processMaintenance($id)
    {
        $maintenance = Maintenance::where('id', $id)->with('getVehicle', 'getDriver')->first();
        $maintenanceTypes = MaintenanceTypeDetail::where('maintenance_id', $id)->with('maintenance_type')->get();
        $workshops = Workshop::where('is_deleted', '!=', 1)->get();
        $types = Setting::where('is_deleted', '!=', 1)->get();
        return view('maintenance.create-process', compact('maintenance', 'maintenanceTypes', 'workshops', 'types'));
    }

    public function complete(Request $request, $id)
    {

        $rules = [
            'odo_meter' => 'required|numeric|lt:next_service',
            'next_service' => 'required|numeric|gt:odo_meter',
        ];

        if ($request->has('maintenance_type')) {
            $maintenanceRules = [
                'm_rrp' => 'required',
                'm_qty' => 'required',
                'labour_time' => 'required',
                'maintenance_time' => 'required',
            ];

            $rules += $maintenanceRules;
        } elseif ($request->has('workshop_id')) {
            $workshopRules = [
                'workshop_time' => 'required',
                'part_used' => 'required',
                'rrp' => 'required',
                'qty' => 'required',
            ];

            $rules += $workshopRules;
        }

        $request->validate($rules);


        for ($i = 0; $i < count($request->maintenance_type); $i++) {
            $maintenance_type = MaintenanceTypeDetail::where('maintenance_id', $id)->where('maintenance_type_id', $request->maintenance_type[$i])->where('labour', null)->first();
            if ($maintenance_type == null) {
                $maintenance_type = new MaintenanceTypeDetail();
            }
            $maintenance_type->maintenance_id = $id;
            $maintenance_type->maintenance_type_id = $request->maintenance_type[$i];
            $maintenance_type->labour = $request->labour_time[$i];
            $maintenance_type->save();
            for ($j = 0; $j < count($request->m_rrp[$i]); $j++) {
                $maintenance_item = new MaintenanceTypeItem();
                $maintenance_item->maintenance_type_detail_id = $maintenance_type->id;
                $maintenance_item->parts_used = $request->m_part_used[$i][$j];
                $maintenance_item->rrp = $request->m_rrp[$i][$j];
                $maintenance_item->quantity = $request->m_qty[$i][$j];
                $maintenance_item->save();
            }
        }
        for ($i = 0; $i < count($request->workshop_id); $i++) {
            $workshopDetails = new MaintenanceWorkshopDetail();
            $workshopDetails->maintenance_id = $id;
            $workshopDetails->workshop_id = $request->workshop_id[$i];
            $workshopDetails->invoice = 0;
            $workshopDetails_time = explode(' - ', $request->workshop_time[$i]);
            $workshopDetails->clock_on = date('Y-m-d H:i:s', strtotime($workshopDetails_time[0]));
            $workshopDetails->clock_off = date('Y-m-d H:i:s', strtotime($workshopDetails_time[1]));
            $workshopDetails->save();
            $inovice = 0;
            for ($j = 0; $j < count($request->part_used[$i]); $j++) {
                $workshopItems = new MaintenanceWorkshopItem();
                $workshopItems->maintenance_workshop_id = $workshopDetails->id;
                $workshopItems->parts_used = $request->part_used[$i][$j];
                $workshopItems->rrp = $request->rrp[$i][$j];
                $workshopItems->quantity = $request->qty[$i][$j];
                $workshopItems->save();
                $inovice += $request->rrp[$i][$j] * $request->qty[$i][$j];
            }
            $workshopDetails->invoice = $inovice;
            $workshopDetails->save();
        }

        $maintenance = Maintenance::where('id', $id)->first();
        $maintenance_time = explode(' - ', $request->maintenance_time);
        $start_time = date('Y-m-d H:i:s', strtotime($maintenance_time[0]));
        $end_time = date('Y-m-d H:i:s', strtotime($maintenance_time[1]));
        $maintenance->start_time = $start_time;
        $maintenance->end_time = $end_time;
        $maintenance->odo_meter = $request->odo_meter;
        $maintenance->next_service = $request->next_service;
        $maintenance->job_status = 2;
        $maintenance->save();
        $request->session()->flash('alert-success', 'Maintenance completed successfully');
        return redirect()->route('maintenance.show', $id);
    }

    public function editProcessedMaintenance($id)
    {
        $maintenance = Maintenance::where('id', $id)->with('getVehicle', 'getDriver', 'getMaintenanceTypeDetails', 'getMaintenanceTypeDetails.maintenance_type', 'getMaintenanceTypeDetails.maintenance_type_item', 'getWorkshopDetails', 'getWorkshopDetails.getMaintenanceWorkshopItems', 'getWorkshopDetails.getWorkshops')->first();
        $maintenanceTypes = MaintenanceTypeDetail::where('maintenance_id', $id)->with('maintenance_type')->get();
        $workshops = Workshop::where('is_deleted', '!=', 1)->get();
        $types = Setting::where('is_deleted', '!=', 1)->get();
        // dd($maintenance);
        return view('maintenance.edit-process', compact('maintenance', 'maintenanceTypes', 'workshops', 'types'));
    }

    public function updateProcessedMaintenance(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $rules = [
            'odo_meter' => 'required|numeric|lt:next_service',
            'next_service' => 'required|numeric|gt:odo_meter',
        ];

        if ($request->has('maintenance_type')) {
            $maintenanceRules = [
                'm_rrp' => 'required',
                'm_qty' => 'required',
                'labour_time' => 'required',
                'maintenance_time' => 'required',
            ];

            $rules += $maintenanceRules;
        } elseif ($request->has('workshop_id')) {
            $workshopRules = [
                'workshop_time' => 'required',
                'part_used' => 'required',
                'rrp' => 'required',
                'qty' => 'required',
            ];

            $rules += $workshopRules;
        }

        $request->validate($rules);

        // get all maintenance type details and delete them, then re-insert
        $maintenanceTypeDetails = MaintenanceTypeDetail::where('maintenance_id', $id)->get();
        foreach ($maintenanceTypeDetails as $maintenanceTypeDetail) {
            $maintenanceTypeDetailItems = MaintenanceTypeItem::where('maintenance_type_detail_id', $maintenanceTypeDetail->id)->get();
            foreach ($maintenanceTypeDetailItems as $maintenanceTypeDetailItem) {
                $maintenanceTypeDetailItem->delete();
            }
            $maintenanceTypeDetail->delete();
        }
        $maintenanceWorkshopDetails = MaintenanceWorkshopDetail::where('maintenance_id', $id)->get();
        foreach ($maintenanceWorkshopDetails as $maintenanceWorkshopDetail) {
            $maintenanceWorkshopItems = MaintenanceWorkshopItem::where('maintenance_workshop_id', $maintenanceWorkshopDetail->id)->get();
            foreach ($maintenanceWorkshopItems as $maintenanceWorkshopItem) {
                $maintenanceWorkshopItem->delete();
            }
            $maintenanceWorkshopDetail->delete();
        }
        for ($i = 0; $i < count($request->maintenance_type); $i++) {
            $maintenance_type = MaintenanceTypeDetail::where('maintenance_id', $id)->where('maintenance_type_id', $request->maintenance_type[$i])->where('labour', null)->first();
            if ($maintenance_type == null) {
                $maintenance_type = new MaintenanceTypeDetail();
            }
            $maintenance_type->maintenance_id = $id;
            $maintenance_type->maintenance_type_id = $request->maintenance_type[$i];
            $maintenance_type->labour = $request->labour_time[$i];
            $maintenance_type->save();
            for ($j = 0; $j < count($request->m_rrp[$i]); $j++) {
                $maintenance_item = new MaintenanceTypeItem();
                $maintenance_item->maintenance_type_detail_id = $maintenance_type->id;
                $maintenance_item->parts_used = $request->m_part_used[$i][$j];
                $maintenance_item->rrp = $request->m_rrp[$i][$j];
                $maintenance_item->quantity = $request->m_qty[$i][$j];
                $maintenance_item->save();
            }
        }
        for ($i = 0; $i < count($request->workshop_id); $i++) {
            $workshopDetails = new MaintenanceWorkshopDetail();
            $workshopDetails->maintenance_id = $id;
            $workshopDetails->workshop_id = $request->workshop_id[$i];
            $workshopDetails->invoice = 0;
            $workshopDetails_time = explode(' - ', $request->workshop_time[$i]);
            $workshopDetails->clock_on = date('Y-m-d H:i:s', strtotime($workshopDetails_time[0]));
            $workshopDetails->clock_off = date('Y-m-d H:i:s', strtotime($workshopDetails_time[1]));
            $workshopDetails->save();
            $inovice = 0;
            for ($j = 0; $j < count($request->part_used[$i]); $j++) {
                $workshopItems = new MaintenanceWorkshopItem();
                $workshopItems->maintenance_workshop_id = $workshopDetails->id;
                $workshopItems->parts_used = $request->part_used[$i][$j];
                $workshopItems->rrp = $request->rrp[$i][$j];
                $workshopItems->quantity = $request->qty[$i][$j];
                $workshopItems->save();
                $inovice += $request->rrp[$i][$j] * $request->qty[$i][$j];
            }
            $workshopDetails->invoice = $inovice;
            $workshopDetails->save();
        }

        $maintenance = Maintenance::where('id', $id)->first();
        $maintenance_time = explode(' - ', $request->maintenance_time);
        $start_time = date('Y-m-d H:i:s', strtotime($maintenance_time[0]));
        $end_time = date('Y-m-d H:i:s', strtotime($maintenance_time[1]));
        $maintenance->start_time = $start_time;
        $maintenance->end_time = $end_time;
        $maintenance->odo_meter = $request->odo_meter;
        $maintenance->next_service = $request->next_service;
        $maintenance->save();

        $request->session()->flash('alert-success', 'Maintenance updated successfully');
        return redirect()->route('maintenance.show', $id);
    }
}
