<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla de usuarios principal
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Este es el ID que usan las llaves foráneas
            $table->string('nombre'); // Cambiado de 'name' a 'nombre'
            $table->string('correo')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabla de tokens (usando dni como referencia)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('dni')->primary(); 
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabla de sesiones
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index()->constrained('usuarios')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        // IMPORTANTE: Aquí debe decir 'usuarios', no 'users'
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};