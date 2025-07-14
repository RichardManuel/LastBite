<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurant_applications', function (Blueprint $table) {
            $table->string('application_id', 10)->primary(); // Akan diisi manual via model (contoh: APP0000001)

            // Restaurant Information
            $table->string('restaurant_name', 100);
            $table->string('restaurant_location', 255);
            $table->string('operational_hours', 100);
            $table->text('description');
            $table->string('food_type', 100);
            $table->string('restaurant_email', 255); // Bisa diberi unique jika perlu
            $table->string('password_hash', 255);

            // Applicant Information
            $table->string('applicant_name', 100);
            $table->string('applicant_phone', 20);

            // Financial Information
            $table->string('pricing_tier', 50);
            $table->string('account_bank', 50);
            $table->string('bank_account_name', 100);
            $table->string('name_accountable', 100);

            // Documents (simpan path ke file)
            $table->text('npwp_document_path')->nullable();
            $table->text('authorization_document_path')->nullable();
            $table->text('id_proof_document_path')->nullable();

            // Photos
            $table->json('restaurant_photos')->nullable();
            $table->json('product_photos')->nullable();

            // Additional Metadata
            $table->string('best_before')->nullable(); // Ubah jadi string karena DATE bisa tricky jika nullable
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_applications');
    }
};
