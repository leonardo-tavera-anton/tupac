<?php

namespace App\Http\Controllers;

use App\Services\ProcedimientoService;
use App\Http\Resources\ProcedimientoResource;
use Illuminate\Http\Request;

class ProcedimientoController extends Controller {
    protected $service;
    public function __construct(ProcedimientoService $service) { $this->service = $service; }

    public function index(Request $request) {
        $res = $this->service->todos($request->buscar, $request->query('orden', 'asc'));
        return ProcedimientoResource::collection($res);
    }

    public function store(Request $request) {
        return new ProcedimientoResource($this->service->registrar($request->all()));
    }

    public function show($id) {
        return new ProcedimientoResource($this->service->obtener($id));
    }

    public function update(Request $request, $id) {
        return new ProcedimientoResource($this->service->editar($id, $request->all()));
    }

    public function destroy($id) {
        $this->service->borrar($id);
        return response()->json(['msg' => 'Eliminado']);
    }
}