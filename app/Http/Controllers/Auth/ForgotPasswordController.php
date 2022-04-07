<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Mail;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    // to view forgot password form
    public function getEmail(){
        return view('auth.passwords.email');
    }
    public function postEmail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(60); // to random token string
        // save data to password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
        // then we mail to specify email
        Mail::send('auth.verify',['token' => $token], function($message) use ($request) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to($request->email);
            $message->subject('Reset Password Notification');
         });
        return back()->with('status', 'We have e-mailed your password reset link!');
    }
}