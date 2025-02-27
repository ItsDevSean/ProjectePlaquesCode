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
        Schema::table('dadesclient', function (Blueprint $table) {
            $table->dropForeign(['proyecto_id']);
        });
    }
    
    public function down()
    {
        Schema::table('dadesclient', function (Blueprint $table) {
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }
    
};
