<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarioController; // Asegúrate de importar el controlador adecuado
use App\Http\Controllers\ActosController; // Asegúrate de importar el controlador adecuado
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\DocumentaionController;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Http\Controllers\InscripcionesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/inicio', [HomeController::class, 'index'])->middleware('auth')->name('inicio');

Route::get('/', 'HomeController@index')->middleware('auth')->name('index');

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');


Route::get('/calendario', [CalendarioController::class, 'index'])
    ->name('calendario.index');


Route::get('/actos/create', [ActosController::class, 'create'])->name('create');
Route::post('/api/actos', [ActosController::class, 'store'])->name('store');


Route::middleware('auth')->group(function () {
    Route::put('/api/actos/{id}', [ActosController::class, 'update'])->name('actos.update');
    Route::delete('/api/actos/{id}', [ActosController::class, 'destroy'])->name('actos.destroy');
});

Route::get('/api/actos', [ActosController::class, 'index'])->name('actos.index');
Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');

Route::get('/inscripciones', [InscripcionesController::class, 'index'])->name('inscripciones.index');
Route::get('/inscripciones', [InscripcionesController::class, 'getAllInscritos']);

Route::delete('/inscripciones/{inscripcion}', [InscripcionesController::class, 'destroy'])->name('inscripciones.destroy');
Route::put('/inscripciones/{inscripcion}', [InscripcionesController::class, 'update'])->name('inscripciones.update');

Route::get('/nuevoinscrito', [InscripcionesController::class, 'create'])->name('nuevoinscrito');
Route::post('/inscripciones', [InscripcionesController::class, 'store'])->name('inscripciones.store');


Route::middleware('guest')->group(function () {
    // Ruta principal para usuarios no autenticados
    Route::get('/', function () {
        // Esto hace que primero que veas al entrar sea el calendario
        return redirect('/api/actos');
    });
    // Esto permite a los usuarios no autenticados ver los detalles de cada evento
    Route::get('/api/actos/{id}', [ActosController::class, 'show'])->name('actos.show');
});
// Con esta ruta se permite a los usuarios conectados ver los detelles de cada evento
Route::get('/api/actos/{id}', [ActosController::class, 'show'])->name('actos.show');


// RUTAS PONENTE
Route::get('/ponente', [PonenteController::class, 'index'])->name('ponente.index');
Route::get('/ponente', [PonenteController::class, 'misActos'])->name('ponente.index');


// DOCUMENTACION
Route::get('/documentacion', [DocumentaionController::class, 'index'])->name('documentacion.index');
Route::post('/subir_documento', [DocumentaionController::class, 'subirDocumento'])->name('subir_documento');

// ************ASIGNACIONES DE ROLES**************** //
Route::get('/asignar-admin', function () {
    // IMPORTANTE: Añadir el mail de la persona que quieres hacer ADMIN y entras a la ruta superior //
    $user = User::where('email', 'prueba1@mail.com')->first();
    $adminRole = Role::where('name', 'admin')->first();
    $user->assignRole($adminRole);
    return 'Rol de administrador asignado al usuario';
});

Route::get('/asignar-ponente', function () {
    // IMPORTANTE: Añadir el mail de la persona que quieres hacer PONENTE y entras a la ruta superior //
    $user = User::where('email', 'prueba4@mail.com')->first();
    $ponenteRole  = Role::where('name', 'ponente')->first();
    $user->assignRole($ponenteRole);
    return 'Rol de ponente asignado al usuario prueba4@mail.com';
});

Route::get('/asignar-user', function () {
    // IMPORTANTE: Añadir el mail de la persona que quieres hacer USER y entras a la ruta superior //
    $user = User::where('email', 'prueba0@mail.com')->first();
    $userRole  = Role::where('name', 'user')->first();
    $user->assignRole($userRole);
    return 'Rol de user asignado al usuario';
});

Route::get('/phpinfo', function() {
    phpinfo();
});