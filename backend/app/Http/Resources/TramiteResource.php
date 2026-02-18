<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TramiteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_tramite' => $this->id_tramite,
            'nombre_tramite' => $this->nombre_tramite,
            'monto' => $this->monto,
            // CAMBIA RequisitoResource por RequisitosResource (con 's')
            'requisitos' => RequisitosResource::collection($this->whenLoaded('requisitos')),
        ];
    }
}