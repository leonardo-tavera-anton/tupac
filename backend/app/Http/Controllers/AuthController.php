<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    /**
     * Registro para Angular
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'correo'   => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:8|confirmed',
        ]);

        $usuario = $this->usuarioService->crearCuenta($data);
        
        // Generamos el token para Angular
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario
        ], 201);
    }

    /**
     * Login para Angular
     */
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'correo'   => 'required|email',
            'password' => 'required',
        ]);

        if (!$this->usuarioService->autenticar($credenciales)) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        $usuario = Usuario::where('correo', $request->correo)->firstOrFail();
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario
        ]);
    }

    /**
     * Logout para Angular
     */
    public function logout(Request $request)
    {
        // Revocar el token actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada y token eliminado'
        ]);
    }
}