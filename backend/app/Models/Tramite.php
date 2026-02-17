<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    // Indicamos el nombre de la tabla (opcional si tu tabla se llama 'procedimientos')
    protected $table = 'tramite';

    // Definimos la llave primaria personalizada
    protected $primaryKey = 'id_tramite';

    /**
     * Atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'codigo_tupac',
        'nombre_tramite',
        'id_area',
        'modalidad',
        'descripcion_tecnica',
        'unidad_medida',
        'es_generico',
    ];

    /**
     * Casting de tipos de datos.
     * Esto asegura que 'es_generico' se trate como booleano en PHP.
     */
    protected $casts = [
        'es_generico' => 'boolean',
        'id_area' => 'integer',
    ];
}