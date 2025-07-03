<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PickupStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('pickup_stores')->insert([
            ['pickup_id' => 1, 'store_id' => 1],
            ['pickup_id' => 2, 'store_id' => 1],
        ]);
        // Tambahkan data pickup_store lainnya sesuai kebutuhan

    }
}
