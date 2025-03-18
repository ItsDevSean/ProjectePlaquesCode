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
        Schema::create('inversores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_inversor');
            $table->decimal('eficiencia', 5, 2);
            $table->enum('tipo_instalacion', ['monofasica', 'trifasica']);
            $table->integer('garantia_material')->nullable();
            $table->decimal('potencia_nominal', 10, 2); 
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('fabricante_id'); 
            $table->boolean('microinversor')->default(false);
            $table->integer('garantia_fabricante')->nullable();
            $table->string('imagen_inversor')->nullable();
            $table->string('id_referencia')->nullable();
            $table->timestamps();

       
            $table->foreign('fabricante_id') 
                ->references('id')         
                ->on('fabricantes')       
                ->onDelete('cascade');     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inversores');
    }
};