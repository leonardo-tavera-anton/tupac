<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validamos solo lo que pides
        $fields = $request->validate([
            'nombre'   => 'required|string|max:255',
            'correo'   => 'required|string|email|unique:usuarios,correo',
            'password' => 'required|string|min:6'
        ]);

        $user = Usuario::create([
            'nombre'   => $fields['nombre'],
            'correo'   => $fields['correo'],
            'password' => $fields['password'], 
            'apellido' => '', // Lo enviamos vacío para que no de error la DB
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'nombre'   => 'required|string',
            'password' => 'required|string'
        ]);

        $user = Usuario::where('nombre', $fields['nombre'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Credenciales incorrectas'], 401);
        }

        return response([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 200);
    }
}