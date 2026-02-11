<?php

namespace App\Services;

use App\Repositories\AreaRepository;

class AreaService
{
    protected $repository;

    public function __construct(AreaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listarAreas()
    {
        return $this->repository->all();
    }

    public function registrarArea(array $data)
    {
        // Aquí podrías validar si el nombre ya existe o formatear el texto
        return $this->repository->create($data);
    }
}