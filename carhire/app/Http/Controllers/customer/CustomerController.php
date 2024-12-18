<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class CustomerController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-owner');
        $customer = Customer::where('is_deleted', '!=', 1)->get();
        return view('customer.customerList', compact('customer'));
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-owner');
        $customer = Customer::where('customer_id', $id)->with('contactPerson')->with('getCompany')->first();
        $country = DB::table('countries')->where('countries_id', $customer->country)->first();
        // dd($customer);
        return view('customer.invoicecustomer', compact('customer', 'country', 'id'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-owner');
        $countries = DB::table('countries')->get();
        $owners = Customer::where('is_deleted', '!=', 1)->where('entity_type', 'Individual')->get();
        return view('customer.addCustomer', compact('countries', 'owners'));
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-owner');
        $rules = [
            'email' => 'required|string|email|max:255',
            'contact' => 'required',
            'entity_type' => 'required',
            'street' => 'required',
            'state' => 'required',
            'country' => 'required',
            'suburb' => 'required',
            'postal_code' => 'required',
            'eligibility' => 'required|in:Eligible,Ineligible',
        ];

        if ($request->entity_type == 'Individual') {
            $rules['first_name'] = 'required|string|max:255';
            $rules['last_name'] = 'required|string|max:255';
            $rules['date_of_birth'] = 'required|date|before:today';
            $rules['crn'] = 'required';
        } elseif ($request->entity_type == 'Trust') {
            $rules['trust_name'] = 'required|string|max:255';
            $rules['crn'] = 'required';
            $rules['abn'] = 'required';
            $rules['radio_option'] = 'required';
            $rules['trustee_contact_person'] = 'required';
        } else {
            $rules['company_name'] = 'required|string|max:255';
            $rules['acn'] = 'required';
            $rules['abn'] = 'required';
            $rules['crn'] = 'required';
            $rules['company_contact_person'] = 'required';
        }

        $request->validate($rules);
        $customer = new Customer();
        $customer->entity_type = $request->entity_type;
        if ($request->entity_type == 'Individual') {
            $customer->c_first_name = $request->first_name;
            $customer->c_last_name = $request->last_name;
            $customer->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $customer->contact_person = null;
            $customer->trustee = null;
            $customer->company = null;
            $customer->acn = null;
            $customer->abn = null;
        } elseif ($request->entity_type == 'Trust') {
            $customer->c_first_name = $request->trust_name;
            $customer->contact_person = $request->trustee_contact_person;
            $customer->trustee = $request->radio_option;
            if ($request->radio_option == 'Company') {
                $customer->company = $request->trustee_company;
            } else {
                $customer->company = null;
            }
            $customer->abn = $request->abn;
            $customer->acn = null;
            $customer->c_last_name = null;
            $customer->date_of_birth = null;
        } else {
            $customer->c_first_name = $request->company_name;
            $customer->contact_person = $request->company_contact_person;
            $customer->acn = $request->acn;
            $customer->abn = $request->abn;
            $customer->c_last_name = null;
            $customer->date_of_birth = null;
            $customer->trustee = null;
            $customer->company = null;
        }
        $customer->crn = $request->crn;
        $customer->suburb = $request->suburb;
        $customer->email = $request->email;
        $customer->contact = $request->contact;
        $customer->street_address = $request->street;
        $customer->state = $request->state;
        $customer->country = $request->country;
        $customer->postal_code = $request->postal_code;
        $customer->eligibility = $request->eligibility;
        $customer->is_active = 1;
        $customer->is_deleted = 0;
        $customer->added_by = Auth::id();
        $customer->save();

        if (isset($customer->customer_id)) {
            $request->session()->flash('alert-success', 'Owner added successfully');
            $notification = array(
                'success' => true,
                'message' => 'Owner added successfully',
                'customer_id' => $customer->customer_id,
            );
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
            $notification = array(
                'success' => false,
                'message' => 'Something went wrong!',
            );
        }
        return response()->json($notification);
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-owner');
        $customer = Customer::where('customer_id', $id)->first();
        $countries = DB::table('countries')->get();
        $owners = Customer::where('is_deleted', '!=', 1)->where('entity_type', 'Individual')->get();
        return view('customer.editCustomer', compact('customer', 'countries', 'owners'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-owner');
        $rules = [
            'email' => 'required|string|email|max:255',
            'contact' => 'required',
            'entity_type' => 'required',
            'street' => 'required',
            'state' => 'required',
            'country' => 'required',
            'suburb' => 'required',
            'postal_code' => 'required',
            'eligibility' => 'required|in:Eligible,Ineligible',
        ];

        if ($request->entity_type == 'Individual') {
            $rules['first_name'] = 'required|string|max:255';
            $rules['last_name'] = 'required|string|max:255';
            $rules['date_of_birth'] = 'required|date|before:today';
            $rules['crn'] = 'required';
        } elseif ($request->entity_type == 'Trust') {
            $rules['trust_name'] = 'required|string|max:255';
            $rules['crn'] = 'required';
            $rules['abn'] = 'required';
            $rules['radio_option'] = 'required';
            $rules['trustee_contact_person'] = 'required';
        } else {
            $rules['company_name'] = 'required|string|max:255';
            $rules['acn'] = 'required';
            $rules['abn'] = 'required';
            $rules['crn'] = 'required';
            $rules['company_contact_person'] = 'required';
        }

        $request->validate($rules);
        $customer = Customer::where('customer_id', $id)->first();
        $customer->entity_type = $request->entity_type;
        if ($request->entity_type == 'Individual') {
            $customer->c_first_name = $request->first_name;
            $customer->c_last_name = $request->last_name;
            $customer->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $customer->contact_person = null;
            $customer->trustee = null;
            $customer->company = null;
            $customer->acn = null;
            $customer->abn = null;
        } elseif ($request->entity_type == 'Trust') {
            $customer->c_first_name = $request->trust_name;
            $customer->contact_person = $request->trustee_contact_person;
            $customer->trustee = $request->radio_option;
            if ($request->radio_option == 'Company') {
                $customer->company = $request->trustee_company;
            } else {
                $customer->company = null;
            }
            $customer->abn = $request->abn;
            $customer->acn = null;
            $customer->c_last_name = null;
            $customer->date_of_birth = null;
        } else {
            $customer->c_first_name = $request->company_name;
            $customer->contact_person = $request->company_contact_person;
            $customer->acn = $request->acn;
            $customer->abn = $request->abn;
            $customer->c_last_name = null;
            $customer->date_of_birth = null;
            $customer->trustee = null;
            $customer->company = null;
        }
        $customer->crn = $request->crn;
        $customer->suburb = $request->suburb;
        $customer->email = $request->email;
        $customer->contact = $request->contact;
        $customer->street_address = $request->street;
        $customer->state = $request->state;
        $customer->country = $request->country;
        $customer->postal_code = $request->postal_code;
        $customer->eligibility = $request->eligibility;
        $customer->is_active = 1;
        $customer->is_deleted = 0;
        $customer->save();
        $request->session()->flash('alert-success', 'Owner updated successfully');
        $notification = array(
            'success' => true,
            'message' => 'Owner updated successfully',
            'customer_id' => $id,
        );
        return response()->json($notification);
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-owner');
        $id = $request->id;
        DB::table('customer')->where('customer_id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'Owner successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-owner');
        $id = $request->id;
        $status = $request->status;
        DB::table('customer')->where('customer_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }

    public function getOwners(Request $request)
    {
        $owners = Customer::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->where('entity_type', 'Individual')->get();
        $notification = [
            'success' => true,
            'owners' => $owners
        ];
        return response()->json($notification);
    }

    public function getCompanies(Request $request)
    {
        $owners = Customer::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->where('entity_type', 'Company')->with('contactPerson')->get();
        $notification = [
            'success' => true,
            'owners' => $owners
        ];
        return response()->json($notification);
    }

    // get owners based on type
    public function getOwnersBasedOnType(Request $request)
    {
        $type = $request->type;
        if (isset($request->id) && $request->id != null) {
            $owners = Customer::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->where('entity_type', $type)->orWhere('customer_id', $request->id)->with('contactPerson','getCompany')->get();
        } else {
            $owners = Customer::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->where('entity_type', $type)->with('contactPerson','getCompany')->get();
        }
        $notification = [
            'success' => true,
            'owners' => $owners,
        ];
        return response()->json($notification);
    }
}
