<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->string('codigo_generico'); // Columna GENERICO
            $table->integer('orden');          // Columna ORDEN
            $table->text('especifica');        // Columna ESPECIFICA
            $table->decimal('importe', 10, 2); // Columna IMPORTE
            $table->decimal('factor', 12, 6);  // Columna FACTOR
            $table->integer('plazo_dias')->default(30);
            $table->string('calificacion')->default('Evaluación Previa');
            $table->string('silencio_adm')->default('Negativo');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('procedimientos');
    }
};