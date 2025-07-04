<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'customer_name' => 'Iven Marchellia',
            'customer_email' => 'ivencantikbingtsszz21@gmail.com',
            'customer_city' => 'Bogor',
            'customer_phone' => '0898234778111',
        ]);
    }
}
