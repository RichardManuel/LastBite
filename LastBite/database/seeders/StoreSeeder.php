<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store; // ⬅️ WAJIB ada agar Store::create bisa dikenali

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'store_name' => 'Dunkin’ Donuts',
            'store_address' => 'Jl. Siliwangi No.29 4, RT.02/RW.02, Sukasari, Kec. Bogor Tim., Kota Bogor, Jawa Barat, 16142',
            'store_phone' => '081234598968',
        ]);
    }
}
