<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tramite extends Model
{
    // Forzamos el nombre de la tabla en plural como está en tu migración
    protected $table = 'tramites'; 

    // También asegúrate de que la llave primaria sea la que pusiste en la migración
    protected $primaryKey = 'id_tramite';

    protected $fillable = [
        'usuario_id',
        'codigo_tupa',
        'nombre_tramite',
        'monto',
        'id_area',
        'modalidad',
        'descripcion_tecnica',
        'unidad_medida',
        'es_generico'
    ];

    public function requisitos()
    {
        return $this->hasMany(Requisito::class, 'tramite_id', 'id_tramite');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
}