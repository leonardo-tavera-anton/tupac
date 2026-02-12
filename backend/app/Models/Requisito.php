<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'requisito';

    /**
     * Atributos asignables masivamente.
     */
    protected $fillable = [
        'descripcion',
        'monto',
        'factor',
    ];

    /**
     * Casting de tipos. 
     * Aunque en la foto dice 'integer', si el monto maneja decimales 
     * (dinero), podrías cambiarlo a 'decimal:2'.
     */
    protected $casts = [
        'monto' => 'integer',
        'factor' => 'integer',
    ];
}