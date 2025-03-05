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
        Schema::create('info_eco_resultados', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_modulo', 10, 2);
            $table->decimal('descuento', 5, 2);
            $table->decimal('precio_descuento', 10, 2);
            $table->integer('impuesto_aplicable')->nullable();
            $table->decimal('precio_final', 10, 2);
            $table->string('moneda', 3);
            $table->decimal('coste_envio', 10, 2);
            $table->decimal('coste_instalacion', 10, 2);
            $table->integer('periodo_amortizacion');
            $table->decimal('rentabilidad_esperada', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_eco_resultado');
    }
};
