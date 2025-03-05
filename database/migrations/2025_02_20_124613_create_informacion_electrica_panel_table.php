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
        Schema::create('InformacionElectricaPanel', function (Blueprint $table) {
            $table->integer('potencia_maxima');
            $table->integer('tension_maxima_potencia');
            $table->integer('corriente_punto_maxima_potencia');
            $table->integer('tension_circuito_abierto');
            $table->integer('corriente_cortocircuito');
            $table->integer('eficencia_panel');
            $table->integer('coeficiente_temp_pmax');
            $table->integer('coeficiente_temp_voc');
            $table->integer('coeficiente_temp_isc'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('InformacionElectricaPanel');
    }
};
