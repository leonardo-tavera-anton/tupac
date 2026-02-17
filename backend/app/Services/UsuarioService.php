<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Auth;

class UsuarioService
{
    protected $repo;

    public function __construct(UsuarioRepository $repo)
    {
        $this->repo = $repo;
    }

    public function crearCuenta(array $data)
    {
        return $this->repo->registrar([
            'nombre'   => $data['nombre'],
            'apellido' => $data['apellido'],
            'correo'   => $data['correo'],
            'password' => $data['password'], // El modelo se encarga del Hash
        ]);
    }

    public function autenticar(array $credenciales)
    {
        return Auth::attempt([
            'correo' => $credenciales['correo'],
            'password' => $credenciales['password']
        ]);
    }
}