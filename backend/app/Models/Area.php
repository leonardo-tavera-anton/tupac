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
        'telefono'
    ];
    protected $table = 'areas';
    // En Area.php
public function tramites() {
    return $this->hasMany(Tramite::class, 'id_area', 'id');
}
}