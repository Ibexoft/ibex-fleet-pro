<?php

namespace App\Http\Controllers\fine;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Fine;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class FineController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-fine');
        $fine = Fine::with('vehicle', 'payable', 'vehicle.vehicle_owner')->where('fine.is_deleted', '!=', 1)->get();
        return view('fine.fineList', compact('fine'));
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-fine');
        $fine = Fine::where('fine_id', $id)->first();
        $vehicle = DB::table('vehicle')->where('vehicle_id', $fine->vehicle_reg_id)->first();
        if ($fine->payable_type == 'App\Models\Driver') {
            $primaryKey = 'driver_id';
        } elseif ($fine->payable_type == 'App\Models\Customer') {
            $primaryKey = 'customer_id';
        }
        $comments = Comment::where('fine_id', $id)->orderBy('comment_id', 'desc')->get();
        $offender = $fine->payable_type::where($primaryKey, $fine->payable_id)->first();
        $customer = DB::table('customer')->where('customer_id', $vehicle->owner)->first();
        return view('fine.invoicefine', compact('fine', 'vehicle', 'offender', 'customer', 'id', 'comments'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-fine');
        $vehicle = Vehicle::where('is_deleted', '!=', 1)->get();
        $customer = Customer::where('is_deleted', '!=', 1)->get();
        $statuses = Config::get('app.fine_status');
        $notice_types = Config::get('app.notice_types');
        $police_states = Config::get('app.states');
        return view('fine.addFine', get_defined_vars());
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-fine');
        $addedBy = Auth::id();
        $request->validate([
            'vehicle_reg_id' => 'required|string|max:255',
            'amount' => 'required',
            'date_of_offence' => 'required',
            'notice_type' => 'required|in:' . implode(',', array_keys(config('app.notice_types'))),
            'council_name' => 'required_if:notice_type,3|nullable|string|max:100', // 3 represents City Council
            'recovery_company' => 'required_if:notice_type,4|nullable|string|max:100', // 4 represents Recovery
            'police_state' => 'required_if:notice_type,2|nullable|string|in:' . implode(',', config('app.states')), // 2 represents Police
            'due_date' => 'required|after_or_equal:date_of_offence',
            'date_process' => 'required|after_or_equal:date_of_offence',
            'status' => 'required|in:' . implode(',', config('app.fine_status')),
            'comment' => 'required_if:status,Other|nullable|string|max:255',

        ]);
        // Check which driver was driving the vehicle at the time of the offence
        $booking = DB::table('booking')->where('vehicle_reg_id', $request->vehicle_reg_id)->where('start_date', '<=', Carbon::createFromFormat('d-m-Y', $request->date_of_offence)->format('Y-m-d'))->where('end_date', '>=', Carbon::createFromFormat('d-m-Y', $request->date_of_offence)->format('Y-m-d'))->first();
        if ($booking) {
            $payable_id = $booking->driver_id;
            $payable_type = 'App\Models\Driver';
        } else {
            $payable_id = Vehicle::where('vehicle_id', $request->vehicle_reg_id)->first()->owner;
            $payable_type = 'App\Models\Customer';
        }

        $noticeTypeDetails = $this->buildNoticeTypeDetails($request);

        $fine = Fine::create([
            'vehicle_reg_id' => $request->vehicle_reg_id,
            'payable_id' => $payable_id,
            'payable_type' => $payable_type,
            'notice' => $request->notice,
            'notice_type' => $request->notice_type,
            'notice_type_details' => $noticeTypeDetails,
            'due_date' => Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d'),
            'amount' => $request->amount,
            'date_of_offence' => Carbon::createFromFormat('d-m-Y', $request->date_of_offence)->format('Y-m-d'),
            'date_process' => Carbon::createFromFormat('d-m-Y', $request->date_process)->format('Y-m-d'),
            'status' => $request->status,
            'comment' => $request->comment,
            'added_by' => $addedBy,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);
        if (isset($fine->fine_id)) {
            $request->session()->flash('alert-success', 'Fine added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        // dd($fine->fine_id);
        return redirect()->route('fines');
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-fine');
        $fine = Fine::where('fine_id', $id)->first();
        $vehicle = Vehicle::where('is_deleted', '!=', 1)->get();
        $offender = $fine->payable_type::where('is_deleted', '!=', 1)->get();
        $customer = Customer::where('is_deleted', '!=', 1)->get();
        $statuses = Config::get('app.fine_status');
        $notice_types = Config::get('app.notice_types');
        $police_states = Config::get('app.states');
        return view('fine.editFine', get_defined_vars());
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-fine');
        $request->validate([
            'vehicle_reg_id' => 'required|string|max:255',
            'date_of_offence' => 'required',
            'notice_type' => 'required|in:' . implode(',', array_keys(config('app.notice_types'))),
            'council_name' => 'nullable|required_if:notice_type,3|max:100',
            'recovery_company' => 'nullable|required_if:notice_type,4|max:100',
            'police_state' => 'nullable|required_if:notice_type,2|in:' . implode(',', config('app.states')),
            'due_date' => 'required|after_or_equal:date_of_offence',
            'date_process' => 'required|after_or_equal:date_of_offence',
            'amount' => 'required',
            'status' => 'required|in:' . implode(',', config('app.fine_status')),
            'comment' => 'required_if:status,Other|nullable|string|max:255',

        ]);
        $adminId = Auth::id();
        $booking = DB::table('booking')->where('vehicle_reg_id', $request->vehicle_reg_id)->where('start_date', '<=', Carbon::createFromFormat('d-m-Y', $request->date_of_offence)->format('Y-m-d'))->where('end_date', '>=', Carbon::createFromFormat('d-m-Y', $request->date_of_offence)->format('Y-m-d'))->first();
        if ($booking) {
            $payable_id = $booking->driver_id;
            $payable_type = 'App\Models\Driver';
        } else {
            $payable_id = Vehicle::where('vehicle_id', $request->vehicle_reg_id)->first()->owner;
            $payable_type = 'App\Models\Customer';
        }
        $vehicle_reg_id = $request->vehicle_reg_id;
        $notice = $request->notice;
        $notice_type = $request->notice_type;
        $noticeTypeDetails = $this->buildNoticeTypeDetails($request);
        $due_date = Carbon::createFromFormat('d-m-Y', $request->due_date)->format('Y-m-d');
        $amount = $request->amount;
        $date_of_offence = Carbon::createFromFormat('d-m-Y', $request->date_of_offence)->format('Y-m-d');
        $date_process = Carbon::createFromFormat('d-m-Y', $request->date_process)->format('Y-m-d');
        $status = $request->status;
        $comment = ($status === 'Other') ? $request->comment : null;
        Fine::where('fine_id', $id)->limit(1)->update(array('vehicle_reg_id' => $vehicle_reg_id, 'payable_id' => $payable_id, 'payable_type' => $payable_type, 'notice' => $notice, 'notice_type' => $notice_type, 'notice_type_details' => $noticeTypeDetails, 'due_date' => $due_date, 'amount' => $amount, 'date_of_offence' => $date_of_offence, 'date_process' => $date_process, 'status' => $status, 'comment' => $comment));
        $request->session()->flash('alert-success', 'Fine updated successfully');
        return redirect()->route('fines');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-fine');
        $id = $request->id;
        Fine::where('fine_id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'Fine successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-fine');
        $id = $request->id;
        $status = $request->status;
        Fine::where('fine_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
    public function FetchDriver(Request $request)
    {
        $id = $request->id;
        $model = DB::table('driver')->where('driver_id', $id)->get();
        $response = array("success" => "1", "message" => "success", "model" => $model);
        echo json_encode($response);
    }
    public function FetchOwner(Request $request)
    {
        $id = $request->id;
        $model = Customer::join('vehicle', 'customer.customer_id', 'vehicle.owner')->select('customer.customer_id', 'customer.c_first_name', 'customer.c_last_name')->where('vehicle.vehicle_id', $id)->get();
        $response = array("success" => "1", "message" => "success", "model" => $model);
        echo json_encode($response);
    }
    public function storeComment(Request $request)
    {
        $userId = Auth::id();
        $fineId = $request->fine_id;

        // Validate the request
        $request->validate([
            'fine_id' => 'required|exists:fine,fine_id',
            'comment' => 'required',
        ]);

        // Create the comment
        $comment = Comment::create([
            'fine_id' => $fineId,
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


    protected function buildNoticeTypeDetails($request)
    {
        $noticeTypeDetails = [];

        switch ($request->input('notice_type')) {
            case 2: // Police
                $noticeTypeDetails[$request->input('notice_type')] = $request->input('police_state');
                break;
            case 3: // City Council
                $noticeTypeDetails[$request->input('notice_type')] = $request->input('council_name');
                break;
            case 4: // Recovery
                $noticeTypeDetails[$request->input('notice_type')] = $request->input('recovery_company');
                break;
            default:
                // Handle other cases or do nothing
                break;
        }

        return $noticeTypeDetails;
    }
}
