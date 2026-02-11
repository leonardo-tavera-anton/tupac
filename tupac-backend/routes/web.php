<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

// Página de bienvenida más visual
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Dashboard con estilo
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Otras rutas (organizadas)
require __DIR__.'/settings.php';
