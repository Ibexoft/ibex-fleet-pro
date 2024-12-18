<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        Auth::user()->checkPermission('view-user');
        $user = User::where('users.is_deleted', '!=', 1)->where('users.id', '!=', 1)->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->join('roles', 'model_has_roles.role_id', '=', 'roles.id')->where('roles.name', '!=', 'System-Driver')->select('users.*', 'roles.name as role')->get();
        return view('user.userlist', compact('user'));
    }
    public function show($id)
    {
        Auth::user()->checkPermission('view-user');
        $user = User::where('id', $id)->first();
        $role = Role::where('id', $user->roles->first()->id)->first();
        return view('user.invoiceuser', compact('user', 'role', 'id'));
    }
    public function create()
    {
        Auth::user()->checkPermission('create-user');
        $role = Role::where('name', '!=', 'System-Driver')->get();
        return view('user.addUser', compact('role'));
    }
    public function store(Request $request)
    {
        Auth::user()->checkPermission('create-user');
        $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_deleted' => 0,
            'is_active' => 1,
            'password' => Hash::make($request->password),
        ]);
        $roleName = Role::where('id', $request->role_id)->first();
        $user->assignRole($roleName->name);
        if (isset($user->id)) {
            $data = array('password' => $request->password, 'name' => $request->name, 'email' => $request->email);
            Mail::send('mail.register', $data, function ($message) use ($data) {
                $message->to($data['email'], 'Ibex FleetPro')->subject('User Registration Mail');
                $message->from('ella.mark611@gmail.com', 'User Registration Mail');
            });
        }
        if (isset($user->id)) {
            $request->session()->flash('alert-success', 'User added successfully');
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
        }
        return redirect()->route('users');
    }
    public function edit($id)
    {
        Auth::user()->checkPermission('edit-user');
        $role = Role::where('name', '!=', 'System-Driver')->get();
        $user = User::where('id', $id)->first();
        $userRole = $user->roles->first();
        return view('user.editUser', compact('user', 'role'));
    }
    public function update(Request $request, $id)
    {
        Auth::user()->checkPermission('edit-user');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id),],
            'role_id' => 'required',
            'password' => 'nullable|string|min:8|confirmed|sometimes',
            'confirm_password' => 'nullable|string|min:8|sometimes',
        ]);
        $adminId = Auth::id();
        $password = $request->password;
        $name = $request->name;
        $email = $request->email;
        $confirm_password = $request->password_confirmation;
        if ($password === $confirm_password) {
            if (isset($password)) {
                $password = Hash::make($password);
                DB::table('users')->where('id', $id)->limit(1)->update(array('name' => $name, 'email' => $email, 'password' => $password));
            } else {
                DB::table('users')->where('id', $id)->limit(1)->update(array('name' => $name, 'email' => $email));
            }
            $request->session()->flash('alert-success', 'User updated successfully');
        } else {
            $request->session()->flash('alert-danger', 'Confirm Password does not match');
        }
        $user = User::where('id', $id)->first();
        $roleName = Role::where('id', $request->role_id)->first();
        $user->removeRole($user->roles->first()->name);
        $user->assignRole($roleName->name);

        return redirect()->route('users');
    }
    public function destroy(Request $request)
    {
        Auth::user()->checkPermission('delete-user');
        $id = $request->id;
        User::where('id', $id)->limit(1)->update(array('is_deleted' => 1));
        return response()->json([
            'success' => true,
            'message' => 'User successfully deleted',
        ]);
    }
    public function statusUpdate(Request $request)
    {
        Auth::user()->checkPermission('edit-user');
        $id = $request->id;
        $status = $request->status;
        User::where('id', $id)->limit(1)->update(array('is_active' => $status));
        $response = array("success" => "1", "message" => "Status Updated successfully");
        echo json_encode($response);
    }
    public function editProfile(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        if ($user->hasRole('System-Driver')) {
            return view('website.account', compact('user'));
        } else {
            return view('user.editProfile', compact('user'));
        }
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|sometimes',
            'first_name' => 'required|string|max:255|sometimes',
            'last_name' => 'required|string|max:255|sometimes',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id()),],
            'password' => 'nullable|string|min:8|confirmed|sometimes',
            'confirm_password' => 'nullable|string|min:8|sometimes',
        ]);
        $adminId = Auth::id();
        $password = $request->password;
        if ($request->first_name & $request->last_name) {
            $name = $request->first_name . ' ' . $request->last_name;
        } else {
            $name = $request->name;
        }
        $email = $request->email;
        $confirm_password = $request->password_confirmation;
        if ($password === $confirm_password) {
            if (isset($password)) {
                $password = Hash::make($password);
                DB::table('users')->where('id', $adminId)->limit(1)->update(array('name' => $name, 'email' => $email, 'password' => $password));
            } else {
                DB::table('users')->where('id', $adminId)->limit(1)->update(array('name' => $name, 'email' => $email));
            }
            if ($request->first_name & $request->last_name) {
                DB::table('driver')->where('user_id', $adminId)->limit(1)->update(array('first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $email));
            }
            $request->session()->flash('alert-success', 'Profile updated successfully');
        } else {
            $request->session()->flash('alert-danger', 'Confirm Password does not match');
        }
        return redirect()->route('profile');
    }
}
