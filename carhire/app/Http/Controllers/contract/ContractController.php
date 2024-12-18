<?php

namespace App\Http\Controllers\contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Insurance;
use App\Models\Tracking;
use Auth;
use DB;

class ContractController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('hello');
       $contract = Contract::join('vehicle','contract.vehicle_id','vehicle.vehicle_id')->join('driver','contract.driver_id','driver.driver_id')->join('insurance','contract.insurance_id','insurance.insurance_id')/*->join('tracking','contract.tracker_id','tracking.tracking_id')*/->select('vehicle.vehicle_name','contract.*','driver.first_name','driver.last_name',/*'tracking.tracker_name,'*/'insurance.*')->where('contract.is_deleted','!=' ,1)->get();
       //dd($contract);
        return view('contract.contractlist',compact('contract'));
    }

    public function invoice($id)
    {
      
        $contract = Contract::where('contract_id', $id)->first();
         $vehicle = DB::table('vehicle')->where('vehicle_id',$contract->vehicle_id)->first();
        $driver = DB::table('driver')->where('driver_id',$contract->driver_id)->first();
         $incompany = DB::table('insurance_company')->where('ic_id',$contract->insurance_id)->first();
            return view('contract.invoicecontract',compact('contract','vehicle','driver','incompany','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $vehicle = Vehicle::where('is_deleted', '!=' ,1)->get();
         $driver = Driver::where('is_deleted', '!=' ,1)->orderBy('first_name','asc')->get();
         $tracker = Tracking::where('is_deleted', '!=' ,1)->get();
         $insurance = Insurance::join('insurance_company','insurance.insurance_company_id','insurance_company.ic_id')->where('insurance.is_deleted', '!=' ,1)->get();
        // echo "<pre>";
        //   print_r($insurance);
        //   die();
          return view('contract.addContract',compact('vehicle','driver','tracker','insurance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request);
        // echo "<pre>";
        //   print_r($request->insurance_id);
        //    die();
            $addedBy = Auth::id();
            $request->validate([
                'vehicle_id' => 'required|string|max:255',
                'driver_id' => 'required|string|max:255',
                'insurance_id' => 'required',
                'per_week' => 'required',
            ]);


            $user = Contract::create([
                'vehicle_id' => $request->vehicle_id,
                'driver_id' => $request->driver_id,
                //'tracker_id' => $request->tracker_id,
                'insurance_id' => $request->insurance_id,
                'bond' => $request->Bond,
                'advance' => $request->advance,
                'held_by' => $request->held_by,
                'per_week' => $request->per_week,
                // 'rate_changes' => $request->rate_changes,
                // 'rego_due' => $request->rego_due,
                // 'coi_due' => $request->coi_due,
                // 'bhsl_due' => $request->bhsl_due,
                'return_date' => $request->start_date,
                // 'biller_code' => $request->biller_code,
                // 'reference_no' => $request->reference_no,
                'vin' => $request->vin,
                'added_by' => $addedBy,
                'is_deleted' => 0,
                'is_active' => 1,
            ]);
            if(isset($user->id)){
            $request->session()->flash('alert-success', 'Contract added successfully');
        }else{
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect('list-contract');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $contract = Contract::where('contract_id',$id)->first();
        // dd($contract);
        $vehicle = Vehicle::where('is_deleted', '!=' ,1)->get();
        $driver = Driver::where('is_deleted', '!=' ,1)->orderBy('first_name','asc')->get();
        $tracker = Tracking::where('is_deleted', '!=' ,1)->get();
        $insurance = Insurance::join('insurance_company','insurance.insurance_company_id','insurance_company.ic_id')->where('insurance.is_deleted', '!=' ,1)->get();
        return view('contract.editContract',compact('contract','driver','vehicle','tracker','insurance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'vehicle_id' => 'required|string|max:255',
            'driver_id' => 'required|string|max:255',
            'insurance_id' => 'required',
            'per_week' => 'required',
        ]);

        $vehicle_id = $request->vehicle_id;
        $driver_id = $request->driver_id;
        //$tracker_id = $request->tracker_id;
        $insurance_id = $request->insurance_id;
        $bond = $request->Bond;
        $advance = $request->advance;
        $held_by = $request->held_by;
        $per_week = $request->per_week;
        // $rate_changes = $request->rate_changes;
        // $rego_due = $request->rego_due;
        // $coi_due = $request->coi_due;
        // $bhsl_due = $request->bhsl_due;
        $start_date = $request->start_date;
        // $biller_code = $request->biller_code;
        // $reference_no = $request->reference_no;
        $vin = $request->vin;


        Contract::where('contract_id', $id)->limit(1)->update(array('vehicle_id' => $vehicle_id,'driver_id' => $driver_id,'insurance_id'=>$insurance_id,'bond'=>$bond,'advance'=>$advance,'held_by'=>$held_by,'per_week'=>$per_week,'return_date'=>$start_date,/*'reference_no'=>$reference_no,*/'vin'=>$vin,));

        $request->session()->flash('alert-success', 'Contract updated successfully');
        return redirect('list-contract');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Contract::where('contract_id', $id)->limit(1)->update(array('is_deleted' => 1));
          return response()->json([
            'success' => true,
            'message' => 'Contract successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        Fine::where('fine_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
      public function fetchVin(Request $request)
    {

        $id = $request->id;

        $vehicle = Vehicle::where('vehicle_id',$id)->first();
        $vehicle = $vehicle->vin;
        $response = array("success" => "1", "message" => "Status Updated successfully","vin"=>$vehicle);
        echo json_encode($response);
    }
      public function fetchInsurance(Request $request)
    {

        $id = $request->id;

        $insurance = Insurance::where('vehicle_reg_id',$id)->get();
        // $insurance = $insurance->bsb;
        $response = array("success" => "1", "message" => "Status Updated successfully","insurance"=>$insurance);
        echo json_encode($response);
    }
}
