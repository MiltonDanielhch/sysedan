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
        Schema::create('sector_pecuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_especie_id')->constrained('tipo_especies');
            $table->integer('numero_animales_afectados')->nullable();
            $table->integer('numero_animales_fallecidos')->nullable();
            $table->foreignId('formulario_id')->constrained('formularios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sector_pecuarios');
    }
};
