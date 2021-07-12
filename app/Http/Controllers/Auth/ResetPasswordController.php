<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function getPassword($token) { 

        return view('auth.passwords.reset', ['token' => $token]);
     }
     public function updatePassword(Request $request)
     {
   
     $request->validate([
         'email' => 'required|email',
         'password' => 'required|string|min:6|confirmed',
         'password_confirmation' => 'required',
   
     ]);
     
     $updatePassword = DB::table('login_user') ->where([
        'email' => $request->email,
        'token' => $request->token,
        'is_deleted'=> 0,
        ])->first();
     if(!$updatePassword)
         return back()->withInput()->with('error', 'Invalid token!');
   
       $user =  DB::table('login_user')->where('email', $request->email)
                   ->update(['password' => Hash::make($request->password)]);
       return redirect('/login')->with('message', 'Your password has been changed!');
   
     }
}
