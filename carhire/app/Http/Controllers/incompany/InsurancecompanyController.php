<?php
namespace App\Http\Controllers\incompany;
use App\Http\Controllers\Controller;
use App\Models\InsuranceCompany;

use App\Models\Insurance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class InsurancecompanyController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-insurance-company');
        $incompanyList = InsuranceCompany::where('is_deleted','!=' ,1)->get();
        return view('incompany.incompanyList',['incompanyList'=>$incompanyList]);
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-insurance-company');
        $incomapny = InsuranceCompany::where('ic_id', $id)->first();
        return view('incompany.invoiceincompany', compact('incomapny'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-insurance-company');
        return view('incompany.addincompany');
    }
    public function store(Request $req)
    {
        Auth::user()->checkPermission('create-insurance-company');
        $req->validate([
            'incompany_name' => 'required|string|max:255',
            'incompany_address' => 'required|string|max:255',
            'incompany_reg_no' => 'required|regex:/^[0-9]{10}$/',
        ]);
        $insert = new InsuranceCompany;
        $insert->icompany_name = $req->incompany_name;
        $insert->icompany_reg_no = $req->incompany_reg_no;
        $insert->icompany_address = $req->incompany_address;
        $insert->is_deleted = 0;
        $insert->is_active = 1;
        if ($insert->save()) {
            $req->session()->flash('alert-success', 'Insurance Company added successfully');
            return redirect()->route('insurance-companies');
        } else {
            $req->session()->flash('alert-danger', 'Something went wrong!');
            return back();
        }
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-insurance-company');
        $edit = InsuranceCompany::where('ic_id',$id)->first();
        return view('incompany.editincompany',['edit'=>$edit]);
    }
    public function update(Request $req, $id)
    {
        Auth::user()->checkPermission('edit-insurance-company');
        $adminId = Auth::id();
        $icompany_name = $req->incompany_name;
        $icompany_reg_no = $req->incompany_reg_no;
        $icompany_address = $req->incompany_address;
       ;
       InsuranceCompany::where('ic_id', $id)->limit(1)->update(array('icompany_name' => $icompany_name, 'icompany_reg_no' => $icompany_reg_no, 'icompany_address' => $icompany_address));
        $req->session()->flash('alert-success', 'Insurance Company updated successfully');
        return redirect()->route('insurance-companies');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-insurance-company');
        $id = $request->id;

        // dd($id);
        // Check if there are any associated insurances
        $insuranceCount = Insurance::where('insurance_company_id', $id)->count();

        if ($insuranceCount > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Insurance company cannot be deleted as there are associated insurances.',
            ]);
        }

        InsuranceCompany::where('ic_id', $id)->limit(1)->update(array('is_deleted' => 1));
          return response()->json([
            'success' => true,
            'message' => 'Insurance Company successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-insurance-company');
        $id = $request->id;
        $status = $request->status;
        InsuranceCompany::where('ic_id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
}
