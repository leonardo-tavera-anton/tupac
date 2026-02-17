<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    /**
     * Registrar un nuevo usuario con contraseña cifrada.
     */
    public function registrar(array $data)
    {
        $data['contrasena'] = Hash::make($data['contrasena']);
        
        return Usuario::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'correo' => $data['correo'],
            'password' => $data['contrasena'], // Mapeo al campo de autenticación
        ]);
    }

    /**
     * Buscar usuario por correo.
     */
    public function buscarPorCorreo(string $correo)
    {
        return Usuario::where('correo', $correo)->first();
    }

    /**
     * Actualizar datos del usuario.
     */
    public function actualizar($id, array $data)
    {
        $usuario = Usuario::findOrFail($id);
        
        if (isset($data['contrasena'])) {
            $data['password'] = Hash::make($data['contrasena']);
        }

        $usuario->update($data);
        return $usuario;
    }
}