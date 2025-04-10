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
        Schema::create('electric_bill', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("month");
            $table->string("year");
            $table->string("electricity_consumption");
            $table->integer("bull");            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electric_bill');

    }
};
