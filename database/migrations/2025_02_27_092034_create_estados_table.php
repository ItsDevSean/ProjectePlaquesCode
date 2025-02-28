<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Estado único (ejemplo: pendiente, en progreso, completado)
            $table->timestamps();
        });

        // Insertar estados iniciales
        DB::table('estados')->insert([
            ['nombre' => 'Pendiente'],
            ['nombre' => 'Iniciado'],
            ['nombre' => 'Completado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
   
};
