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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom status setelah kolom 'role' (atau sesuaikan posisinya)
            $table->enum('status', ['pending_details', 'pending_approval', 'active', 'rejected', 'inactive'])
                  ->default('pending_details') // Default saat user baru dibuat (meskipun kita set juga di controller)
                  ->after('role'); // Opsional: menentukan posisi kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};