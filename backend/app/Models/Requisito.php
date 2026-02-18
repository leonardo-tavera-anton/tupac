<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'requisitos';

    /**
     * Atributos asignables masivamente.
     */
    protected $fillable = [
        'descripcion',
        'monto',
        'factor',
    ];

    /*en decimales*/
    protected $casts = [
        'monto' => 'decimal',
        'factor' => 'integer',
    ];
}