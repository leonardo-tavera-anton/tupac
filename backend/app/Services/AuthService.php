<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(array $data)
    {
        $user = $this->repository->create($data);
        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }

    public function login(string $dni, string $password)
    {
        $user = $this->repository->findByDni($dni);

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages(['dni' => 'Credenciales incorrectas']);
        }

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }
}