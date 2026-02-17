<?php

namespace App\Services;

use App\Repositories\TramiteRepository;

class TramiteService {
    protected $repo;
    public function __construct(TramiteRepository $repo) { $this->repo = $repo; }

    public function todos($buscar, $orden) { return $this->repo->listar($buscar, $orden); }
    public function registrar($datos) { return $this->repo->crear($datos); }
    public function obtener($id) { return $this->repo->buscarPorId($id); }
    public function editar($id, $datos) { return $this->repo->actualizar($id, $datos); }
    public function borrar($id) { return $this->repo->eliminar($id); }
}