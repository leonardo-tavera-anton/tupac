<?php

namespace App\Http\Controllers;

use App\Services\TramiteService;
use App\Http\Resources\AreaResource; // Usaremos AreaResource ya que el nivel superior es Área
use App\Models\Area; // IMPORTANTE: Importar el modelo
use Illuminate\Http\Request;
use App\Models\Tramite;

class TramiteController extends Controller {
    protected $service;

    public function __construct(TramiteService $service) { 
        $this->service = $service; 
    }

    /**
     * Devuelve las Áreas con sus Trámites y Requisitos anidados
     */
   public function index() {
    // Esto trae el trámite + el nombre del área + sus requisitos (importe, factor, etc.)
    $tramites = Tramite::with(['area', 'requisitos'])->get();
    return response()->json($tramites);
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