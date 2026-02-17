<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function registrar(array $data)
    {
        return Usuario::create($data);
    }

    public function buscarPorCorreo(string $correo)
    {
        return Usuario::where('correo', $correo)->first();
    }
}