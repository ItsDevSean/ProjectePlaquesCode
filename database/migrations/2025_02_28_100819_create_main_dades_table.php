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
        Schema::table('dades_clients', function (Blueprint $table) {
            // Agregar campos de proyectos a dades_clients
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('estados')->default(1);
        });

    }

    /**
     * Reverse the migrations.
     */
};
