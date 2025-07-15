<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->string('restaurant_id', 5)->primary(); // ID manual

            // Kolom utama
            $table->string('name', 100)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('operational_hours', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('food_type', 100)->nullable();
            $table->string('applicant_name', 100)->nullable();
            $table->string('restaurant_contact_email', 255)->unique()->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('account_bank', 50)->nullable();
            $table->string('bank_account_name', 100)->nullable();
            $table->string('name_accountable', 100)->nullable();

            // Kolom harga (diubah dari string ke decimal)
            $table->decimal('pricing_tier', 10, 2)->nullable();

            $table->string('best_before')->nullable();
            $table->string('restaurant_picture_path')->nullable();
            $table->string('product_sold_picture_path')->nullable();
            $table->string('id_proof_document_path')->nullable();
            $table->string('npwp_document_path')->nullable();
            $table->string('authorization_document_path')->nullable();
            $table->string('email', 255)->unique();
            $table->string('password', 255)->nullable();

            $table->enum('status_approval', ['pending_details', 'pending_review', 'approved', 'rejected', 'inactive'])
                ->default('pending_details');

            $table->timestamps();

            // Index untuk pencarian cepat
            $table->index('name');
            $table->index('food_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
