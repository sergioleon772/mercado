<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = request()->only('rut','password');
        if(!Auth::attempt($credentials)){
            return redirect()->to('/login')->withErrors('Login Failed');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request,$user);
    }

    public function authenticated(Request $request,$user){
        return redirect('/');
    }
}
