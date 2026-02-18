<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\AuthController;

// RUTAS PÚBLICAS
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tramites', [TramiteController::class, 'index']); // Acceso para el TUPA público

// RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tramites', TramiteController::class)->except(['index']);
    // ... otras rutas
});