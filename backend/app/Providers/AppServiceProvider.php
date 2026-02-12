<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AreaService;
use App\Repositories\AreaRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registramos el Servicio y le pasamos el Repositorio
        $this->app->bind(AreaService::class, function ($app) {
            return new AreaService($app->make(AreaRepository::class));
        });
    }

    public function boot(): void
    {
        //
    }
}