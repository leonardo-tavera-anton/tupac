<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tramite', function (Blueprint $table) {
            $table->id('id_tramite');
            $table->string('codigo_tupa')->nullable();
            $table->text('nombre_tramite');
            $table->text('descripcion_tecnica')->nullable();
            $table->boolean('es_generico')->default(false);

            $table->unsignedBigInteger('id_area'); 
            $table->unsignedBigInteger('id_usuario'); 

            // RELACIONES CORREGIDAS
            $table->foreign('id_area')->references('id')->on('areas')->onDelete('cascade');
            
            // CAMBIO AQUÍ: 'users' -> 'usuarios'
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void { 
        Schema::dropIfExists('tramite'); 
    }
};