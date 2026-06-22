<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(4, 8));

        return [
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title) . '-' . rand(1, 99999),
            'content' => implode("\n\n", $this->faker->paragraphs(rand(3, 6))),
            'excerpt' => $this->faker->text(150),
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'status' => $this->faker->randomElement(['draft', 'published', 'published', 'published']),


            'view_count' => $this->faker->numberBetween(0, 5000),

            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function published(): static
    {
        return $this->state(fn(array $attr) => [
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn(array $attr) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}