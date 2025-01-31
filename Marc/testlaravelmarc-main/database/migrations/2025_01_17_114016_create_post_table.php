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
        Schema::dropIfExists('posts'); 
        
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',500);
            $table->string('slug',500);
            $table->string('description',100)->nullable();
            $table->string('content',100)->nullable();
            $table->string('image',100)->nullable();
            $table->enum('status', ['yes','no'])->default('no');
            $table->timestamps();

            $table->foreignId('category_id')->constrained()->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
