<?php

// app/Http/Controllers/CalendarioController.php

namespace App\Http\Controllers;
use App\Models\Persona;
use App\Models\Acto;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function index()
    {
        // Aquí puedes agregar la lógica para mostrar el calendario
        return view('calendario.index');
    }
}
