<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Restaurant;
use App\Models\RestaurantStock;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 1 restoran contoh
        $restaurant = Restaurant::create([
            'restaurant_id' => 'R0001',
            'name' => 'LastBite Eatery',
            'location' => 'Jakarta',
            'operational_hours' => '09:00 - 21:00',
            'description' => 'Contoh restoran',
            'food_type' => 'Bakery',
            'applicant_name' => 'Admin',
            'telephone' => '08123456789',
            'account_bank' => 'BCA',
            'bank_account_name' => 'LastBite',
            'pricing_tier' => 3.00,
            'rating' => 4.5,
            'email' => 'lastbite@example.com',
            'password' => Hash::make('password'),
            'status' => 'accepted',
        ]);

        // Buat stok Lunch & Dinner
        $items = [
            ['pickup_time' => 'Lunch', 'stock' => 5],
            ['pickup_time' => 'Dinner', 'stock' => 8],
        ];

        foreach ($items as $item) {
            RestaurantStock::create([
                'restaurant_id' => $restaurant->restaurant_id,
                'item_name' => 'Dunkin Doughnut',
                'pickup_time' => $item['pickup_time'],
                'stock' => $item['stock'],
            ]);
        }
    }
}
