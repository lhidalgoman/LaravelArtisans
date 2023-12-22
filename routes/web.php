<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarioController; // Asegúrate de importar el controlador adecuado
use App\Http\Controllers\ActosController; // Asegúrate de importar el controlador adecuado
use App\Http\Controllers\PerfilController;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Http\Controllers\InscripcionesController;

Route::get('/inicio', [HomeController::class, 'index'])->middleware('auth')->name('inicio');

Route::get('/', 'HomeController@index')->middleware('auth')->name('index');

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');


Route::get('/calendario', [CalendarioController::class, 'index'])
    ->middleware('auth')
    ->name('calendario.index');


Route::get('/actos/create', [ActosController::class, 'create'])->name('create');
Route::post('/actos', [ActosController::class, 'store'])->name('store');


Route::middleware('auth')->group(function () {
    Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
    Route::get('/actos', [ActosController::class, 'index'])->name('actos.index');
    Route::get('/actos/{id}', [ActosController::class, 'show'])->name('actos.show');
    Route::put('/actos/{id}', [ActosController::class, 'update'])->name('actos.update');
    Route::delete('/actos/{id}', [ActosController::class, 'destroy'])->name('actos.destroy');
});

Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');




Route::get('/asignar-admin', function () {
    // IMPORTANTE: Añadir el mail de la persona que quieres hacer admin y entras a la ruta superior //
    $user = User::where('email', 'luli_vk7@hotmail.com')->first();
    $adminRole = Role::where('name', 'admin')->first();

    $user->assignRole($adminRole);

    return 'Rol de administrador asignado al usuario';
});

// Route::group(['middleware' => ['role:admin']], function () {
//     Route::get('/admin', function () {})->middleware('role:admin');
// });


Route::get('/inscripciones', [InscripcionesController::class, 'index'])->name('inscripciones.index');
Route::get('/inscripciones', [InscripcionesController::class, 'getAllInscritos']);

Route::delete('/inscripciones/{inscripcion}', [InscripcionesController::class, 'destroy'])->name('inscripciones.destroy');
Route::put('/inscripciones/{inscripcion}', [InscripcionesController::class, 'update'])->name('inscripciones.update');

Route::get('/nuevoinscrito', [InscripcionesController::class, 'create'])->name('nuevoinscrito');
Route::post('/inscripciones', [InscripcionesController::class, 'store'])->name('inscripciones.store');
