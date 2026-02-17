<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // manejo para conexion con front puede ser esto o el cors
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'api/*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
            // Fuerza a Laravel a responder con JSON si la ruta es de la API
            $exceptions->shouldRenderJsonWhen(function ($request, $e) {
                if ($request->is('api/*')) {
                    return true;
                }
                return $request->expectsJson();
            });
    })->create();