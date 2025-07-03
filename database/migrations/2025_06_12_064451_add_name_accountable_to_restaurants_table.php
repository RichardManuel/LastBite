<?php

use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint; // Tidak perlu lagi
// use Illuminate\Support\Facades\Schema; // Tidak perlu lagi

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // KOSONGKAN METHOD INI
        // Schema::table('restaurants', function (Blueprint $table) {
        //     $table->string('name_accountable', 100)->default('');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // KOSONGKAN METHOD INI JUGA
        // Schema::table('restaurants', function (Blueprint $table) {
        //     $table->dropColumn('name_accountable');
        // });
    }
};