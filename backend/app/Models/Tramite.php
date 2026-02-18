<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tramite extends Model
{
    use HasFactory;

    // Tabla correcta según tu base de datos
    protected $table = 'tramite';

    protected $primaryKey = 'id_tramite';

    protected $fillable = [
        'codigo_tupa',
        'nombre_tramite',
        'id_area',
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
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
}