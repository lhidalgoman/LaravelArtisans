<?php
namespace App\Http\Controllers;
use App\Models\Acto;
use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
class ActosController extends Controller
{
    public function index()
    {
        $actos = Acto::all();
        return view('calendario.index', ['actos' => $actos]);
    }

    public function show($id)
    {
        // Obtener el acto con el ID proporcionado y realizar alguna lógica
        $acto = Acto::where('Id_acto', $id)->first();
        // Retornar la vista "acto" con los detalles del acto
        return view('acto', ['acto' => $acto]);
    }
    public function create()
    {
        $personas = Persona::all();
        $actos = Acto::all();

        return view('create', ['personas' => $personas, 'actos' => $actos]);
    }
    public function store(Request $request)
    {
        $acto = new Acto($request->all());
        $acto->save();

        return redirect()->back()->with('success', 'Acto creado correctamente');
    }

    // FUNCIONAL
    // public function show($id)
    // {
    //     // Obtener el acto con el ID proporcionado y realizar alguna lógica
    //     $acto = Acto::where('Id_acto', $id)->first();

    //     // Retornar los detalles del acto en formato JSON
    //     return response()->json($acto);
    // }
    public function update(Request $request, $id)
    {
        $acto = Acto::where('Id_acto', $id)->first();

        $acto->fill($request->all());
        $acto->save();

        return redirect()->back()->with('success', 'Acto actualizado correctamente');
    }

    public function destroy($id)
    {
        $acto = Acto::find($id);

        if ($acto) {
            // Eliminar las filas relacionadas en la tabla lista_ponentes
            \DB::table('lista_ponentes')->where('Id_acto', $id)->delete();

            // Eliminar el acto
            $acto->delete();

            return redirect('/actos')->with('success', 'Acto eliminado correctamente');
        } else {
            return redirect('/actos')->with('error', 'No se encontró el acto');
        }
    }

}
