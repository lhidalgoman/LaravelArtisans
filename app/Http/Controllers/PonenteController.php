<?php

// app/Http/Controllers/PonenteController.php

namespace App\Http\Controllers;

use App\Models\Inscrito;
use Auth;

//Controller para los ponentes de la app
class PonenteController extends Controller
{
    /**
     * Muestra la vista principal de los ponentes.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('ponente');
    }
    /**
     * Muestra los actos en los que el usuario conectado es ponente.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function misActos()
    {
        // Obtener el ID del usuario conectado
        $userId = Auth::id();
        // Obtener todas las inscripciones del usuario conectado con la relación de acto cargada
        $inscripciones = Inscrito::with('acto')->where('Id_persona', $userId)->get();
        // Obtener los actos en los que el usuario conectado es ponente
        $actosComoPonente = Auth::user()->actosComoPonente;
        // Pasar los datos a la vista por separado
        return view('ponente', compact('inscripciones', 'actosComoPonente'));
    }
}
