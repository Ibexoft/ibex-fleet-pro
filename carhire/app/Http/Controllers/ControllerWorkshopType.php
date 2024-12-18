<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkshopType;
use Illuminate\Support\Facades\Auth;

class ControllerWorkshopType extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-workshop-type');
        $workshop_type = WorkshopType::where('is_deleted', '!=', 1)->get();
        return view('workshop-type.list', compact('workshop_type'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-workshop-type');
        return view('workshop-type.add');
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-workshop-type');
        $addedBy = Auth::id();
        $request->validate([
            'workshop_type_name' => 'required|string|max:191',
        ]);
        $user = WorkshopType::create([
            'workshop_type_name' => $request->workshop_type_name,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);
        if (isset($user->workshop_type_id)) {
            $request->session()->flash('alert-success', 'Workshop Type added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('workshop-types');
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-workshop-type');
        $workshop_type = WorkshopType::where('workshop_type_id', $id)->first();
        return view('workshop-type.edit', compact('workshop_type'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-workshop-type');
        $request->validate([
            'workshop_type_name' => 'required|string|max:191',
        ]);
        $workshop_type_name = $request->workshop_type_name;
        WorkshopType::where('workshop_type_id', $id)->limit(1)->update(array('workshop_type_name' => $workshop_type_name));
        $request->session()->flash('alert-success', 'Workshop Type updated successfully');
        return redirect()->route('workshop-types');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-workshop-type');
        $id = $request->id;
        WorkshopType::where('workshop_type_id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'Workshop Type successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-workshop-type');
        $id = intval($request->id);
        $status = $request->status;
        $statusTest = WorkshopType::where('workshop_type_id', $id)->first();
        $statusTest->is_active = $status;
        $statusTest->save();
        $response = array("success" => "1", "message" => "Status Updated successfully");
        return $response;
    }
    public function layout()
    {
        return view('workshop-type.layout');
    }
}
