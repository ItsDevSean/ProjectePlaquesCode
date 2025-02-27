<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dades_clients', function (Blueprint $table) {
            $table->unique('proyecto_id'); // Añadir restricción de unicidad
        });
    }
    
    public function down()
    {
        Schema::table('dades_clients', function (Blueprint $table) {
            $table->dropUnique(['proyecto_id']); // Eliminar restricción de unicidad
        });
    }
};
