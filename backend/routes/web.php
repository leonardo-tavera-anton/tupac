<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// --- RUTA DE INICIO ---
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// --- RUTAS DE REGISTRO ---
Route::get('/registro', function () {
    return view('auth.registro'); 
})->name('registro.view');

// Procesa el registro con el AuthController
Route::post('/registro', [AuthController::class, 'store'])->name('registro.store');

// --- RUTAS DE LOGIN ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesa el login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// --- RUTAS PROTEGIDAS solo para usuarios logeados ---
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});