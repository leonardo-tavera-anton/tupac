<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'nombre'         => $this->nombre,
            'ubicacion'      => $this->ubicacion,
            'anexo'          => $this->anexo,
            'procedimientos' => $this->procedimientos, // Incluye la relación
            'creado_el'      => $this->created_at->format('d-m-Y'),
        ];
    }
}