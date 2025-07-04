<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurant_stocks', function (Blueprint $table) {
            $table->string('stock_id', 10)->primary(); // Akan di-generate manual di model
            $table->string('restaurant_id', 5);
            $table->integer('quantity')->default(0);
            $table->text('item_name');
            $table->timestamps();

            // Foreign key ke tabel restaurants
            $table->foreign('restaurant_id')
                  ->references('restaurant_id')
                  ->on('restaurants')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_stocks');
    }
};
