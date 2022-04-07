<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $remember_me = $request->has('remember_me') ? true : false; // use with remember me check box
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $remember_me)){
            $user = auth()->user();
            Auth::login($user);
            return redirect()->route('home');
        }else{
            return redirect()->back()->with('error','invalid email or password');
        }
    }
    public function logout() {
        Auth::logout();
        return redirect('login');
        }
       
}
