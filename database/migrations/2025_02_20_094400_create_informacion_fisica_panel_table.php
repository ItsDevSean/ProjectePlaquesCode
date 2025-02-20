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
        Schema::create('InformacionFisicaPanel', function (Blueprint $table) {
            $table->id();
            $table->decimal('longitud', 10, 2);
            $table->decimal('anchura', 10, 2);
            $table->decimal('espesor', 10, 2);
            $table->decimal('peso', 10, 2); 
            $table->decimal('superficie', 10, 2);
            $table->string('descripcion')->nullable();
            $table->string('url_fabricante')->nullable();
            $table->string('imagen_panel')->nullable();
            $table->string('material_marco');
            $table->string('color_panel') ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('InformacionFisicaPanel');
    }
};
