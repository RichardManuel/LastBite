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
        Schema::create('restaurant_order_histories', function (Blueprint $table) {
            $table->id('RestaurantHistory');

            $table->unsignedBigInteger('OrderID');
            $table->foreign('OrderID')->references('OrderID')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('RestaurantID');
            $table->foreign('RestaurantID')->references('RestaurantID')->on('restaurants')->onDelete('cascade');

            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade'); // ✅ FIXED

            $table->enum('Status', ['OnGoing', 'Completed', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_order_histories');
    }
};
