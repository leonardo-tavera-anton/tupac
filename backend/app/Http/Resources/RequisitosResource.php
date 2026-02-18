<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequisitosResource extends JsonResource // <--- Asegúrate que tenga la 's'
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'es_obligatorio' => $this->es_obligatorio
        ];
    }
}