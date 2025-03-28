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
        Schema::dropIfExists('solar_panels_tabel');

        Schema::create('solar_panels_tabel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');            
            $table->string('panel_model',500);
            $table->string('manufacturer',500);
            $table->string('panel_type',500);
            $table->date('date_manufacturer');
            $table->integer('panel_warranty')->nullable();
            $table->integer('performance_warranty')->nullable();
            $table->decimal('longitud_v2', 10, 2);
            $table->decimal('anchura', 10, 2);
            $table->decimal('espesor', 10, 2);
            $table->decimal('peso', 10, 2); 
            $table->decimal('superficie', 10, 2);
            $table->string('descripcion')->nullable();
            $table->string('url_fabricante')->nullable();
            $table->string('imagen_panel')->nullable();
            $table->string('material_marco')->nullable();
            $table->string('color_panel')->nullable();
            $table->integer('potencia_maxima');
            $table->integer('tension_maxima_potencia')->nullable();
            $table->integer('corriente_punto_maxima_potencia')->nullable();
            $table->integer('tension_circuito_abierto')->nullable();
            $table->integer('corriente_cortocircuito')->nullable();
            $table->integer('eficencia_panel');
            $table->integer('coeficiente_temp_pmax');
            $table->integer('coeficiente_temp_voc')->nullable();
            $table->integer('coeficiente_temp_isc')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_panels_tabel');
    }


};
