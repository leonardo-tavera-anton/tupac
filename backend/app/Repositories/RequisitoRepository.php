<?php

namespace App\Repositories;

use App\Models\Requisito;

class RequisitoRepository
{
    /**
     * Obtener todos los requisitos.
     */
    public function getAll()
    {
        return Requisito::all();
    }

    /**
     * Buscar por ID.
     */
    public function findById($id)
    {
        return Requisito::findOrFail($id);
    }

    /**
     * Guardar un nuevo registro.
     */
    public function create(array $data)
    {
        return Requisito::create($data);
    }

    /**
     * Actualizar registro.
     */
    public function update($id, array $data)
    {
        $requisito = $this->findById($id);
        $requisito->update($data);
        return $requisito;
    }

    /**
     * Eliminar registro.
     */
    public function delete($id)
    {
        $requisito = $this->findById($id);
        return $requisito->delete();
    }
}