<?php

use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint; // Tidak perlu lagi
// use Illuminate\Support\Facades\Schema; // Tidak perlu lagi
// use Illuminate\Support\Facades\DB; // Tidak perlu lagi

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // KOSONGKAN METHOD INI
        // Schema::table('restaurants', function (Blueprint $table) {
        //     $table->string('password_hash', 255); // Defaultnya NOT NULL jika tidak ->nullable()
        //     $table->unique('email', 'unique_restaurant_email');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // KOSONGKAN METHOD INI JUGA
        // Schema::table('restaurants', function (Blueprint $table) {
        //     $table->dropUnique('unique_restaurant_email');
        //     $table->dropColumn('password_hash');
        // });
    }
};