<?php

namespace App\Http\Controllers\insurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\Vehicle;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InsuranceController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-insurance');
        $insurance = Insurance::join('vehicle', 'insurance.vehicle_reg_id', 'vehicle.vehicle_id')->select('vehicle.fuel_type', 'vehicle.vehicle_registration_no', 'insurance.*')->where('insurance.is_deleted', '!=', 1)->get();
        return view('insurance.insuranceList', compact('insurance'));
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-insurance');
        $insurance = Insurance::where('insurance_id', $id)->first();
        $vehicle = DB::table('vehicle')->where('vehicle_id', $insurance->vehicle_reg_id)->first();
        $customer = DB::table('customer')->where('customer_id', $insurance->owner_id)->first();
        $incompany = DB::table('insurance_company')->where('ic_id', $insurance->insurance_company_id)->first();
        return view('insurance.invoiceInsurance', compact('insurance', 'vehicle', 'customer', 'incompany', 'id'));
    }
    public function create($id)
    {
        Auth::user()->checkPermission('create-insurance');
        $vehicle = Vehicle::where('vehicle_id', $id)->with('vehicle_owner')->first();
        $insurance_company = DB::table('insurance_company')->where('is_active', '=', 1)->get();
        return view('insurance.addInsurance', compact('insurance_company', 'vehicle', 'id'));
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-insurance');
        $addedBy = Auth::id();
        $request->validate([
            'vehicle_reg_id' => 'required|string',
            'owner' => 'required|string',
            'inurance_company' => 'required',
            'policy_number' => 'required',
            'insurance_start_date' => 'required|date',
            'insurance_end_date' => 'required|date|after_or_equal:insurance_start_date',
            'payment_method_id' => 'required',
            'four_digit' => $request->input('payment_method_id') == '1' ? 'required|regex:/^\d{4}$/' : 'sometimes',
            'account_name' => 'required|string',
            'account_no' => $request->input('payment_method_id') == '0' ? 'required|string' : 'sometimes',
            'bsb' => $request->input('payment_method_id') == '0' ? 'required|string' : 'sometimes',
        ]);
        // check if insurance already exists for the this vehicle which date is not expired
        $checkInsurance = Insurance::where('vehicle_reg_id', $request->vehicle_reg_id)->where('insurance_end_date', '>=', date('Y-m-d'))->where('is_deleted', 0)->count();
        if ($checkInsurance > 0) {
            $request->session()->flash('alert-danger', 'Insurance already exists for this vehicle');
            return redirect()->route('vehicle.show', $request->vehicle_reg_id);
        }
        $user = Insurance::create([
            'vehicle_reg_id' => $request->vehicle_reg_id,
            'owner_id' => $request->owner,
            'bsb' => $request->bsb,
            'insurance_company_id' => $request->inurance_company,
            'policy_number' => $request->policy_number,
            'insurance_premium' => $request->insurance_premium,
            'ins_prem_direct_debit' => $request->ins_prem_direct_debit,
            'insurance_start_date' => Carbon::createFromFormat('d-m-Y', $request->insurance_start_date)->format('Y-m-d'),
            'insurance_end_date' => Carbon::createFromFormat('d-m-Y', $request->insurance_end_date)->format('Y-m-d'),
            'payment_method_id' => $request->payment_method_id,
            'account_no' => $request->account_no,
            'account_name' => $request->account_name,
            'four_digit' => $request->four_digit,
            'added_by' => $addedBy,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);

        if (isset($user->id)) {
            $request->session()->flash('alert-success', 'Insurance added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('vehicle.show', $user->vehicle_reg_id);
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-insurance');
        $insurance = Insurance::where('insurance_id', $id)->first();
        $vehicle = Vehicle::where('is_deleted', '!=', 1)->get();
        $insurance_company = DB::table('insurance_company')->get();
        $owner = DB::table('customer')->get();
        return view('insurance.editInsurance', compact('insurance', 'vehicle', 'insurance_company', 'owner'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-insurance');
        $request->validate([
            'vehicle_reg_id' => 'required|string',
            'policy_number' => 'required|string',
            'payment_method_id' => 'required',
        ]);
        $vehicle_reg_id = $request->vehicle_reg_id;
        $owner_id  = $request->owner;
        $bsb = $request->bsb;
        $insurance_company_id  = $request->inurance_company;
        $policy_number  = $request->policy_number;
        $insurance_premium  = $request->insurance_premium;
        $ins_prem_direct_debit  = $request->ins_prem_direct_debit;
        $insurance_start_date = Carbon::createFromFormat('d-m-Y', $request->insurance_start_date)->format('Y-m-d');
        $insurance_end_date = Carbon::createFromFormat('d-m-Y', $request->insurance_end_date)->format('Y-m-d');
        $payment_method_id  = $request->payment_method_id;
        $account_no  = $request->account_no;
        $account_name  = $request->account_name;
        $four_digit = $request->four_digit;
        Insurance::where('insurance_id', $id)->limit(1)->update(array('vehicle_reg_id' => $vehicle_reg_id, 'owner_id' => $owner_id, 'bsb' => $bsb, 'policy_number' => $policy_number, 'insurance_premium' => $insurance_premium, 'ins_prem_direct_debit' => $ins_prem_direct_debit, 'payment_method_id' => $payment_method_id, 'account_no' => $account_no, 'account_name' => $account_name, 'insurance_start_date' => $insurance_start_date, 'insurance_end_date' => $insurance_end_date, 'four_digit' => $four_digit));
        $request->session()->flash('alert-success', 'Insurance updated successfully');
        return redirect()->route('vehicle.show', $request->vehicle_reg_id);
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-insurance');
        $id = $request->id;
        Insurance::where('insurance_id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'Insurance successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-insurance');
        $id = $request->id;
        $status = $request->status;
        Insurance::where('insurance_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
    public function FetchCarOwner(Request $request)
    {
        $id = $request->id;
        $model = Customer::join('vehicle', 'customer.customer_id', 'vehicle.owner')->select('customer.customer_id', 'customer.c_first_name', 'customer.c_last_name')->where('vehicle.vehicle_id', $id)->get();
        $response = array("success" => "1", "message" => "success", "model" => $model);
        echo json_encode($response);
    }
}
