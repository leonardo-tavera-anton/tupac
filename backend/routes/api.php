<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importación de Controladores
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\RequisitoController;

/*
|--------------------------------------------------------------------------
| API Routes - Sistema TUPAC
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS ---
// Estas rutas no requieren token (Para ciudadanos no registrados y login)
Route::post('/registro', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

// Buscador público para ciudadanos (puedes habilitarlos sin estar logeado si prefieres)
Route::get('/areas/search', [AreaController::class, 'search']);
Route::get('/tramites/search', [TramiteController::class, 'search']);


// --- RUTAS PROTEGIDAS (Sanctum) ---
// Angular debe enviar el Header: Authorization: Bearer {token}
Route::middleware('auth:sanctum')->group(function () {
    
    // Perfil del usuario autenticado
    Route::get('/usuario', function (Request $request) {
        return $request->user();
    });

    // Cerrar sesión (Revoca el token)
    Route::post('/logout', [AuthController::class, 'logout']);

    // Mantenimiento del Sistema TUPAC
    // Estas rutas permiten el CRUD completo para áreas, trámites y requisitos
    Route::apiResource('areas', AreaController::class);
    Route::apiResource('tramites', TramiteController::class);
    Route::apiResource('requisitos', RequisitoController::class);

});