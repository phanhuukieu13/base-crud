<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function register()
    {

      return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $dataUser = new User();
        $dataUser->full_name = $request->full_name;
        $dataUser->address = $request->address;
        $dataUser->old = $request->old;
        $dataUser->phone_number = $request->phone_number;
        $dataUser->status = 0;
        $dataUser->is_deleted = 0;
        if($dataUser->save() ==true){
            $dataSave =   new LoginUser();
            $dataSave->user_id = $dataUser->id;
            $dataSave->email = $request->email;
            $dataSave->password = Hash::make($request->password);
            $dataSave->status = 0;
            $dataSave->is_deleted = 0;
            $dataSave->save();
        };
        return redirect('home');
    }
    public function login(){
        return view('auth.login');
    }
    public function authenticate(Request $request){
        $check = $request->only('email','password'); 
        if (Auth::attempt($check)) {
         return redirect()->intended('/admin/users');
         }
         return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }
    public function logout() {
        Auth::logout();
        return redirect('login');
      }
  
    public function home()
    {
    return view('home');
    }
}
