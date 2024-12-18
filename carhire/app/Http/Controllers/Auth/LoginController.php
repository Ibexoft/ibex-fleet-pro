<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'is_deleted' => 0,
            'is_active' => 1,
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        $exception = ValidationException::withMessages($errors)->errorBag('login');
        
        // Set additional errors
        $exception->validator->errors()->add('is_active', trans('auth.is_active'));
        $exception->validator->errors()->add('is_deleted', trans('auth.is_deleted'));
        
        throw $exception;
    }

    public function logout(Request $request){
        if (Auth::user()->hasRole('System-Driver')) {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('/home');
        } else {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('/login');
        }
    }


}
