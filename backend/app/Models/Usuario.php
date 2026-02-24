<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo', // <-- Cambiado aquí
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tramites(): HasMany
    {
        // Usamos id_usuario porque así lo definiste en la migración de trámites
        return $this->hasMany(Tramite::class, 'id_usuario');
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}