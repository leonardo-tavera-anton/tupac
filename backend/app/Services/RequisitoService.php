<?php

namespace App\Services;

use App\Models\Requisito;

class RequisitoRepository
{
    /**
     * Obtener todos los requisitos con su cálculo de costo.
     */
    public function getAll()
    {
        return Requisito::all()->map(function ($requisito) {
            $requisito->costo_calculado = $this->calculateCosto($requisito);
            return $requisito;
        });
    }

    /**
     * Crear un nuevo requisito.
     */
    public function create(array $data)
    {
        return Requisito::create($data);
    }

    /**
     * Calcular el costo: (Monto * Factor)
     * Por ejemplo: 0.05 * 5150 (UIT)
     */
    public function calculateCosto(Requisito $requisito)
    {
        return $requisito->monto * $requisito->factor;
    }

    /**
     * Actualizar requisito.
     */
    public function update($id, array $data)
    {
        $requisito = Requisito::findOrFail($id);
        $requisito->update($data);
        return $requisito;
    }
}