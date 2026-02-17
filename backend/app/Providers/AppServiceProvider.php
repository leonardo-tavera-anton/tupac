<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Importamos los Servicios
use App\Services\AreaService;
use App\Services\TramiteService;
// Importamos los Repositorios
use App\Repositories\AreaRepository;
use App\Repositories\TramiteRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registro para el módulo de Áreas
        $this->app->bind(AreaService::class, function ($app) {
            return new AreaService($app->make(AreaRepository::class));
        });

        // Registro para el módulo de Procedimientos
        $this->app->bind(TramiteService::class, function ($app) {
            return new TramiteService($app->make(TramiteRepository::class));
        });
    }

    public function boot(): void
    {
        //
    }
}