<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;

class ControllerSetting extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-maintenance-type');
        $setting = Setting::where('is_deleted', '!=', 1)->get();
        return view('setting.settinglist', compact('setting'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-maintenance-type');
        return view('setting.addsetting');
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-maintenance-type');
        $addedBy = Auth::id();
        $request->validate([
            'maintenance_type_name' => 'required|string|max:191',
        ]);
        $user = Setting::create([
            'maintenance_type_name' => $request->maintenance_type_name,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);
        if (isset($user->id)) {
            $request->session()->flash('alert-success', 'Maintenance Type added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('maintenance-types');
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-maintenance-type');
        $setting = Setting::where('maintenance_type_id', $id)->first();
        return view('setting.editsetting', compact('setting'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-maintenance-type');
        $request->validate([
            'maintenance_type_name' => 'required|string|max:191',
        ]);
        $maintenance_type_name = $request->maintenance_type_name;
        Setting::where('maintenance_type_id', $id)->limit(1)->update(array('maintenance_type_name' => $maintenance_type_name));
        $request->session()->flash('alert-success', 'Maintenance Type updated successfully');
        return redirect()->route('maintenance-types');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-maintenance-type');
        $id = $request->id;
        Setting::where('maintenance_type_id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'Maintenance Type successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-maintenance-type');
        $id = $request->id;
        $status = $request->status;
        Setting::where('maintenance_type_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
    public function setting()
    {
        if(Auth::user()->hasRole('System-Driver')) {
            return redirect()->route('home');
        }
        $totalOwners=Customer::where('is_deleted', '!=', 1)->count();
        $totalInuranceCompanies=InsuranceCompany::where('is_deleted', '!=', 1)->count();
        $totalWorkshops=Workshop::where('is_deleted', '!=', 1)->count();
        $totalUsers=User::where('is_deleted', '!=', 1)->count();

        $recentWorkshops=Workshop::where('is_deleted', '!=', 1)->orderBy('workshop_id', 'desc')->limit(5)->get();
        $recentInsuranceCompanies=InsuranceCompany::where('is_deleted', '!=', 1)->orderBy('ic_id', 'desc')->limit(5)->get();

        return view('setting.setting', compact('totalOwners','totalInuranceCompanies','totalWorkshops','totalUsers','recentWorkshops','recentInsuranceCompanies'));
    }

    public function getMaintenanceTypes()
    {
        $maintenance_types = Setting::where('is_deleted', '!=', 1)->where('is_active', 1)->get();
        return [
            'maintenance_types' => $maintenance_types
        ];
    }
}
