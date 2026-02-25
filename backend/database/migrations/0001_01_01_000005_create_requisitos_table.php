<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::create('requisitos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tramite_id');
        $table->foreign('tramite_id')->references('id_tramite')->on('tramite')->onDelete('cascade');
        
        $table->text('descripcion'); 
        $table->integer('orden')->default(0); // Nueva columna
        $table->decimal('importe', 10, 2)->default(0); // Nueva columna
        $table->decimal('factor', 10, 6)->default(0);  // Nueva columna
        
        $table->boolean('es_obligatorio')->default(true);
        $table->timestamps();
    });
}

    public function down(): void {
        Schema::dropIfExists('requisitos');
    }
};