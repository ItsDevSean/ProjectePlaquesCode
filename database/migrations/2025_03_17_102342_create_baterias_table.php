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
        Schema::create('baterias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_bateria');
            $table->decimal('coste', 10, 2);
            $table->decimal('capacidad', 10, 2); 
            $table->integer('garantia_material')->nullable();
            $table->integer('garantia_fabricante')->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('fabricante');
            $table->string('imagen_bateria')->nullable();
            $table->string('id_referencia')->nullable();
            $table->timestamps();

            //$table->foreign('fabricante')->references('id')->on('fabricantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baterias');
    }
};
