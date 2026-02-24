<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validamos que vengan los 4 campos desde Angular
        $fields = $request->validate([
            'nombre'   => 'required|string|max:100|unique:usuarios,nombre',
            'correo'   => 'required|email|unique:usuarios,correo',
            'password' => 'required|string|min:6|confirmed' // Exige 'password_confirmation'
        ]);

        // 2. Creamos el usuario
        $user = Usuario::create([
            'nombre'   => $fields['nombre'],
            'correo'   => $fields['correo'],
            'password' => $fields['password'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user, 
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        // 1. Pedimos estrictamente 'nombre' y 'password'
        $fields = $request->validate([
            'nombre'   => 'required|string',
            'password' => 'required|string'
        ]);

        // 2. Buscamos al usuario por su 'nombre' (Ej: oscar17)
        $user = Usuario::where('nombre', $fields['nombre'])->first();

        // 3. Hash::check compara tu texto plano con el hash de la DB
        if (!$user || !\Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 200);
    }
}