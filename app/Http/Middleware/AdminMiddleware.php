<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Si no está autenticado, redirige al login
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder.');
        }

        if (!Auth::user()->is_admin) {
            // Si no es admin, redirige al inicio con un mensaje de error
            return redirect('/')->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
