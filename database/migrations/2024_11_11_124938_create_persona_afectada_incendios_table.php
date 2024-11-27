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
        Schema::create('persona_afectada_incendios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_etario_id')->constrained('grupo_etarios')->onDelete('cascade');
            $table->integer('cantidad_afectados_por_incendios')->nullable();
            $table->foreignId('formulario_id')->constrained('formularios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_afectada_incendios');
    }
};
