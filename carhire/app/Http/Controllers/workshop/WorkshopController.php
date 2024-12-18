<?php

namespace App\Http\Controllers\workshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkshopType;

use Illuminate\Support\Facades\Hash;

class WorkshopController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-workshop');
        $workshop = Workshop::where('is_deleted', '!=', 1)->get();
        return view('workshop.workshopList', compact('workshop'));
    }
    public function show($id)

   {
       $workshop = Workshop::where('workshop_id', $id)->first();
        $types = json_decode($workshop->workshop_type);
        $typeName=[];
        foreach($types as $type){
            $getType=WorkshopType::where('workshop_type_id',$type)->first()->workshop_type_name;
            array_push($typeName,$getType);
        }
       

           return view('workshop.invoiceworkshop',compact('workshop','id','typeName'));

   }
    public function create()

    {	
        Auth::user()->checkPermission('create-workshop');
        $type = WorkshopType::where('is_deleted', '!=', 1)->where('is_active', '=', 1)->get();
        return view('workshop.addWorkshop', compact('type'));

    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-workshop');
        $addedBy = Auth::id();
        $request->validate([
            'workshop_name' => 'required|string',
                
                'workshop_type' => 'required',
            'organizer_name' => 'required',

                'organizer_email' => 'required|email',
            'organizer_contact' => 'required|regex:/^[0-9]{10}$/',
        ]);
        $user = Workshop::create([
            'workshop_name' => $request->workshop_name,
            'workshop_address' => $request->workshop_address,

                'workshop_type' => json_encode($request->workshop_type),
            'organizer_name' => $request->organizer_name,
            'organizer_email' => $request->organizer_email,
            'organizer_contact' => $request->organizer_contact,
            'added_by' => $addedBy,
            'is_deleted' => 0,
            'is_active' => 1,
        ]);
        if (isset($user->id)) {
            $request->session()->flash('alert-success', 'Workshop added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('workshops');
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-workshop');
        $workshop = Workshop::where('workshop_id',$id)->first();

        $types = json_decode($workshop->workshop_type);
        $typeIds=[];
        foreach($types as $type){
            $getType=WorkshopType::where('workshop_type_id',$type)->first()->workshop_type_id;
            array_push($typeIds,$getType);
        }

        $allTypes = WorkshopType::where('is_deleted', '!=', 1)->where(function($query) use ($typeIds){
            $query->where('is_active', '=', 1)->orWhereIn('workshop_type_id',$typeIds);
        })->get();

        return view('workshop.editWorkshop',compact('workshop', 'allTypes','typeIds'));

    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-workshop');
         $request->validate([
            'workshop_name' => 'required|string',
            'workshop_type' => 'required',
            'organizer_name' => 'required',
            'organizer_email' => 'required|email',
            'organizer_contact' => 'required|regex:/^[0-9]{10}$/',

            ]);
                $workshop_name = $request->workshop_name;
                $workshop_type = json_encode($request->workshop_type);
                $workshop_address = $request->workshop_address;
                $organizer_name = $request->organizer_name;
                $organizer_email = $request->organizer_email;
                $organizer_contact = $request->organizer_contact;
        Workshop::where('workshop_id', $id)->limit(1)->update(array('workshop_name' => $workshop_name,'workshop_address' => $workshop_address,'workshop_type' =>  $workshop_type,'organizer_name'=>$organizer_name,'organizer_email'=>$organizer_email,'organizer_contact'=>$organizer_contact));

    

        $request->session()->flash('alert-success', 'Workshop updated successfully');
        return redirect()->route('workshops');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-workshop');
        $id = $request->id;
        Workshop::where('workshop_id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'Workshop successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-workshop');
        $id = $request->id;
        $status = $request->status;
        Workshop::where('workshop_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
    
    public function getWorkshops()
    {
        $workshops = Workshop::where('is_deleted', '!=', 1)->where('is_active', 1)->get();
        return [
            'workshops' => $workshops
        ];
    }
}
