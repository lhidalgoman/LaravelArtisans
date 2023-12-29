<?php
//Este codigo se hizo de manera inicial para realizar pruebas de la api
//pero realmente donde se aloja la api de eventos es en el ActosController.php
// app/Http/Controllers/Api/EventosController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Acto;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function index()
    {
        $actos = Acto::all();
        return response()->json(['actos' => $actos]);
    }
}
