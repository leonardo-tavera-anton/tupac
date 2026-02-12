<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AreaController;

Route::get('/usuario', function (Request $request) { //se encarga de la conexion
    return $request->user();
})->middleware('auth:sanctum');


// esto crea las rutas GET /areas, POST /areas, GET /areas/{id}, PUT /areas/{id}, DELETE /areas/{id}
Route::apiResource('areas', AreaController::class);