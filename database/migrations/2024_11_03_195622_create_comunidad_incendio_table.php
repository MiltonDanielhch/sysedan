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
        Schema::create('comunidad_incendio', function (Blueprint $table) {
            $table->id();
            $table->integer('incendios_registrados');
            $table->integer('incendios_activos');
            $table->string('necesidades');
            $table->integer('num_familias_afectadas');
            $table->integer('num_familias_damnificadas');
            $table->foreignId('comunidad_id')->constrained('comunidads')->onDelete('cascade');
            $table->foreignId('incendio_id')->constrained('incendios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunidad_incendio');
    }
};
