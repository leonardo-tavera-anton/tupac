<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tramite extends Model
{
    protected $table = 'tramite'; // Forzamos el nombre en singular
    protected $primaryKey = 'id_tramite';
    protected $fillable = ['codigo_tupa', 'nombre_tramite', 'id_area', 'id_usuario', 'es_generico'];
    
    public function area() {
    return $this->belongsTo(Area::class, 'id_area');
}

public function requisitos() {
    // IMPORTANTE: Asegúrate de que el nombre del modelo sea Requisito
    return $this->hasMany(Requisito::class, 'tramite_id', 'id_tramite');
}
}