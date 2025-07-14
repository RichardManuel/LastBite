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
            Schema::create('restaurant_applications', function (Blueprint $table) {
                $table->id('RestaurantApplicationID');
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
                $table->string('ProductSoldPicture');
                $table->string('IdProofDocument');
                $table->string('NPWPDocument');
                $table->string('AuthorizationDocument');
                $table->string('Email');
                $table->string('Password');
                $table->string('StatusApproval');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('restaurant_applications');
        }
    };
