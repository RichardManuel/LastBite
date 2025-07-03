<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->id('history_id'); // Menggunakan id() standar Laravel untuk SERIAL PRIMARY KEY
            $table->string('user_id', 6);
            $table->string('restaurant_id', 5);
            $table->string('order_id', 8);
            $table->string('item_name', 100);
            $table->decimal('item_price', 10, 2);
            $table->timestamp('order_date'); // Ini tetap karena merupakan denormalisasi dari order asli
            $table->string('status', 20); // Anda mungkin ingin enum di sini juga
            $table->timestamps(); // Opsional, jika Anda ingin tahu kapan history record dibuat/diupdate

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');

            // Indexes
            $table->index('user_id', 'idx_history_user');
            $table->index('restaurant_id', 'idx_history_restaurant');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_history');
    }
};