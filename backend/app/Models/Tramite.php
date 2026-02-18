<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tramite extends Model
{
    // Forzamos el nombre de la tabla en plural como está en tu migración
    protected $table = 'tramites'; 

<<<<<<< HEAD
    // También asegúrate de que la llave primaria sea la que pusiste en la migración
=======
    // Tabla correcta según tu base de datos
    protected $table = 'tramite';

>>>>>>> aa2fccf0d093e4b2c927b6f4cc309afe767a5bb5
    protected $primaryKey = 'id_tramite';

    protected $fillable = [
        'usuario_id',
        'codigo_tupa',
        'nombre_tramite',
        'monto',
        'id_area',
<<<<<<< HEAD
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
=======
        'id_usuario',
        'descripcion_tecnica',
        'es_generico'
    ];

    protected $casts = [
        'es_generico' => 'boolean',
        'id_area' => 'integer',
        'id_usuario' => 'integer',
    ];

    /**
     * Relación: Un trámite pertenece a un Usuario (Clase Usuario)
     */
    public function usuario(): BelongsTo
    {
        // Corregido: Ahora referencia a Usuario::class y usa id_usuario
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    /**
     * Relación: Un trámite pertenece a un Área
     */
    public function area(): BelongsTo
>>>>>>> aa2fccf0d093e4b2c927b6f4cc309afe767a5bb5
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
}