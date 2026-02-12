<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedimientoResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id_tramite,
            'codigo' => $this->codigo_tupa,
            'nombre' => $this->nombre_tramite,
            'area_id' => $this->id_area,
            'modalidad' => $this->modalidad,
            'generico' => $this->es_generico,
            'fecha_registro' => $this->created_at->format('d/m/Y')
        ];
    }
}