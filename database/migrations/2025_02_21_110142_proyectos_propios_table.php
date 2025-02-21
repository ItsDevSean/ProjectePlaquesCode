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
        Schema::create('ProyectosPropios', function (Blueprint $table) {
            $table->id();
            $table->string('asignado');
            $table->boolean('estado');
            $table->string('nombre_proyecto');
            $table->string('cliente');
            $table->string('tarifa');
            $table->string('potencia_pico');
            $table->string('pvp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ProyectosPropios');
    }
};
