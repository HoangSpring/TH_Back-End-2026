<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kích hoạt Factory để tạo các danh mục dựa trên mảng có sẵn trong CategoryFactory
        Category::factory()->count(12)->create();
    }
}