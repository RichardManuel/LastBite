<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
    Schema::create('restaurant_stocks', function (Blueprint $table) {
    $table->id();
    $table->string('restaurant_id', 5); // FK ke restoran
    $table->string('item_name', 100);
    $table->enum('pickup_time', ['Lunch', 'Dinner']); // stok per pickup time
    $table->integer('stock')->default(0);
    $table->timestamps();

    $table->foreign('restaurant_id')
          ->references('restaurant_id')
          ->on('restaurants')
          ->onDelete('cascade');

    $table->unique(['restaurant_id', 'item_name', 'pickup_time']); // 1 stok per pickup time
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_stocks');
    }
};
