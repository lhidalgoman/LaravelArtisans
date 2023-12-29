<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Inscrito;
use App\Models\Persona;
use App\Models\Acto;
use Illuminate\Support\Facades\Redirect;

//Controller para las inscripciones de los eventos
class InscripcionesController extends Controller
{
    public function index()
    {
        // Lógica para mostrar la vista de inscripciones
        return view('inscripciones');
    }

    public function getAllInscritos()
    {
        // Obtener todos los inscritos
        $inscritos = Inscrito::all();
        // Pasar los datos a la vista
        return view('inscripciones', compact('inscritos'));
    }

    public function destroy($inscripcion)
    {
        // Buscar la inscripción por su ID
        $inscripcion = Inscrito::find($inscripcion);

        if ($inscripcion) {
            // Eliminar la inscripción
            $inscripcion->delete();
            return redirect()->back()->with('success', 'Inscripción eliminada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró la inscripción.');
        }
    }

    public function update(Request $request, $inscripcion)
    {
        // Buscar la inscripción por su ID
        $inscrito = Inscrito::find($inscripcion);

        if ($inscrito) {
            // Actualizar los datos de la inscripción con los valores proporcionados en el formulario
            $inscrito->Id_persona = $request->input('Id_persona');
            $inscrito->id_acto = $request->input('id_acto');
            $inscrito->Fecha_inscripcion = $request->input('Fecha_inscripcion');
            // Actualiza los demás campos de acuerdo a tus necesidades

            $inscrito->save();
            return redirect()->back()->with('success', 'Inscripción actualizada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró la inscripción.');
        }
    }

    public function create()
    {
        // Obtener todas las personas y actos para mostrar en el formulario de creación
        $personas = Persona::all();
        $actos = Acto::all();

        return view('nuevo', ['personas' => $personas, 'actos' => $actos]);
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada del formulario de inscripción
            $request->validate([
                'Id_persona' => 'required',
                'id_acto' => 'required',
                'Fecha_inscripcion' => 'required',
            ]);

            // Obtener los datos del formulario
            $idPersona = $request->input('Id_persona');
            $idActo = $request->input('id_acto');
            $fechaInscripcion = $request->input('Fecha_inscripcion');

            // Crear una nueva inscripción
            $inscripcion = new Inscrito();
            $inscripcion->Id_persona = $idPersona;
            $inscripcion->id_acto = $idActo;
            $inscripcion->Fecha_inscripcion = $fechaInscripcion;
            $inscripcion->save();

            // Redireccionar o realizar otras acciones según sea necesario
            return back()->with('success', 'Se ha suscrito exitosamente.');

        } catch (\Throwable $th) {
            // Manejo de errores en caso de que ocurra una excepción
            return back()->with('error', 'Error al guardar la inscripción: ' . $th->getMessage());
        }
    }
}