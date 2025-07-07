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
        Schema::create('order_histories', function (Blueprint $table) {
            $table->id('HistoryID');

            $table->foreignId('UserID')->constrained('users');

            $table->foreignId('RestaurantID')
                ->constrained('restaurants', 'RestaurantID')
                ->onDelete('cascade');

            $table->foreignId('OrderID')
                ->constrained('orders', 'OrderID')
                ->onDelete('cascade');

            $table->string('ItemName');
            $table->decimal('ItemPrice', 10, 2);
            $table->dateTime('OrderDate');
            $table->dateTime('PickupTime');
            $table->decimal('TotalPrice', 10, 2);
            $table->string('PaymentMethod');
            $table->enum('Status', ['OnGoing', 'Completed', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_histories');
    }
};
