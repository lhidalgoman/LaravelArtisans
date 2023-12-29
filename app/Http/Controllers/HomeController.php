<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//Controller para el home de la app
class HomeController extends Controller
{
    /**
     * Crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        // Este constructor asegura que solo los usuarios autenticados puedan acceder a las acciones del controlador.
        $this->middleware('auth');
    }

    /**
     * Muestra el panel de control de la aplicación.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // El método 'index' se utiliza para mostrar la vista principal de la aplicación.
        // Verifica si el usuario está autenticado utilizando 'Auth::check()'.
        if (Auth::check()) {
            // Si el usuario está autenticado, muestra la vista 'home'. 
            // Reemplaza 'home' con el nombre de tu vista principal si es diferente.
            return view('home');
        } else {
            // Si el usuario no está autenticado, redirige al usuario a la página de inicio de sesión.
            return redirect()->route('login'); // Reemplaza 'login' con el nombre de tu ruta de inicio de sesión si es diferente.
        }
    }

}