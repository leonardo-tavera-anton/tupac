<?php

namespace App\Repositories;

use App\Models\Tramite;

class TramiteRepository {
    public function listar($buscar = null, $orden = 'asc') {
        return Tramite::when($buscar, function ($q, $buscar) {
                return $q->where('nombre_tramite', 'LIKE', "%{$buscar}%")
                         ->orWhere('codigo_tupa', 'LIKE', "%{$buscar}%");
            })
            ->orderBy('id_tramite', $orden)
            ->get();
    }

    public function crear(array $datos) { return Tramite::create($datos); }
    public function buscarPorId($id) { return Tramite::findOrFail($id); }
    public function actualizar($id, array $datos) {
        $proc = $this->buscarPorId($id);
        $proc->update($datos);
        return $proc;
    }
    public function eliminar($id) { return $this->buscarPorId($id)->delete(); }
}