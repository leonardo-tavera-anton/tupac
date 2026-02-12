<?php

namespace App\Services;

use App\Repositories\AreaRepository;

class AreaService
{
    protected $repositorio;

    public function __construct(AreaRepository $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function listarAreas($buscar = null, $orden = 'asc')
    {
        return $this->repositorio->buscarYOrdenar($buscar, $orden);
    }

    public function registrarArea(array $datos)
    {
        return $this->repositorio->crear($datos);
    }
}