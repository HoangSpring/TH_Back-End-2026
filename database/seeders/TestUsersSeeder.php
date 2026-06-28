<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User 1: Alice Nguyễn (Tác giả sở hữu bài viết)
        $alice = User::factory()->create([
            'name' => 'Alice Nguyễn',
            'email' => 'alice@test.com',
            'password' => bcrypt('password'),
        ]);

        // User 2: Bob Trần (Người dùng thường, không phải tác giả)
        $bob = User::factory()->create([
            'name' => 'Bob Trần',
            'email' => 'bob@test.com',
            'password' => bcrypt('password'),
        ]);

        // Tạo 3 bài viết mẫu xuất bản dưới quyền sở hữu của Alice
        Post::factory()->count(3)->create([
            'user_id' => $alice->id,
            'status' => 'published',
        ]);
    }
}