<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function all()
    {
        return Usuario::with('procedimientos')->get();
    }

    public function create(array $data)
    {
        return Usuario::create($data);
    }

    public function find($id)
    {
        return Usuario::findOrFail($id);
    }
}