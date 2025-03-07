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
        Schema::create('info_ecos', function (Blueprint $table) {
            $table->id();
            $table->boolean("financiacion_disponible");
            $table->string("condiciones_financiacion");
            $table->string("subvenciones");
            $table->string("proveedor");
            $table->integer("telefono_proveedor");
            $table->string("email_proveedor");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_basica_panel');
    }
};
