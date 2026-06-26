<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gọi Factory đã cấu hình để sinh 100 sản phẩm
        \App\Models\Product::factory(100)->create();
    }
}
