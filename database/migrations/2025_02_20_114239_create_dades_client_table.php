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
            $table->id();
            
            // Datos básicos del cliente
            $table->string('nombre'); // user_1_nombre
            $table->string('email'); // user_1_email
            $table->string('telefono'); // user_1_telefono
            $table->string('direccion'); // user_1_direccion
            $table->string('ciudad'); // user_1_ciudad
            $table->string('codigo_postal'); // user_1_codigo_postal
            
            // Datos del proyecto
            $table->string('nombre_proyecto'); // user_1_nombre_proyecto
            $table->text('descripcion_proyecto')->nullable(); // user_1_descripcion_proyecto
            $table->string('estacionalidad'); // user_1_estacionalidad
            $table->string('tipo_instalacion'); // user_1_tipo_instalacion
            
            // Datos de consumo y facturación
            $table->decimal('consum_anual', 10, 2); // user_1_consumAnual
            $table->decimal('factura_anual', 10, 2); // user_1_facturaAnual
            $table->string('tarifa_acces'); // user_1_tarifaAcces
            $table->decimal('patro_consum', 3, 1); // user_1_consumPattern
            
            // Datos financieros
            $table->decimal('coste_instalacion', 12, 2); // user_1_costeInstalacion
            $table->decimal('subvenciones', 12, 2); // user_1_subvenciones
            $table->decimal('precio_excedentes', 12, 2); // user_1_precioExcedentes
            
            // Datos técnicos de la instalación
            $table->decimal('inclinacion', 5, 2); // user_1_inclinacion
            $table->string('orientacion'); // user_1_orientacion
            $table->decimal('radiacion_anual', 10, 2); // user_1_radiacion
            $table->integer('max_placas'); // user_1_maxPlacas
            $table->integer('placa_count'); // user_1_placaCount
            $table->decimal('panel_potencia', 8, 2); // user_1_panel_pot
            $table->string('panel_modelo'); // user_1_panel_model
            $table->decimal('superficie', 12, 2); // user_1_superficie
            $table->decimal('nova_area', 12, 2); // user_1_novaArea
            
            // Datos en formato JSON
            $table->json('monthly_radiation')->nullable(); // user_1_monthlyRadiation
            $table->json('produccion_mensual')->nullable(); // user_1_produccionMensual
            $table->json('edifici_data')->nullable(); // user_1_edificiData
            $table->json('obstacles')->nullable(); // user_1_obstacles
            $table->json('polygon')->nullable(); // user_1_polygon
            $table->json('radiation_coords')->nullable(); // user_1_radiationCoords
            
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