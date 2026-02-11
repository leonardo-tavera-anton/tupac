<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

// --------------------------------------------------
// ▷ Rutas públicas (sin autenticación)
// --------------------------------------------------
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'can_register' => Features::enabled(Features::registration()),
    ]);
})->name('home');

// ------------------------
// ▷ Rutas de autenticación
// (Laravel Fortify genera las rutas de login, register, etc.)
// ------------------------

// (Opcional si quieres agregar rutas extra de autenticación en otro archivo)
require __DIR__.'/auth.php';

// --------------------------------------------------
// ▷ Rutas protegidas (requieren usuario autenticado)
// --------------------------------------------------
Route::middleware(['auth', 'verified'])
    ->group(function () {

        // ▷ Dashboard
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        // ▷ Perfil de Usuario
        Route::get('/profile', function () {
            return Inertia::render('Profile/Index');
        })->name('profile');

        // ▷ Otras rutas dentro de este grupo
        // Route::get('/settings', ...)->name('settings');
});

// --------------------------------------------------
// ▷ Rutas adicionales
// (Separamos routes/settings.php para organización)
// --------------------------------------------------
require __DIR__.'/settings.php';
