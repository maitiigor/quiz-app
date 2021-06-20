<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('guest:admin',['except'=>['logout']]);
    }

    public function showLoginForm ()
    {
        return view('auth.admin-login');
    }

    public function login (Request $request)
    {
        // validate the form data

        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
        } catch (ValidationException $e) {
        }
        // attempt to login the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password])) {
            return redirect()->intended(route('admin.dashboard'));
        }
        // if unsuccesful return to previous page
        return redirect()->back()->with('warning','invalid Email or Password');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
    public function showRegisterForm(){
        return view('auth.admin-register');
    }
    public function register(Request $data){
        try {
            $this->validate($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } catch (ValidationException $e) {
        }

        Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])]);
        return view('admin');
}
}

