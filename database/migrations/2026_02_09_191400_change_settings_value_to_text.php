<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change value column from JSON to TEXT to allow simple strings
        DB::statement('ALTER TABLE settings MODIFY COLUMN value TEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to JSON
        DB::statement('ALTER TABLE settings MODIFY COLUMN value JSON NULL');
    }
};
