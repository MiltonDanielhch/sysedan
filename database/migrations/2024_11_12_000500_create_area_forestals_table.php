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
        Schema::create('area_forestals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detalle_area_forestal_id')->constrained('detalle_area_forestals')->onDelete('cascade');
            $table->decimal('hectareas_perdidas_forestales',10,3)->nullable();
            $table->foreignId('formulario_id')->constrained('formularios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_forestals');
    }
};
