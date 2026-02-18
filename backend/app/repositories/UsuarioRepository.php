<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function create(array $data)
    {
        return Usuario::create($data);
    }

    public function findByDni(string $dni)
    {
        return Usuario::where('dni', $dni)->first();
    }
}