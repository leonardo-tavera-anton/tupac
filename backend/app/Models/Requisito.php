<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requisito extends Model
{
    use HasFactory;

    // IMPORTANTE: Tu migración crea 'requisitos' (plural), el modelo debe coincidir
    protected $table = 'requisitos'; 

    protected $fillable = [
        'tramite_id',    // Falta en el tuyo
        'descripcion',
        'es_obligatorio' // Falta en el tuyo
    ];

    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id', 'id_tramite');
    }
}