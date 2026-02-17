<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importante para el tipado

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // RELACIÓN: Un usuario tiene muchos trámites
    public function tramites(): HasMany
    {
        return $this->hasMany(Tramite::class, 'usuario_id');
    }

    public function getEmailAttribute()
    {
        return $this->correo;
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}