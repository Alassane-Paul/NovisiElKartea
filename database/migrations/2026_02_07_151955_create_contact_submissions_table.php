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
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->enum('type', ['contact', 'join', 'newsletter', 'other'])->default('contact');
            $table->enum('status', ['pending', 'read', 'replied', 'archived'])->default('pending');
            $table->json('data')->nullable();
            $table->timestamps();
            
            $table->index('type');
            $table->index('status');
            $table->index('created_at');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
