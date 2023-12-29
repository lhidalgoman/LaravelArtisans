<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Clase Middleware para prevenir solicitudes durante el modo de mantenimiento.
     *
     * Este middleware permite especificar las URIs que deben seguir siendo accesibles
     * mientras el modo de mantenimiento está habilitado en una aplicación Laravel.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}