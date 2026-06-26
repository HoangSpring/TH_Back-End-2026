<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory; // 🌟 Import model mới vào đây
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(3); // Tạo tên sản phẩm ngẫu nhiên

        return [
            // 🌟 Bốc ngẫu nhiên ID từ bảng danh mục sản phẩm mới
            'product_category_id' => ProductCategory::inRandomOrder()->first()->id ?? 1,
            'name' => $name,
            'slug' => Str::slug($name) . '-' . time(),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 150000, 2000000), // Giá từ 150k đến 2 triệu
            'stock' => $this->faker->numberBetween(5, 100),
            'image' => 'https://picsum.photos/600/400',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}