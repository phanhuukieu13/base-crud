<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function getEmail()
    {
        return view('auth.passwords.email');
    }
    // function generateRandomString($length = 10) {
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }
    public function postEmail(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $token = Str::random(30);
        $user = DB::table('login_user')->where([
            'email' => $request->email,
            'is_deleted' => 0,
        ])->first();
        if(!$user) {
            return redirect('auth.passwords.email');
        }else{
        
            $userID = LoginUser::find($user->id); 
            $userID->token = $token;
            $userID->token_create_at = Carbon::now();
            if ($userID->save()) {
                Mail::send('auth.verify', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Reset Password Notification');
                });
            }
        }
          return back()->with('message', 'We have e-mailed your password reset link!');
    }
}

