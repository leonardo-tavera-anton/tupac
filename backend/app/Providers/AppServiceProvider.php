<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Importamos los Servicios
use App\Services\AreaService;
use App\Services\ProcedimientoService;
// Importamos los Repositorios
use App\Repositories\AreaRepository;
use App\Repositories\ProcedimientoRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registro para el módulo de Áreas
        $this->app->bind(AreaService::class, function ($app) {
            return new AreaService($app->make(AreaRepository::class));
        });

        // Registro para el módulo de Procedimientos
        $this->app->bind(ProcedimientoService::class, function ($app) {
            return new ProcedimientoService($app->make(ProcedimientoRepository::class));
        });
    }

    public function boot(): void
    {
        //
    }
}