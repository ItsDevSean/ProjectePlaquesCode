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
        Schema::create('solar_panels_tabel', function (Blueprint $table) {
            $table->id();
            $table->string('panel_model',500);
            $table->string('manufacturer',500);
            $table->string('panel_type',500);
            $table->date('date_manufacturer');
            $table->integer('panel_warranty');
            $table->integer('performance_warranty');
            $table->integer('maximum_power');
            $table->integer('voltage_maximum_power_point');
            $table->integer('current_maximum_power_point');
            $table->integer('open_circuit_voltage');
            $table->integer('short_circuit_current');
            $table->integer('panel_efficiency');
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
