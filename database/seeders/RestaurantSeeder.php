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
        $restaurants = [
            [
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
                'pricing_tier' => 35000,
                'rating' => 4.5,
                'email' => 'lastbite@example.com',
                'password' => Hash::make('12345678'),
                'status' => 'accepted',
            ],
            [
                'restaurant_id' => 'R0002',
                'name' => 'Nasi Nusantara',
                'location' => 'Bandung',
                'operational_hours' => '10:00 - 22:00',
                'description' => 'Menu khas Indonesia',
                'food_type' => 'Rice-based',
                'applicant_name' => 'Budi Santoso',
                'telephone' => '08129876543',
                'account_bank' => 'Mandiri',
                'bank_account_name' => 'Nasi Nusantara',
                'pricing_tier' => 30000,
                'rating' => 4.2,
                'email' => 'nasi@example.com',
                'password' => 12345678,
                'status' => 'accepted',
            ],
            [
                'restaurant_id' => 'R0003',
                'name' => 'PastaMania',
                'location' => 'Surabaya',
                'operational_hours' => '11:00 - 20:00',
                'description' => 'Spesialis pasta dan makanan Italia',
                'food_type' => 'Italian',
                'applicant_name' => 'Maria Agustina',
                'telephone' => '08561234567',
                'account_bank' => 'BNI',
                'bank_account_name' => 'PastaMania',
                'pricing_tier' => 45000,
                'rating' => 4.7,
                'email' => 'pasta@example.com',
                'password' => 12345678,
                'status' => 'accepted',
                'restaurant_picture_path' => 'img/pizzahut.jpg', // contoh path
                'product_sold_picture_path' => 'img/pizza.jpg', // contoh path
            ],
            [
                'restaurant_id' => 'R0004',
                'name' => 'Veggie Delight',
                'location' => 'Yogyakarta',
                'operational_hours' => '08:00 - 19:00',
                'description' => 'Menu sehat dan vegetarian',
                'food_type' => 'Vegetarian',
                'applicant_name' => 'Siti Aminah',
                'telephone' => '08213456789',
                'account_bank' => 'BRI',
                'bank_account_name' => 'Veggie Delight',
                'pricing_tier' => 28000,
                'rating' => 4.3,
                'email' => 'veggie@example.com',
                'password' => 12345678,
                'status' => 'accepted',
            ],
        ];

        $stockItems = [
            ['pickup_time' => 'Lunch', 'stock' => 5],
            ['pickup_time' => 'Dinner', 'stock' => 8],
        ];

        foreach ($restaurants as $data) {
            $restaurant = Restaurant::create($data);

            foreach ($stockItems as $item) {
                RestaurantStock::create([
                    'restaurant_id' => $restaurant->restaurant_id,
                    'item_name' => 'Contoh Menu ' . $restaurant->name,
                    'pickup_time' => $item['pickup_time'],
                    'stock' => $item['stock'],
                ]);
            }
        }
    }
}
