<?php
// app/Http/Controllers/DocumentaionController.php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Documentacion;
use App\Models\Acto;
use Auth;

class DocumentaionController extends Controller
{
    // Método para mostrar la vista de la documentación de eventos pasados
    public function index()
    {
        // Obtener eventos pasados
        $actosPasados = Acto::where('Fecha', '<', now())->get();

        return view('documentacion', compact('actosPasados'));
    }

    // Método para subir un documento relacionado con un evento pasado
    public function subirDocumento(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'documento' => 'required|mimes:pdf,doc,docx', // Asegúrate de validar los tipos de archivos permitidos
            'localizacion' => 'required|in:Sala A,Sala B,Sala C', // Asegúrate de validar la localización
        ]);

        // Obtener el nombre original del archivo
        $nombreOriginal = $request->file('documento')->getClientOriginalName();

        // Guardar el documento en la nueva ruta (por ejemplo, storage/app/public/documentos)
        $rutaDocumento = $request->file('documento')->storeAs('public/documentos', $nombreOriginal);

        // Validar otros campos del formulario
        $request->validate([
            'id_acto' => 'required|integer',
            'orden' => 'required|integer', // Asegúrate de que el orden sea un entero
        ]);

        // Obtener los datos del formulario
        $idActo = $request->input('id_acto');
        $orden = $request->input('orden');
        $localizacion = $request->input('localizacion');

        // Crear una nueva entrada en la tabla de Documentacion
        Documentacion::create([
            'Id_acto' => $idActo,
            'Localizacion_documentacion' => $localizacion, // Guardar la localización seleccionada
            'Orden' => $orden,
            'Id_persona' => Auth::id(), // Obtener el ID del usuario autenticado
            'Titulo_documento' => $nombreOriginal,
        ]);

        return redirect()->back()->with('success', 'Documento subido exitosamente.');
    }
}