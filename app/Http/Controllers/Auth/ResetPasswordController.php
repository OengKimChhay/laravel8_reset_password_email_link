<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Hash;

class ResetPasswordController extends Controller{
    public function getPassword($token){
        return view('auth.passwords.reset',['token' => $token]);
    }
    public function updatePassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users', //exists:users មានន័យថាបើ email នេះគ្មាននៅក្នុងតារាងusers​​ ទេ
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        $checkToken = DB::table('password_resets')->where('email',$request->email)
                                                  ->where('token',$request->token)->first();
        //check if inlavid token string
        //check if user input wrong their own email
        if(!$checkToken){
            return back()->with('InvalidEmail','The selected email is invalid.');
        }
        // if valid token string we update password in user table
        User::where('email',$request->email)->update([
            'password' => Hash::make($request->password)
        ]);
        // then we delete token string form database
        DB::table('password_resets')->where('email',$request->email)->delete();
        return redirect('/login')->with('status', 'Your password has been changed!');
    }
}
