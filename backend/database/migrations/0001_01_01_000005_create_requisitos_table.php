<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('requisitos', function (Blueprint $table) {
            $table->id();
            
            // Definimos la columna manualmente para asegurar compatibilidad total
            $table->unsignedBigInteger('tramite_id');

            // RELACIÓN CORREGIDA: 
            // 1. Apunta a la tabla 'tramite' (que es la que creaste en singular)
            // 2. Apunta a la columna 'id_tramite'
            $table->foreign('tramite_id')
                  ->references('id_tramite')
                  ->on('tramite')
                  ->onDelete('cascade');
            
            $table->text('descripcion'); 
            $table->boolean('es_obligatorio')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('requisitos');
    }
};