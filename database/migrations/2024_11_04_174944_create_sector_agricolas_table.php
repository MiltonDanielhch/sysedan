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
        Schema::create('sector_agricolas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_cultivo_id')->constrained('tipo_cultivos');
            $table->integer('hectareas_afectados');
            $table->integer('hectareas_perdidas');
            $table->foreignId('formulario_id')->constrained('formularios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sector_agricolas');
    }
};
