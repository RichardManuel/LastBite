<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id', 8)->primary(); // e.g., OR123456

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('restaurant_id', 5); // FK ke restaurants.restaurant_id
            $table->foreignId('pickup_id')->nullable()->constrained('pickups')->onDelete('cascade');

            $table->string('item_name', 100);
            $table->decimal('item_price', 10, 2);
            $table->enum('status', ['Ongoing', 'Completed', 'Cancelled'])->default('Ongoing');
            $table->string('payment_method', 20)->default('Card');
            $table->timestamps();

            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');

            $table->index('restaurant_id');
            $table->index('pickup_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
