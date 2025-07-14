<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id', 8)->primary(); // e.g., OR123456

            $table->unsignedBigInteger('user_id'); // FK ke users.id
            $table->string('restaurant_id', 5);    // FK ke restaurants.restaurant_id

            $table->string('item_name', 100);
            $table->decimal('item_price', 10, 2);
            $table->enum('pickup_time', ['Lunch', 'Dinner']);
            $table->enum('status', ['Pending', 'Confirmed', 'Completed', 'Cancelled'])->default('Pending');
            $table->enum('payment_method', ['COD', 'Credit Card', 'Online'])->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');

            // Indexes
            $table->index('user_id');
            $table->index('restaurant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
