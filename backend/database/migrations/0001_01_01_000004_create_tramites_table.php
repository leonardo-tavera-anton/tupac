<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  
    public function up(): void {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id('id_tramite');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('codigo_tupa')->nullable();
            $table->string('nombre_tramite');
            $table->decimal('monto', 10, 2)->default(0.00);
            $table->unsignedBigInteger('id_area'); 
            $table->string('modalidad')->nullable();
            $table->text('descripcion_tecnica')->nullable();
            $table->string('unidad_medida')->nullable();
            $table->boolean('es_generico')->default(false);
            $table->timestamps();

            // Llave foránea hacia la tabla areas
            $table->foreign('id_area')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void { 
        Schema::dropIfExists('tramites'); 
    }
};