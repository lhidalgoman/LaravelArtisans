<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Acto;
use Illuminate\Http\Request;

// Controlador para la vista de calendario
class CalendarioController extends Controller
{
    /**
     * Muestra la vista principal del calendario.
     *
     * @return \Illuminate\View\View Vista principal del calendario.
     */
    public function index()
    {
        // Devuelve la vista 'calendario.index'
        return view('calendario.index');
    }
}

