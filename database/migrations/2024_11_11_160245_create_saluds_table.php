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
        Schema::create('saluds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_etario_id')->constrained('grupo_etarios')->onDelete('cascade');
            $table->foreignId('detalle_enfermedad_id')->constrained('detalle_enfermedads')->onDelete('cascade');
            $table->foreignId('formulario_id')->constrained('formularios')->onDelete('cascade');
            $table->integer('cantidad_grupo_enfermos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saluds');
    }
};
