<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Acto;
use App\Models\Persona;
use App\Models\Inscrito;

// Clase controller de los actos de la app
class ActosController extends Controller
{
    /**
     * Muestra la vista de todos los actos.
     *
     * @return \Illuminate\View\View Vista que muestra la lista de actos.
     */
    public function index()
    {
        // Obtener datos de la base de datos a través del modelo
        $actos = Acto::all();

        // Pasar la lista de actos a la vista
        return view('calendario.index', ['actos' => $actos]);
    }

    /**
     * Obtiene todos los actos y los devuelve en formato JSON - API.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con todos los actos.
     * Esta petición se utilizará en el producto 5 para recuperar todos los actos
     * y mostrarlos en la app de Wordpress
     */
    public function getActos()
    {
        $actos = Acto::all();
        return response()->json($actos);
    }

    /**
     * Obtiene un acto por su ID y lo devuelve en formato JSON - API.
     *
     * @param int $id El ID del acto que se desea obtener.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el acto o un mensaje de error si no se encuentra.
     */
    public function getActoId($id)
    {
        $acto = Acto::find($id);

        if ($acto) {
            return response()->json($acto);
        } else {
            return response()->json(['error' => 'No se encontró el acto'], 404);
        }
    }

    /**
     * Muestra la vista de un acto específico.
     *
     * @param int $id El ID del acto que se desea mostrar.
     * @return \Illuminate\View\View Vista que muestra los detalles del acto.
     */
    public function show($id)
    {
        // Obtener el acto de la base de datos a través del modelo
        $acto = Acto::find($id);

        if ($acto) {
            return view('acto', ['acto' => $acto]);
        } else {
            return redirect('/api/actos')->with('error', 'No se encontró el acto');
        }
    }

    /**
     * Obtiene todos los usuarios con el rol 'ponente'.
     *
     * @return \Illuminate\Database\Eloquent\Collection Colección de usuarios con el rol 'ponente'.
     */
    public function obtenerPonentes()
    {
        // Obtener todos los usuarios con el rol 'ponente'
        $ponentes = User::role('ponente')->get();
        return $ponentes;
    }

    /**
     * Muestra el formulario para crear un nuevo acto.
     *
     * @return \Illuminate\View\View Vista del formulario de creación de actos.
     */
    public function create()
    {
        // Obtener datos de personas, actos y ponentes de la base de datos
        $personas = Persona::all();
        $actos = Acto::all();

        // Obtener ponentes
        $ponentes = $this->obtenerPonentes();

        return view('create', ['personas' => $personas, 'actos' => $actos, 'ponentes' => $ponentes]);
    }

    /**
     * Almacena un nuevo acto en la base de datos.
     *
     * @param \Illuminate\Http\Request $request Los datos de la solicitud HTTP.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de actos con un mensaje de éxito.
     */
    public function store(Request $request)
    {
        // Guardar información en la base de datos
        $acto = new Acto($request->all());
        $acto->save();

        return redirect('/api/actos')->with('success', 'Acto creado correctamente');
    }

    /**
     * Actualiza los detalles de un acto existente.
     *
     * @param \Illuminate\Http\Request $request Los datos de la solicitud HTTP.
     * @param int $id El ID del acto que se desea actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página anterior con un mensaje de éxito o error.
     */
    public function update(Request $request, $id)
    {
        // Obtener el acto de la base de datos
        $acto = Acto::find($id);

        if ($acto) {
            // Actualizar los datos del acto
            $acto->update($request->all());
            return redirect()->back()->with('success', 'Acto actualizado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el acto');
        }
    }

    /**
     * Elimina un acto existente de la base de datos.
     *
     * @param int $id El ID del acto que se desea eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de actos con un mensaje de éxito o error.
     */
    public function destroy($id)
    {
        // Obtener el acto de la base de datos
        $acto = Acto::find($id);

        if ($acto) {
            // Eliminar el acto
            $acto->delete();
            return redirect('/api/actos')->with('success', 'Acto eliminado correctamente');
        } else {
            return redirect('/api/actos')->with('error', 'Error al eliminar el acto');
        }
    }

    /**
     * Muestra datos específicos del usuario actualmente autenticado.
     *
     * @return \Illuminate\View\View Vista que muestra los datos del usuario.
     */
    public function datos()
    {
        $user = Auth::user();
        return view('acto', compact('user'));
    }

    /**
     * Comprueba si un usuario está inscrito en un acto específico y calcula las plazas disponibles.
     *
     * @param int $id_acto El ID del acto que se desea comprobar.
     * @return array Un arreglo con información de inscripción y plazas disponibles.
     */
    public function comprobar($id_acto)
    {
        // Obtener el usuario actualmente autenticado
        $usuario = Auth::user();

        // Verificar si el usuario está inscrito en este evento
        $inscripcion = Inscrito::where('Id_persona', $usuario->id)
            ->where('id_acto', $id_acto)
            ->first();

        // Obtener los detalles del acto
        $acto = Acto::find($id_acto);
        // Calcular el número de plazas disponibles
        $plazasDisponibles = $acto ? $acto->Num_asistentes - Inscrito::where('id_acto', $id_acto)->count() : 0;
        // Pasar la información a la vista
        return [$inscripcion, $plazasDisponibles];
    }

    /**
     * Obtiene el rol del usuario actualmente autenticado.
     *
     * @return \Illuminate\Support\Collection Colección que contiene los roles del usuario.
     */
    public function userRol()
    {
        // Obtener el usuario actualmente autenticado
        $user = Auth::user();
        // Obtener role del usuario
        $roles = $user->getRoleNames();
        return $roles;
    }
}