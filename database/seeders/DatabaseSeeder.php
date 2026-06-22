<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Chạy bảng độc lập trước (Users cần có trước để lấy user_id)
        $this->call(UserSeeder::class);

        // 2. Danh mục bài viết (Posts cần có category_id)
        $this->call(CategorySeeder::class);

        // 3. Thẻ gắn bài viết (Tạo tag sẵn để PostSeeder lấy id đi găm pivot)
        $this->call(TagSeeder::class);

        // 4. Bài viết (Nơi tổng hợp khóa ngoại từ User, Category và kết nối Tag)
        $this->call(PostSeeder::class);

        // 5. Bình luận bài viết (Cần nạp cuối cùng sau khi đã có bài viết chuẩn)
        $this->call(CommentSeeder::class);
    }
}