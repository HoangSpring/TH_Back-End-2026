<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tạo 70 bài viết trạng thái published
        Post::factory()->published()->count(70)->create();

        // 2. Tạo 20 bài viết trạng thái draft
        Post::factory()->draft()->count(20)->create();

        // 3. Tạo 10 bài viết published nổi bật (view_count cao)
        Post::factory()->published()->count(10)->create([
            'view_count' => rand(10000, 50000),
        ]);

        // 4. Gán tags ngẫu nhiên cho tất cả posts vừa tạo vào bảng trung gian post_tag
        Post::all()->each(function ($post) {
            $tagIds = Tag::inRandomOrder()->limit(rand(1, 4))->pluck('id');
            $post->tags()->sync($tagIds);
        });
    }
}