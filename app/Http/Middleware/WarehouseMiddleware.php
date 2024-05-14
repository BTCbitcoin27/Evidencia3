<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WarehouseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario tiene el rol de ventas
        if ($request->user() && $request->user()->role->name === 'warehouse') {
            return $next($request);
        }

        // Redirigir o responder con un error
        return redirect('/')->with('error', 'No tienes permiso para acceder a esta función.');
    }
}
