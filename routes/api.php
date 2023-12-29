<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventosController;
use App\Http\Controllers\ActosController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para Actos
Route::get('/actos', [ActosController::class, 'index']);
Route::get('/actos/{id}', [ActosController::class, 'show']);
Route::post('/actos', [ActosController::class, 'store']);
Route::put('/actos/{id}', [ActosController::class, 'update']);
Route::delete('/actos/{id}', [ActosController::class, 'destroy']);
Route::get('/all/actos', [ActosController::class, 'getActos']);
Route::get('/all/actos/{id}', [ActosController::class, 'getActoId']);