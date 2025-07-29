<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', [
                    'pending_details',
                    'pending_approval',
                    'active',
                    'rejected',
                    'inactive'
                ])
                ->default('pending_details')
                ->after('roles'); // harus sama persis nama kolomnya
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
