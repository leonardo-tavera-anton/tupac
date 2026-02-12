<?php

namespace App\Repositories;

use App\Models\Procedimiento;

class ProcedimientoRepository {
    public function listar($buscar = null, $orden = 'asc') {
        return Procedimiento::when($buscar, function ($q, $buscar) {
                return $q->where('nombre_tramite', 'LIKE', "%{$buscar}%")
                         ->orWhere('codigo_tupa', 'LIKE', "%{$buscar}%");
            })
            ->orderBy('id_tramite', $orden)
            ->get();
    }

    public function crear(array $datos) { return Procedimiento::create($datos); }
    public function buscarPorId($id) { return Procedimiento::findOrFail($id); }
    public function actualizar($id, array $datos) {
        $proc = $this->buscarPorId($id);
        $proc->update($datos);
        return $proc;
    }
    public function eliminar($id) { return $this->buscarPorId($id)->delete(); }
}