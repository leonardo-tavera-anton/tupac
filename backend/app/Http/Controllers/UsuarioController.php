<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'correo'   => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:8|confirmed',
        ]);

        $usuario = $this->usuarioService->crearCuenta($data);
        Auth::login($usuario);

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'correo'   => 'required|email',
            'password' => 'required',
        ]);

        if ($this->usuarioService->autenticar($credenciales)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['correo' => 'Datos incorrectos']);
    }
}