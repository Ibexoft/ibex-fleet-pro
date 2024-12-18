<?php

namespace App\Http\Controllers\booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comment;

class BookingController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('System-Driver')) {
            return redirect()->route('home');
        }
        Auth::user()->checkPermission('view-booking');
        $booking = Booking::join('vehicle', 'booking.vehicle_reg_id', 'vehicle.vehicle_id')
            ->join('driver', 'booking.driver_id', 'driver.driver_id')
            ->select('vehicle.vehicle_registration_no', 'booking.*', 'driver.first_name', 'driver.last_name')
            ->where('booking.is_deleted', '!=', 1)
            ->get();
        return view('booking.bookingList', compact('booking'));
    }
    public function show($id)
    {
        if (Auth::user()->hasRole('System-Driver')) {
            return redirect()->route('home');
        }
        Auth::user()->checkPermission('view-booking');
        $booking = Booking::with('customer')->where('booking_id', $id)->first();
        $vehicle = Vehicle::where('vehicle_id', $booking->vehicle_reg_id)->with('vehicle_owner')->first();
        $driver = Driver::where('driver_id', $booking->driver_id)->first();
        $comments = Comment::where('booking_id', $id)->orderBy('comment_id', 'desc')->get();

        $endDate = Carbon::parse($booking->end_date)->endOfDay();
        $currentDate = Carbon::now('Australia/Brisbane');
        $remainingTimeInSeconds = $currentDate->diffInSeconds($endDate);

        $isEndToday = $endDate->isToday();

        return view('booking.invoiceBooking', compact('booking', 'vehicle', 'driver', 'id', 'comments', 'isEndToday', 'remainingTimeInSeconds'));
    }
    public function create($id = null, $startDate = null, $endDate = null)
    {
        Auth::user()->checkPermission('create-booking');
        if ($id) {
            $vehicle = Vehicle::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->where('vehicle_id', $id)->first();
        } else {
            $vehicle = Vehicle::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->get();
        }
        $driver = Driver::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->get();
        $bond_held = Customer::where('is_deleted', '!=', 1)->where('eligibility', '=', 'Eligible')->get();
        if ($id) {
            if (!Auth::user()->hasRole('System-Driver')) {
                return redirect()->route('booking.create');
            }
            $brand = DB::table('brands')->where('brand_id', $vehicle->vehicle_making_company)->first()->name;
            return view('website.booking_form', compact('vehicle', 'driver', 'bond_held', 'id', 'brand', 'startDate', 'endDate'));
        } else {
            if (!Auth::user()->hasRole('System-Driver')) {
                return view('booking.addBooking', compact('vehicle', 'driver', 'bond_held'));
            }
            return redirect()->route('home');
        }
    }

    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-booking');
        $addedBy = Auth::id();
        $request->validate([
            'driver_id' => 'required',
            'vehicle_reg_id' => 'required',
            'starting_date' => 'required',
            'ending_date' => 'required|date|after_or_equal:starting_date',
            'amount' => 'required',
            'contract_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'ezidebit_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'insurance_declaration_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'handover_checklist_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'bond_held' => 'nullable|exists:customer,customer_id',
            'bond_amount' => 'nullable|numeric|min:0',
        ]);
        if ($request->has('contract_image')) {
            $image = $request->file('contract_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'contract_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $contract_image = $image->move('uploads/documents/', $image_path);
        } else {
            $contract_image = '';
        }
        if ($request->has('ezidebit_image')) {
            $image = $request->file('ezidebit_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'ezidebit_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $ezidebit_image = $image->move('uploads/documents/', $image_path);
        } else {
            $ezidebit_image = '';
        }
        if ($request->has('insurance_declaration_image')) {
            $image = $request->file('insurance_declaration_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'insurance_declaration_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $insurance_declaration_image = $image->move('uploads/documents/', $image_path);
        } else {
            $insurance_declaration_image = '';
        }
        if ($request->has('handover_checklist_image')) {
            $image = $request->file('handover_checklist_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'handover_checklist_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $handover_checklist_image = $image->move('uploads/documents/', $image_path);
        } else {
            $handover_checklist_image = '';
        }

        $data = [
            'driver_id' => $request->driver_id,
            'vehicle_reg_id' => $request->vehicle_reg_id,
            'end_date' => Carbon::createFromFormat('d-m-Y', $request->ending_date)->format('Y-m-d'),
            'start_date' => Carbon::createFromFormat('d-m-Y', $request->starting_date)->format('Y-m-d'),
            'amount' => $request->amount,
            'comments' => $request->comments,
            'bond_held' => $request->bond_held,
            'bond_amount' => $request->bond_amount,
            'contract_image' => $contract_image,
            'ezidebit_image' => $ezidebit_image,
            'insurance_declaration_image' => $insurance_declaration_image,
            'handover_checklist_image' => $handover_checklist_image,
            'date_status' => 'end',
            'added_by' => $addedBy,
            'is_deleted' => 0,
            'is_active' => 1,
        ];
        if (!Auth::user()->hasRole('System-Driver')) {
            $data['status'] = "Booked";
        }

        $booking = Booking::create($data);

        if (isset($booking->booking_id)) {
            if (Auth::user()->hasRole('System-Driver')) {
                $vehicle = Vehicle::where('vehicle_id', $request->vehicle_reg_id)->first();
                $bookingLink = route('booking.show', ['id' => $booking->booking_id]);
                $startDate = Carbon::createFromFormat('Y-m-d', $data['start_date'])->format('d-m-y');
                $endDate = Carbon::createFromFormat('Y-m-d', $data['end_date'])->format('d-m-y');
                $comments = !empty($data['comments']) ? '<strong>Additional comments</strong>: ' . $data['comments'] . '.' : '';
                $appName = env('APP_NAME', 'Ibex Fleet Pro');
                $formattedBookingId = 'B-' . str_pad($booking->booking_id, 5, '0', STR_PAD_LEFT);
                $emailData = [
                    'subject' => 'New Booking Requested by ' . Auth::user()->driver->first_name . ' ' . Auth::user()->driver->last_name,
                    'html' => '
                    <p>Dear Admin,</p>
                    <p>We are pleased to inform you that <strong>' . Auth::user()->driver->first_name . ' ' . Auth::user()->driver->last_name . ' (' . Auth::user()->driver->email . ')' . '</strong> has requested a new booking (Booking ID: ' . $formattedBookingId . ').</p>
                    <p><strong>VIN:</strong> ' . $vehicle->vin . '</p>
                    <p><strong>Vehicle Registration Number:</strong> ' . $vehicle->vehicle_registration_no . '</p>
                    <p><strong>Start Date:</strong> ' . $startDate . '</p>
                    <p><strong>End Date:</strong> ' . $endDate . '</p>
                    ' . $comments . '
                    <p>You can view the booking details <a href="' . $bookingLink . '">here</a>.</p>
                    <p>Please review the booking details at your earliest convenience.</p>
                    <p>Kind regards,</p>
                    <p>The ' . $appName . ' Team</p>
                ',
                ];
                email($emailData);
            }
            $request->session()->flash('alert-success', 'Booking added successfully');
            $notification = array('success' => true, 'message' => 'Booking created successfully', 'booking_id' => $booking->booking_id);
            return $notification;
        } else {
            $notification =  array('success' => false, 'message' => 'Booking could not be created');
            return $notification;
        }
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-booking');
        $booking = Booking::where('booking_id', $id)->with('vehicle', 'driver')->first();
        $bond_held = Customer::where('is_deleted', '!=', 1)->where('eligibility', '=', 'Eligible')->get();
        return view('booking.editBooking', compact('booking', 'bond_held'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-booking');
        $request->validate([
            'driver_id' => 'required',
            'vehicle_reg_id' => 'required',
            'starting_date' => 'required',
            'ending_date' => 'required|date|after_or_equal:starting_date',
            'amount' => 'required',
            'contract_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'ezidebit_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'insurance_declaration_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'handover_checklist_image' => 'sometimes|mimes:jpeg,jpg,png,pdf',
            'bond_held' => 'nullable|exists:customer,customer_id',
            'bond_amount' => 'nullable|numeric|min:0',
        ]);

        if ($request->has('contract_image') && $request->changed_contract_image != 1) {
            $image = $request->file('contract_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'contract_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $contract_image = $image->move('uploads/documents/', $image_path);
        } else if ($request->changed_contract_image == 1) {
            $contract_image = '';
        } else {
            $contract_image = Booking::where('booking_id', $id)->first()->contract_image;
        }

        if ($request->has('ezidebit_image') && $request->changed_ezidebit_image != 1) {
            $image = $request->file('ezidebit_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'ezidebit_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $ezidebit_image = $image->move('uploads/documents/', $image_path);
        } elseif ($request->changed_ezidebit_image == 1) {
            $ezidebit_image = '';
        } else {
            $ezidebit_image = Booking::where('booking_id', $id)->first()->ezidebit_image;
        }

        if ($request->has('insurance_declaration_image') && $request->changed_insurance_declaration_image != 1) {
            $image = $request->file('insurance_declaration_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'insurance_declaration_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $insurance_declaration_image = $image->move('uploads/documents/', $image_path);
        } elseif ($request->changed_insurance_declaration_image == 1) {
            $insurance_declaration_image = '';
        } else {
            $insurance_declaration_image = Booking::where('booking_id', $id)->first()->insurance_declaration_image;
        }
        if ($request->has('handover_checklist_image') && $request->changed_handover_checklist_image != 1) {
            $image = $request->file('handover_checklist_image');
            $img_extenstion = strtolower($image->getClientOriginalExtension());
            $allow_extentions = config('app.allow_extensions');
            if (!in_array($img_extenstion, $allow_extentions)) {
                $notification = array(
                    'success' => false,
                    'message' => config('app.msg')
                );
                return $notification;
            }
            $filename = 'handover_checklist_image' . time() . rand(11111, 9999) . '.';
            $image_path = $filename . $img_extenstion;
            $handover_checklist_image = $image->move('uploads/documents/', $image_path);
        } elseif ($request->changed_handover_checklist_image == 1) {
            $handover_checklist_image = '';
        } else {
            $handover_checklist_image = Booking::where('booking_id', $id)->first()->handover_checklist_image;
        }


        $adminId = Auth::id();
        $vehicle_reg_id = $request->vehicle_reg_id;
        $driver_id = $request->driver_id;
        $starting_date = Carbon::createFromFormat('d-m-Y', $request->starting_date)->format('Y-m-d');
        $amount = $request->amount;
        $comments = $request->comments;
        $bond_held = $request->bond_held;
        $bond_amount = $request->bond_amount;
        $type_date = $request->type_date;
        $current_date = $request->current_date;
        $ending_date = Carbon::createFromFormat('d-m-Y', $request->ending_date)->format('Y-m-d');
        if ($type_date == 0) {
            $date_status = 'current';
        } else {
            $date_status = 'end';
        }
        $booking = Booking::where('booking_id', $id)
            ->limit(1)
            ->update(['vehicle_reg_id' => $vehicle_reg_id, 'driver_id' => $driver_id, 'start_date' => $starting_date, 'end_date' => $ending_date, 'amount' => $amount, 'comments' => $comments, 'date_status' => $date_status, 'contract_image' => $contract_image, 'ezidebit_image' => $ezidebit_image, 'insurance_declaration_image' => $insurance_declaration_image, 'handover_checklist_image' => $handover_checklist_image, 'bond_held' => $bond_held, 'bond_amount' => $bond_amount]);
        if ($booking) {
            $request->session()->flash('alert-success', 'Booking updated successfully');
            $notification = array('success' => true, 'message' => 'Booking updated successfully');
            return $notification;
        } else {
            $notification = array('success' => false, 'message' => 'Booking could not be updated');
            return $notification;
        }
        // return redirect()->route('booking.show', $id);
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-booking');
        $id = $request->id;
        Booking::where('booking_id', $id)
            ->limit(1)
            ->update(['is_deleted' => 1]);
        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-booking');
        $id = $request->id;
        $status = $request->status;
        Booking::where('booking_id', $id)
            ->limit(1)
            ->update(['is_active' => $status]);
        $response = ['success' => '1', 'message' => 'Status Updated successfully'];
        echo json_encode($response);
    }
    public function returndate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Booked,Completed'
        ]);

        Auth::user()->checkPermission('edit-booking');

        $booking = Booking::where('booking_id', $id)->first();

        if ($booking) {
            $status = $request->input('status');

            if ($status === 'Completed') {
                $booking->update(['actual_return_date' => Carbon::now()]);
            }

            $booking->update(['status' => $status]);

            $request->session()->flash('alert-success', 'Booking status updated successfully');
        } else {
            $request->session()->flash('alert-danger', 'Booking not found');
        }

        return redirect()->route('booking.show', $id);
    }

    public function graphData()
    {
        // get last 30 days bookings count according to each day and display in chart
        $last_30_days_bookings = Booking::select(DB::raw('DATE(start_date) as date'), DB::raw('count(*) as total'))
            ->where('is_deleted', '!=', 1)
            ->where('start_date', '>=', date('Y-m-d', strtotime('-30 days')))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();
        // now break above in two array for chart
        $labels = array_column($last_30_days_bookings, 'date');
        // change dat format
        $labels = array_map(function ($value) {
            return date('d M', strtotime($value));
        }, $labels);
        $data = array_column($last_30_days_bookings, 'total');
        return response()->json(['labels' => $labels, 'data' => $data, 'success' => true]);
    }

    public function availability(Request $request)
    {
        $startingDate = Carbon::createFromFormat('d-m-Y', $request->starting_date)->format('Y-m-d');
        $endingDate = Carbon::createFromFormat('d-m-Y', $request->ending_date)->format('Y-m-d');
        $bookingToExclude = Booking::where('booking_id', $request->booking_id)->first();
        $availableVehicles = Vehicle::with('vehicle_owner', 'maintenance', 'booking')
            ->where('is_deleted', '!=', 1)->where('is_active','=', 1)

            ->get()
            ->filter(function ($vehicle) use ($startingDate, $endingDate, $bookingToExclude) {
                // Check if any booking overlaps with the provided date range
                $bookingExists = $vehicle->booking->first(function ($booking) use ($startingDate, $endingDate, $bookingToExclude) {
                    if ($bookingToExclude) {
                        return !$booking->is_deleted && ($booking->start_date <= $endingDate && $booking->end_date >= $startingDate) && $booking->booking_id != $bookingToExclude->booking_id;
                    } else {
                        return !$booking->is_deleted &&
                            ($booking->start_date <= $endingDate && $booking->end_date >= $startingDate);
                    }
                });

                // Check if any maintenance overlaps with the provided date range
                $maintenanceExists = $vehicle->maintenance->first(function ($maintenance) use ($startingDate, $endingDate) {
                    return ($maintenance->maintenance_date >= $startingDate && $maintenance->maintenance_date <= $endingDate)
                        && $maintenance->job_status == 1;
                });

                // Filter out vehicles that are currently in booking or maintenance during the provided date range
                return !$bookingExists && !$maintenanceExists;
            })
            ->map(function ($vehicle) {
                return $vehicle;
            });
        // Get all available drivers
        $availableDrivers = Driver::with('booking', 'maintenance')
            ->where('is_deleted', '!=', 1)->where('is_active', '=', 1)
            ->get()
            ->filter(function ($driver) use ($startingDate, $endingDate, $bookingToExclude) {
                // Check if any booking overlaps with the provided date range
                $bookingExists = $driver->booking->first(function ($booking) use ($startingDate, $endingDate, $bookingToExclude) {
                    if ($bookingToExclude) {
                        return !$booking->is_deleted && ($booking->start_date <= $endingDate && $booking->end_date >= $startingDate) && $booking->booking_id != $bookingToExclude->booking_id;
                    } else {
                        return !$booking->is_deleted &&
                            ($booking->start_date <= $endingDate && $booking->end_date >= $startingDate);
                    }
                });

                // Check if any maintenance overlaps with the provided date range
                $maintenanceExists = $driver->maintenance->first(function ($maintenance) use ($startingDate, $endingDate) {
                    return ($maintenance->maintenance_date >= $startingDate && $maintenance->maintenance_date <= $endingDate)
                        && $maintenance->job_status == 1;
                });

                // Filter out drivers that are currently in booking or maintenance during the provided date range
                return !$bookingExists && !$maintenanceExists;
            })
            ->map(function ($driver) {
                return $driver;
            });

        
        // Add driver and conflicting booking logic
        $driver = $bookingToExclude ? $bookingToExclude->driver : null;
        $conflictingBooking = null;

        if ($driver) {
            // Filter bookings that are not the same as bookingToExclude
            $driverBookings = $driver->booking->filter(function ($booking) use ($startingDate, $endingDate, $bookingToExclude) {
                return !$booking->is_deleted && $booking->booking_id != $bookingToExclude->booking_id && 
                    ($booking->start_date <= $endingDate && $booking->end_date >= $startingDate);
            });
    
            // If there are conflicting bookings, set the first one
            if ($driverBookings->isNotEmpty()) {
                $conflictingBooking = $driverBookings->first();
            }
        }

        // Prepare response data
        $availableResources = [
            'vehicles' => $availableVehicles->values(),
            'drivers' => $availableDrivers->values(),
            'success' => true,
            'conflictingBooking' => $conflictingBooking
        ];

        if (Auth::user()->hasRole('Driver')) {
            $isActive = Driver::where('user_id', Auth::user()->id)->first()->is_active;
            $availableResources['isActive'] = $isActive;
        }

        return $availableResources;
    }

    public function storeComment(Request $request)
    {
        $userId = Auth::id();
        $bookingId = $request->booking_id;

        // Validate the request
        $request->validate([
            'booking_id' => 'required|exists:booking,booking_id',
            'comment' => 'required',
        ]);

        // Create the comment
        $comment = Comment::create([
            'booking_id' => $bookingId,
            'user_id' => $userId,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'comment' => $comment->comment,
            'commentId' => $comment->comment_id,
            'user_name' => $comment->user->name,
        ]);
    }
    // comment delete and edit controller functions are in Comment Controller
    public function reservations()
    {
        if (!Auth::user()->hasRole('System-Driver')) {
            return redirect()->route('bookings');
        }
        $userId = Auth::user()->driver->driver_id;
        $bookings = DB::table('booking')
            ->join('vehicle', 'booking.vehicle_reg_id', '=', 'vehicle.vehicle_id')
            ->join('brands', 'vehicle.vehicle_making_company', '=', 'brands.brand_id')
            ->where('booking.driver_id', $userId)
            ->where('booking.is_deleted', '!=', 1)
            ->select(
                'booking.*',
                'vehicle.*',
                'brands.name as brand_name',
                'booking.created_at as booking_created_at',
                'vehicle.created_at as vehicle_created_at'
            )
            ->orderBy('booking_id', 'desc')
            ->get();
        return view('website.my_reservations', compact('bookings'));
    }

    public function extendEndDate(Request $request, $id)
    {
        // Check user permissions
        Auth::user()->checkPermission('edit-booking');

        $request->validate([
            'new_ending_date' => 'required|date',
        ]);

        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
        }

        $newEndingDate = Carbon::createFromFormat('d-m-Y', $request->new_ending_date)->format('Y-m-d');

        // Ensure the new ending date is after the current ending date
        if (Carbon::parse($newEndingDate)->lt(Carbon::parse($booking->end_date))) {
            return response()->json([
                'success' => false,
                'message' => 'New ending date must be after the current ending date',
            ]);
        }

        // Update the booking's end date
        $booking->end_date = $newEndingDate;
        $booking->save();

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Booking extended successfully',
            'new_end_date' => $newEndingDate,
        ]);
    }
}
