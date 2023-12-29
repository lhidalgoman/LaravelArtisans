<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Obtiene la ruta a la que el usuario debe ser redirigido cuando no está autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Comprueba si la solicitud no espera una respuesta JSON
        if (! $request->expectsJson()) {
            // Si no se espera una respuesta JSON, redirige al usuario a la ruta de inicio de sesión ('login')
            return route('login');
        }
    }
}