<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Maneja una petición entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario está logueado y su rol_id es 1 (Administrador)
        if (Auth::check() && Auth::user()->rol_id === 1) {
            return $next($request);
        }

        // Si no es admin, lo rebota a la raíz con un mensaje de error
        return redirect('/')->with('error', 'No tenés permisos para acceder a la sección de administración.');
    }
}
