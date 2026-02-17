<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

    // Indica a Laravel que el login es por el campo 'correo'
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