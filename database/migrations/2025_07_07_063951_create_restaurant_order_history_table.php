<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->id('history_id'); // Auto-increment PK

            $table->unsignedBigInteger('user_id'); // FK ke users.id
            $table->string('restaurant_id', 5);    // FK ke restaurants.restaurant_id
            $table->string('order_id', 8);         // FK ke orders.order_id

            $table->string('item_name', 100);
            $table->decimal('item_price', 10, 2);
            $table->timestamp('order_date');
            $table->enum('status', ['Pending', 'Confirmed', 'Completed', 'Cancelled']);
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
