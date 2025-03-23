<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout(){
        Session::flush();   //flush: actualiza el flujo, libera todo
        
        Auth::logout();

        return redirect()->to('/');
    }
}
