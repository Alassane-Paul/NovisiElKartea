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
        Schema::table('settings', function (Blueprint $table) {
            // Change type column from enum to string to support more types (url, email, boolean, etc.)
            $table->string('type')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Reverting might be tricky if data exists that doesn't fit the original enum
            // For now, let's assume we can revert to string, or just do nothing safely
             $table->string('type')->change();
        });
    }
};
