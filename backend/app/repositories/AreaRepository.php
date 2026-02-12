<?php

namespace App\Repositories;

use App\Models\Area;

class AreaRepository
{
    public function buscarYOrdenar($buscar = null, $orden = 'asc')
    {
        return Area::with('procedimientos')
            ->when($buscar, function ($consulta, $buscar) {
                return $consulta->where('nombre', 'LIKE', "%{$buscar}%");
            })
            ->orderBy('id', $orden)
            ->get();
    }

    public function crear(array $datos)
    {
        return Area::create($datos);
    }

    public function buscarPorId($id)
    {
        return Area::findOrFail($id);
    }

    public function actualizar(Area $area, array $datos)
    {
        $area->update($datos);
        return $area;
    }

    public function eliminar(Area $area)
    {
        $area->delete();
        return $area;
    }
}