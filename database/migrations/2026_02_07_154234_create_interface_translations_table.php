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
        Schema::create('interface_translations', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index();
            $table->string('key')->index(); // Clef de traduction
            $table->json('text'); // Stocke les traductions {fr: "...", es: "..."}
            $table->text('notes')->nullable(); // Contexte pour les traducteurs
            $table->timestamps();
            
            $table->unique(['group', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interface_translations');
    }
};
