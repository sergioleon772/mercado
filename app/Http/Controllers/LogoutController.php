<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout(){
        // Limpiar la sesión
        Session::flush(); 

        // Cerrar sesión del proveedor si está autenticado
        if (Auth::guard('proveedor')->check()) {
            Auth::guard('proveedor')->logout();
        }

        // Cerrar sesión del usuario normal si está autenticado
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->to('/');
    }
}
