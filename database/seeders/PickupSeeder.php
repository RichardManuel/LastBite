<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pickup;

class PickupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pickup::create([
            'time_type' => 'Lunch',
            'start_time' => '11:00:00',
            'end_time' => '13:00:00',
        ]);

        Pickup::create([
            'time_type' => 'Dinner',
            'start_time' => '17:00:00',
            'end_time' => '19:00:00',
        ]);
    }
}
