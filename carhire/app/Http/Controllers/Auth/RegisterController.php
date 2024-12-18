<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'contact' => ['required', 'regex:/^[0-9]{10}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $name = $data['first_name'] . ' ' . $data['last_name'];

        $user = User::create([
            'name' => $name,
            'email' => $data['email'],
            'is_active' => 1,
            'is_deleted' => 0,
            'password' => Hash::make($data['password']),
        ]);

        // Assign default role to the user
        $defaultRole = Role::where('name', 'System-Driver')->first();
        if ($defaultRole) {
            $user->assignRole($defaultRole->name);
        }

        $existingDriver = Driver::where('email', $data['email'])->first();

        if ($existingDriver) {
            $existingDriver->update([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'contact' => $data['contact'],
            ]);
        } else {
            Driver::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'contact' => $data['contact'],
                'is_active' => 1,
                'is_deleted' => 0,
            ]);
        }

        return $user;
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            $exception = ValidationException::withMessages($errors->toArray())->errorBag('register');
            throw $exception;
        }

        $user = $this->create($request->all());

        // Automatically log in the user after registration 
        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect()->intended($this->redirectPath())->with('status', 'Registration successful!');
    }
}
