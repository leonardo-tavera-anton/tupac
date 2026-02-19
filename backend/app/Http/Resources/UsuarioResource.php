<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
<<<<<<< HEAD
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(\Illuminate\Http\Request $request): array
=======
    public function toArray(Request $request): array
>>>>>>> aa2fccf0d093e4b2c927b6f4cc309afe767a5bb5
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
<<<<<<< HEAD
            'email' => $this->email,
            // Aquí incluimos los trámites de este usuario
            'tramites' => TramiteResource::collection($this->whenLoaded('tramites')),
=======
            'dni' => $this->dni,
            'token' => $this->when($this->token, $this->token), // Solo si existe
>>>>>>> aa2fccf0d093e4b2c927b6f4cc309afe767a5bb5
        ];
    }
}