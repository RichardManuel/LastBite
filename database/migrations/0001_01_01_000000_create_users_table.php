<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 6)->primary(); // Diisi manual di model
            $table->string('name', 100);
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->enum('role', ['user', 'resto', 'admin'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
