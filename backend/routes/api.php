<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\AuthController;

// RUTAS PÚBLICAS
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tramites', [TramiteController::class, 'index']); // Ahora es una ruta protegida
    Route::apiResource('tramites', TramiteController::class)->except(['index']);
    // ... otras rutas
});