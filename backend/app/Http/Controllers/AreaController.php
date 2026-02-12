<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AreaService;
use App\Http\Resources\AreaResource;
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
        $buscar = $request->query('buscar');
        $orden  = $request->query('orden', 'asc');

        $areas = $this->servicio->listarAreas($buscar, $orden);
        
        return AreaResource::collection($areas);
    }
}