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
        Schema::create('infraestructuras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_infraestructura_id')->constrained('tipo_infraestructuras');
            $table->integer('numeros_infraestructuras_afectadas')->nullable();
            $table->foreignId('formulario_id')->constrained('formularios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infraestructuras');
    }
};
