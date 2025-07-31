<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('order_id', 8);
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');

            $table->string('restaurant_id', 5)->nullable();
            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');

            $table->tinyInteger('rating'); // from 1 to 5
            $table->text('review')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
