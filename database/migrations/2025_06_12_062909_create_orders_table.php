<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id', 8)->primary(); // Akan diisi manual lewat model
            $table->string('user_id', 6);
            $table->string('restaurant_id', 5);
            $table->string('item_name', 100);
            $table->decimal('item_price', 10, 2);
            $table->enum('pickup_time', ['Lunch', 'Dinner']);
            $table->enum('status', ['Pending', 'Confirmed', 'Completed', 'Cancelled'])->default('Pending');
            $table->enum('payment_method', ['COD', 'Credit Card', 'Online'])->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');

            $table->index('user_id');
            $table->index('restaurant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
