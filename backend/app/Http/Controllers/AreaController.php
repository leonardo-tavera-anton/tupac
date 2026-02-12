<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    protected $servicio;

    public function __construct(AreaService $servicio)
    {
        $this->servicio = $servicio;
    }

    public function index(Request $request)
    {
        // Capturamos filtros de la URL: ?buscar=nombre&orden=desc
        $buscar = $request->query('buscar');
        $orden  = $request->query('orden', 'asc');

        $areas = $this->servicio->listarAreas($buscar, $orden);
        
        return response()->json($areas);
    }

    public function store(Request $request)
    {
        $area = $this->servicio->registrarArea($request->all());
        return response()->json($area, 201);
    }
}