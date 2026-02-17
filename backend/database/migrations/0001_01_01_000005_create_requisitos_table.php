<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('requisitos', function (Blueprint $table) {
            $table->id();
            // Cambiamos 'procedimientos' por 'tramites'
            // Y nos aseguramos de que el ID de referencia sea 'id_tramite'
            $table->foreignId('tramite_id')
                  ->constrained('tramites', 'id_tramite') 
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