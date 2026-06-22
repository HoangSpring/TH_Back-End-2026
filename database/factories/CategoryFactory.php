<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Công nghệ',
            'Lập trình',
            'Thiết kế',
            'Kinh doanh',
            'Du lịch',
            'Ẩm thực',
            'Sức khỏe',
            'Giáo dục',
            'Thể thao',
            'Giải trí',
            'Khoa học',
            'Văn hóa',
        ]);

        // CHỈ trả về name và slug (Đã xóa bỏ hoàn toàn dòng description gây lỗi)
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}