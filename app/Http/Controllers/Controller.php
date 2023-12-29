<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Clase base para todos los controladores en la aplicación
class Controller extends BaseController
{
    // Incluye los rasgos para autorización, despacho de trabajos y validación
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
