<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id('RestaurantID');
            $table->string('Name');
            $table->string('Location');
            $table->string('OperationalHours');
            $table->text('Description');
            $table->string('FoodType');
            $table->string('PricingTier');
            $table->string('BestBefore');
            $table->string('ApplicantName');
            $table->string('Telephone');
            $table->string('AccountBank');
            $table->string('BankAccountName');
            $table->string('RestaurantPicture');
            $table->integer('Ratings')->nullable();
            $table->integer('ReviewCounts')->nullable();
            $table->string('Email');
            $table->string('password');

            // ✅ FIXED: correct column and reference name
            $table->foreignId('RestaurantApplicantID')
                ->constrained('restaurant_applications', 'RestaurantApplicationID')
                ->onDelete('cascade');

            $table->integer('DinnerStock');
            $table->integer('LunchStock');
            $table->decimal('Income', 10, 2)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
