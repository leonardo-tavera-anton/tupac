<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    // Campos que se pueden llenar desde el Excel o formulario
    protected $fillable = [
        'nombre',
        'ubicacion',
        'anexo'
    ];

    /**
     * Un área tiene muchos procedimientos (TUPAC)
     */
    public function procedimientos(): HasMany
    {
        return $this->hasMany(Procedimiento::class);
    }
}