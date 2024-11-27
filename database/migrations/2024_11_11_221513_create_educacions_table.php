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
        Schema::create('educacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institucion_id')->constrained('institucions')->onDelete('cascade');
            $table->foreignId('modalidad_educacion_id')->constrained('modalidad_educacions')->onDelete('cascade');
            $table->integer('numero_estudiantes')->nullable();
            $table->foreignId('formulario_id')->constrained('formularios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educacions');
    }
};
