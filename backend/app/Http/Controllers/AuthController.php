<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'nombre'   => 'required|string|max:100',
            'dni'      => 'required|string|max:8|unique:usuarios,dni',
            'password' => 'required|string|min:6|confirmed' // 'confirmed' busca un campo 'password_confirmation'
        ]);

        $user = Usuario::create([
            'nombre'   => $fields['nombre'],
            'dni'      => $fields['dni'],
            'password' => $fields['password'], // El 'hashed' cast en el modelo se encarga del cifrado
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user, 
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'dni'      => 'required|string',
            'password' => 'required|string'
        ]);

        // Check DNI
        $user = Usuario::where('dni', $fields['dni'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 200);
    }
}