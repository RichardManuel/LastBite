<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Pickup;
use App\Models\Store;
use App\Models\Customer;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'order_name' => 'Suprised Bag',
            'order_code' => NULL,
            'order_price' => 50000, // Harga order, sesuaikan dengan kebutuhan
            'pickup_id' => NULL, // ID dari pickup yang sesuai
            'store_id' => 1, // ID dari store yang sesuai
            'customer_id' => 1, // ID dari customer yang sesuai
        ]);
    }
}
