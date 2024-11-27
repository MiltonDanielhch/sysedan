<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fauna_silvestres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detalle_fauna_silvestre_id')->constrained('detalle_fauna_silvestres')->onDelete('cascade');
            $table->foreignId('tipo_especie_id')->constrained('tipo_especies')->onDelete('cascade');
            $table->integer('numero_fauna_silvestre')->nullable();
            $table->foreignId('formulario_id')->constrained('formularios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fauna_silvestres');
    }
};
