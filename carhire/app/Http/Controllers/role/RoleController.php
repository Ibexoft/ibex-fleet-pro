<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-role');
        $role = Role::whereNotIn('name', ['Super-Admin', 'System-Driver'])->get();
        return view('role.rolelist', compact('role'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-role');
        return view('role.addRole');
    }

    public function store(Request $request)
    {
        // Custom validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('alert-danger', 'Role name already exists');
            return Redirect::back();
        }

        // Create the role
        $role = Role::create(['name' => $request->name]);

        $prefixes = ['view', 'create', 'edit', 'delete'];

        // Loop through the request inputs to find permissions and assign them to the role
        foreach ($request->all() as $key => $value) {
            // Check if the input key starts with any of the prefixes
            foreach ($prefixes as $prefix) {
                if (strpos($key, $prefix . '_') === 0) {
                    // Extract the permission name from the input key and convert it to kebab-case
                    $permissionName = $prefix . '-' . str_replace('_', '-', substr($key, strlen($prefix) + 1));

                    // Give permission to the role based on the value of the input
                    if ($value) {
                        $role->givePermissionTo($permissionName);
                    }
                }
            }
        }

        if (isset($role)) {
            $request->session()->flash('alert-success', 'Role created successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }

        return redirect()->route('roles');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-role');
        $role = Role::where('id', $id)->with('permissions')->first();
        // dd($role);
        return view('role.editRole', compact('role'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-role');
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $role = Role::where('id', $id)->first();
        $role->name = $request->name;
        $role->save();

        // delete all permissions of the role
        $role->permissions()->detach();

        $prefixes = ['view', 'create', 'edit', 'delete'];

        // Loop through the request inputs to find permissions and assign them to the role
        foreach ($request->all() as $key => $value) {
            // Check if the input key starts with any of the prefixes
            foreach ($prefixes as $prefix) {
                if (strpos($key, $prefix . '_') === 0) {
                    // Extract the permission name from the input key and convert it to kebab-case
                    $permissionName = $prefix . '-' . str_replace('_', '-', substr($key, strlen($prefix) + 1));

                    // Give permission to the role based on the value of the input
                    if ($value) {
                        $role->givePermissionTo($permissionName);
                    }
                }
            }
        }

        $request->session()->flash('alert-success', 'Role updated successfully');
        return redirect()->route('roles');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-role');
        $id = $request->id;
        Role::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Role successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-role');
        $id = $request->id;
        $status = $request->status;
        Role::where('id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
}
