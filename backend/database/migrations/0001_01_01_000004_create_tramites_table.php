<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id('id_tramite');
            $table->string('codigo_tupac')->nullable();
            $table->string('nombre_tramite');
            $table->integer('id_area');
            $table->string('modalidad')->nullable();
            $table->text('descripcion_tecnica')->nullable();
            $table->string('unidad_medida')->nullable();
            $table->boolean('es_generico')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('procedimientos'); }
};