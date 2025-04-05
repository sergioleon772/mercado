<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected function redirectTo()
    {
        // Si el usuario es administrador, redirige a /admin
        if (Auth::check() && Auth::user()->is_admin) {
            return '/admin';  // Página de administración
        }

        // Si no es admin, redirige a la página principal
        return '/';
    }

    public function show()
    {
        if (Auth::check()) {
            // Si ya está logueado, redirige según el rol
            return redirect(auth()->user()->is_admin ? '/admin' : '/');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('rut', 'password');
        if (!Auth::attempt($credentials)) {
            return redirect()->to('/login')->withErrors('Login Failed');
        }

        // Redirige después del login
        return $this->authenticated($request, Auth::user());
    }

    public function authenticated(Request $request, $user)
    {
        // Redirige a la página correspondiente después de la autenticación
        return redirect($this->redirectTo());
    }
}
