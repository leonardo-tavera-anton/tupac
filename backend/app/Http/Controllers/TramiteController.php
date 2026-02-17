<?php

namespace App\Http\Controllers;

use App\Services\TramiteService;
use App\Http\Resources\TramiteResource;
use Illuminate\Http\Request;

class TramiteController extends Controller {
    protected $service;
    public function __construct(TramiteService $service) { $this->service = $service; }

    public function index(Request $request) {
        $res = $this->service->todos($request->buscar, $request->query('orden', 'asc'));
        return TramiteResource::collection($res);
    }

    public function store(Request $request) {
        return new TramiteResource($this->service->registrar($request->all()));
    }

    public function show($id) {
        return new TramiteResource($this->service->obtener($id));
    }

    public function update(Request $request, $id) {
        return new TramiteResource($this->service->editar($id, $request->all()));
    }

    public function destroy($id) {
        $this->service->borrar($id);
        return response()->json(['msg' => 'Eliminado']);
    }
}