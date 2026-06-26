<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proCategories = [
            ['name' => 'Giày thể thao', 'slug' => 'giay-the-thao'],
            ['name' => 'Áo khoác hoodie', 'slug' => 'ao-khoac-hoodie'],
            ['name' => 'Quần jogger', 'slug' => 'quan-jogger'],
            ['name' => 'Balo & Phụ kiện', 'slug' => 'balo-phu-kien'],
        ];

        foreach ($proCategories as $cat) {
            \App\Models\ProductCategory::create($cat);
        }
    }
}
