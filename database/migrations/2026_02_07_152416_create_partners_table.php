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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->enum('type', ['institutional', 'educational', 'social', 'business'])->default('institutional');
            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            $table->index('type');
            $table->index('order');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
