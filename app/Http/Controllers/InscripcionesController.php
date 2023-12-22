<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscrito;
use App\Models\Persona;
use App\Models\Acto;
class InscripcionesController extends Controller
{
    public function index()
    {
        // Lógica para mostrar las inscripciones
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
        $inscripcion = Inscrito::find($inscripcion);

        if ($inscripcion) {
            $inscripcion->delete();
            return redirect()->back()->with('success', 'Inscripción eliminada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró la inscripción.');
        }
    }

    public function update(Request $request, $inscripcion)
    {
        $inscrito = Inscrito::find($inscripcion);

        if ($inscrito) {
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
        $personas = Persona::all();
        $actos = Acto::all();

        return view('nuevo', ['personas' => $personas, 'actos' => $actos]);
    }
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'Id_persona' => 'required',
                'id_acto' => 'required',
                'Fecha_inscripcion' => 'required',
            ]);

            // Obtener los datos del formulario
            $idPersona = $request->input('Id_persona');
            $idActo = $request->input('id_acto');
            $fechaInscripcion = $request->input('Fecha_inscripcion');

            // Crear la nueva inscripción
            $inscripcion = new Inscrito();
            $inscripcion->Id_persona = $idPersona;
            $inscripcion->id_acto = $idActo;
            $inscripcion->Fecha_inscripcion = $fechaInscripcion;
            $inscripcion->save();

            // Redireccionar o realizar otras acciones según sea necesario

        } catch (\Throwable $th) {
            // Manejo de errores
            return back()->with('error', 'Error al guardar la inscripción: ' . $th->getMessage());
        }
    }
}
