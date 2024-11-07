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
        Schema::create('servicio_basicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_servicio_basico_id')->constrained('tipo_servicio_basicos');
            $table->string('informacion_tipo_dano')->nullable();
            $table->integer('numero_comunidades_afectadas')->nullable();
            $table->foreignId('formulario_id')->constrained('formularios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_basicos');
    }
};
