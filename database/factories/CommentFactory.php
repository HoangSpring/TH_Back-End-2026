<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'body' => $this->faker->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'post_id' => Post::inRandomOrder()->first()->id ?? 1,
            'is_approved' => $this->faker->boolean(80), // 80% được duyệt
        ];
    }
}