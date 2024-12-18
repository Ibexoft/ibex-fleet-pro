<?php

namespace App\Http\Controllers\driver;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;

class DriverController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-driver');
        $driver = Driver::where('is_deleted', '!=', 1)->get();
        return view('driver.driverList', compact('driver'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-driver');
        $countries = DB::table('countries')->get();
        $driver_license_states = Config::get('app.states');
        return view('driver.addDriver', get_defined_vars());
    }
    public function store(Request $request)
    {
        // dd($request->all());
        Auth::user()->checkPermission('create-driver');
        $addedBy = Auth::id();
        $request->validate(
            [
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'contact' => 'required|regex:/^[0-9]{10}$/',
                'dob' => 'required|date|before:today',
                'driver_license_no' => Rule::unique('driver')->where(function ($query) use ($request) {
                    return $query->where('driver_license_no', $request->driver_license_no);
                }),

                'driver_license_state' => 'required|in:' . implode(',', config('app.states')),

                'license_expiry_date' => [
                    'required',
                    'date',
                    'after_or_equal:' . Carbon::today(),
                    'before_or_equal:' . Carbon::today()->addYears(15),
                ],
                // 'p_m_image' => 'required',
                'license_back_image' => 'required',
                'license_front_image' => 'required',
                'suburb' => 'required',
                'email' => 'required|string|email|max:255|unique:driver',
                // 'radio_option' => 'required',
            ],
            [
                // validation messages
                'license_expiry_date.after_or_equal' => 'The Licence Expiry Date must not be set to a date in the past.',
                'license_expiry_date.before_or_equal' => 'The Licence Expiry Date must not exceed a period of fifteen years from today.',
                'dob.before' => 'The Date of Birth must be a date before today.'
            ]
        );
        //saving image
        if ($request->has('image')) {
            $image = $request->file('image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());

            $allow_extentions = config('app.allow_img_extensions');

            if (!in_array($img_extenstion, $allow_extentions)) {

                return Redirect::back()->withErrors(config('app.allow_profile_msg'));
            }
            $filename = $request->first_name . '.';
            $image_path = 'driver_' . $filename . $img_extenstion;
            $uploaded_driverImage = $image->move('uploads/img/', $image_path);
        }
        // For back Image
        if ($request->has('license_back_image')) {
            $image = $request->file('license_back_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(config('app.msg'));
            }
            $filename = $request->driver_license_no . '_license_back_img.';
            $image_path = $filename . $img_extenstion;
            $upload_license_back_img = $image->move('uploads/img/', $image_path);
        }
        // For Front Image
        if ($request->has('license_front_image')) {
            $image = $request->file('license_front_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(config('app.msg'));
            }
            $filename = $request->driver_license_no . '_license_front_img.';
            $image_path = $filename . $img_extenstion;
            $uploaded_front_image = $image->move('uploads/img/', $image_path);
        }
        // For Passport Image
        if ($request->has('p_m_image')) {
            $image = $request->file('p_m_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(config('app.msg'));
            }
            $filename = $request->driver_license_no . '_p_m_img.';
            $image_path = $filename . $img_extenstion;
            $p_m_image = $image->move('uploads/img/', $image_path);
        }
        //saving Document
        if ($request->has('document')) {
            $image = $request->file('document');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = array('docx', 'pdf', 'jpeg', 'png', 'jpg');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(['msg' => 'Document format is not allowed only Pdf/Docx/jpeg/png/jpg are allowed formats']);
            }
            $filename = $request->driver_license_no . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $document = $image->move('uploads/documents/', $image_path);
        }
        if (isset($uploaded_driverImage) == 0) {
            $uploaded_driverImage = "";
        }
        if (isset($upload_license_back_img) == 0) {
            $upload_license_back_img = "";
        }
        if (isset($p_m_image) == 0) {
            $p_m_image = "";
        }
        if (isset($uploaded_front_image) == 0) {
            $uploaded_front_image = "";
        }
        if (isset($document) == 0) {
            $document = "";
        }
        $user = Driver::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact' => $request->contact,
            'email' => $request->email,
            'driver_license_no' => $request->driver_license_no,
            'driver_license_state' => $request->driver_license_state,
            'license_expiry_date' => Carbon::createFromFormat('d-m-Y', $request->license_expiry_date)->format('Y-m-d'),
            'street' => $request->street,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'dob' => Carbon::createFromFormat('d-m-Y', $request->dob)->format('Y-m-d'),
            'driver_image' => $uploaded_driverImage,
            'license_back_image' => $upload_license_back_img,
            'license_front_image' => $uploaded_front_image,
            'p_m_value' => $request->radio_option,
            'p_m_image' => $p_m_image,
            'other_document' => $document,
            'suburb' => $request->suburb,
            'ezi_debt' => $request->ezi_debt,
            'added_by' => $addedBy,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);
        if (isset($user->driver_id)) {
            $request->session()->flash('alert-success', 'Driver added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('drivers');
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-driver');
        $driver = Driver::where('driver_id', $id)->first();
        $countries = DB::table('countries')->where('countries_id', $driver->country)->first();
        return view('driver.viewDriver', compact('driver', 'countries', 'id'));
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-driver');
        $driver = Driver::where('driver_id', $id)->first();
        $countries = DB::table('countries')->get();
        $driver_license_states = Config::get('app.states');
        return view('driver.editDriver', get_defined_vars());
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-driver');
        $request->validate(
            [
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'contact' => 'required',
                'suburb' => 'required',
                'dob' => 'required|date|before:today',
                'driver_license_no' => Rule::unique('driver')->where(function ($query) use ($request, $id) {
                    return $query->where('driver_license_no', $request->driver_license_no)->where('driver_id', '!=', $id);
                }),

                'driver_license_state' => 'required|in:' . implode(',', config('app.states')),

                'license_expiry_date' => [
                    'sometimes',
                    'date',
                    'after_or_equal:' . Carbon::today(),
                    'before_or_equal:' . Carbon::today()->addYears(15),
                ],
                // 'radio_option' => 'required',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('driver')->ignore($id, 'driver_id'),
                ],
            ],
            [
                // validation messages
                'license_expiry_date.after_or_equal' => 'The Licence Expiry Date must not be set to a date in the past.',
                'license_expiry_date.before_or_equal' => 'The Licence Expiry Date must not exceed a period of fifteen years from today.',
                'dob.before' => 'The Date of Birth must be a date before today.'
            ]
        );
        if ($request->has('image')) {
            $image = $request->file('image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());

            $allow_extentions = config('app.allow_img_extensions');

            if (!in_array($img_extenstion, $allow_extentions)) {

                return Redirect::back()->withErrors(config('app.allow_profile_msg'));
            }
            $filename = $request->first_name . '.';
            $image_path = 'driver_' . $filename . $img_extenstion;
            $uploaded_driverImage = $image->move('uploads/img/', $image_path);
        }
        // For back Image
        if ($request->has('license_back_image')) {
            $image = $request->file('license_back_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(config('app.msg'));
            }
            $filename = $request->driver_license_no . '_license_back_img.';
            $image_path = $filename . $img_extenstion;
            $upload_license_back_img = $image->move('uploads/img/', $image_path);
        }
        // For Front Image
        if ($request->has('license_front_image')) {
            $image = $request->file('license_front_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(config('app.msg'));
            }
            $filename = $request->driver_license_no . '_license_front_img.';
            $image_path = $filename . $img_extenstion;
            $uploaded_front_image = $image->move('uploads/img/', $image_path);
        }
        // For Passport Image
        if ($request->has('p_m_image')) {
            $image = $request->file('p_m_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(config('app.msg'));
            }
            $filename = $request->driver_license_no . '_p_m_img.';
            $image_path = $filename . $img_extenstion;
            $upload_p_m_img = $image->move('uploads/img/', $image_path);
        }
        //saving Document
        if ($request->has('document')) {
            $image = $request->file('document');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = array('docx', 'pdf', 'jpeg', 'png', 'jpg');
            if (!in_array($img_extenstion, $allow_extentions)) {
                return Redirect::back()->withErrors(['msg' => 'Document format is not allowed only Pdf/Docx/Jpeg/png/jpg are allowed formats']);
            }
            $filename = $request->driver_license_no . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $document = $image->move('uploads/documents/', $image_path);
        }
        $driver = Driver::where('driver_id', $id)->first();
        if (isset($uploaded_driverImage) == 0 && $request->changed_image != 1) {
            $uploaded_driverImage = $driver->driver_image;
        } elseif ($request->changed_image == 1) {
            $uploaded_driverImage = '';
        }
        if (isset($upload_license_back_img) == 0 && $request->changed_license_back_image != 1) {
            $upload_license_back_img = $driver->license_back_image;
        } elseif ($request->changed_license_back_image == 1) {
            $upload_license_back_img = '';
        }
        if (isset($upload_p_m_img) == 0 && $request->changed_p_m_image != 1) {
            $upload_p_m_img = $driver->p_m_image;
        } elseif ($request->changed_p_m_image == 1) {
            $upload_p_m_img = '';
        }
        if (isset($uploaded_front_image) == 0 && $request->changed_license_front_image != 1) {
            $uploaded_front_image = $driver->license_front_image;
        } elseif ($request->changed_license_front_image == 1) {
            $uploaded_front_image = '';
        }
        if (isset($document) == 0 && $request->changed_other_document != 1) {

            $document = $driver->other_document;
        } elseif ($request->changed_other_document == 1) {
            $document = '1';
        }

        if (isset($request->email) == 0) {
            $request->email = $driver->email;
        }
        $adminId = Auth::id();
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $contact = $request->contact;
        $street = $request->street;
        $country = $request->country;
        $postal_code = $request->postal_code;
        $suburb = $request->suburb;
        $dob = Carbon::createFromFormat('d-m-Y', $request->dob)->format('Y-m-d');
        $state = $request->state;
        $driver_license_no = $request->driver_license_no;
        $driver_license_state = $request->driver_license_state;
        if ($request->license_expiry_date) {
            $license_expiry_date = Carbon::createFromFormat('d-m-Y', $request->license_expiry_date)->format('Y-m-d');
        } else {
            $license_expiry_date = Carbon::createFromFormat('d-m-Y', $driver->license_expiry_date)->format('Y-m-d');
        }
        $ezi_debt = $request->ezi_debt;
        $other_document = $document;
        Driver::where('driver_id', $id)->limit(1)->update(array('first_name' => $first_name, 'last_name' => $last_name, 'contact' => $contact, 'street' => $street, 'suburb' => $suburb, 'postal_code' => $postal_code, 'country' => $country, 'dob' => $dob, 'state' => $state, 'driver_license_no' => $driver_license_no, 'driver_license_state' => $driver_license_state, 'license_expiry_date' => $license_expiry_date, 'license_front_image' => $uploaded_front_image, 'license_back_image' => $upload_license_back_img, 'p_m_value' => $request->radio_option, 'p_m_image' => $upload_p_m_img, 'driver_image' => $uploaded_driverImage, 'ezi_debt' => $ezi_debt, 'other_document' => $other_document, 'email' => $email));
        
        //Updating registered driver's info to users table. 
        $driver = Driver::where('driver_id', $id)->first();
        if($driver->user_id){
            User::where('id', $driver->user_id)->limit(1)->update(array('name' => $request->first_name. ' ' . $request->last_name, 'email' => $request->email));
        }

        $request->session()->flash('alert-success', 'Driver updated successfully');
        return redirect()->route('drivers');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-driver');
        $id = $request->id;
        $driver = Driver::where('driver_id', $id)->first();

        $today = Carbon::today();
        $activeBookingsCount = Booking::where('driver_id', $id)
            ->where(function ($query) use ($today) {
                $query->whereDate('start_date', '<=', $today)
                    ->whereDate('end_date', '>=', $today);
            })
            ->where('is_deleted', 0)
            ->count();

        if ($activeBookingsCount > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to delete the driver due to an active booking.',
            ]);
        }

        $driver->update(['is_deleted' => 1]);
        return response()->json([
            'success' => true,
            'message' => 'Driver successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-driver');
        $id = $request->id;

        $checkDriver = Vehicle::with('vehicle_owner', 'maintenance', 'booking')
            ->get()
            ->map(function ($vehicle) use ($id) {
                $now = Carbon::now()->startOfDay(); // Truncate time component
                $status = 'Available'; // Default status

                // Check if any booking is active for the current date
                $bookingExists = $vehicle->booking->first(function ($booking) use ($now, $id) {
                    return $booking->is_deleted == 0 &&
                        $now->lessThanOrEqualTo($booking->start_date) &&
                        ($booking->driver_id == $id);
                });
                // If a booking is active, set status to 'rented'
                if ($bookingExists) {
                    $status = 'Rented';
                }

                return [
                    'vehicle' => $vehicle,
                    'status' => $status,
                ];
            });
        if ($checkDriver->where('status', 'Rented')->count() > 0) {
            $response = array("success" => "0", "message" => "Driver is booked with a vehicle.");
            return json_encode($response);
        } else {
            $status = $request->status;
            Driver::where('driver_id', $id)->limit(1)->update(array('is_active' => $status));
            $response = array("success" => "1", "message" => "Status Updated successfully");
            return json_encode($response);
        }
    }
    public function printDriverProfile($id)
    {
        $driver = Driver::where('driver_id', $id)->first();
        $countries = DB::table('countries')->where('countries_id', $driver->country)->first();
        return view('driver.printDriver', compact('driver', 'countries', 'id'));
    }
}
