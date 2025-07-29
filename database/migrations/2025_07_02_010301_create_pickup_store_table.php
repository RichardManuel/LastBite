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
        Schema::create('pickup_restaurants', function (Blueprint $table) {
            $table->foreignId('pickup_id')->constrained()->onDelete('cascade');
            $table->string('restaurant_id', 5);
            $table->timestamps();

            // Foreign key ke restaurants.restaurant_id
            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');

            // Composite Primary Key
            $table->primary(['pickup_id', 'restaurant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_restaurants');
    }
};
