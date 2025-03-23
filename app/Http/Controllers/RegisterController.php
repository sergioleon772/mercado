<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.registrarse');
    }

    public function register(RegisterRequest $request){
        $user = User::create($request -> validated());

        return redirect('/login')->with('success','Account created successfully');
    }
}
