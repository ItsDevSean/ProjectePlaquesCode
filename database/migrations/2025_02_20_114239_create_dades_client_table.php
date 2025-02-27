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
        Schema::create('dades_clients', function (Blueprint $table) {
            $table->id(); // Añade un ID autoincremental como clave primaria
            $table->string('nombre');
            $table->string('email');
            $table->integer('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->integer('codigo_postal');
            $table->unsignedBigInteger('proyecto_id')->unique(); // Columna para la clave foránea
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade'); // Relación con la tabla proyectos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dades_clients');
    }
};