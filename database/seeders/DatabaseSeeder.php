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
        // =========================================================================
        // PART 1: PHÂN HỆ BÀI VIẾT VÀ TÀI KHOẢN (GIỮ NGUYÊN CODE CŨ CỦA BẠN)
        // =========================================================================

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


        // =========================================================================
        // PART 2: PHÂN HỆ CỬA HÀNG / SẢN PHẨM (🌟 THÊM MỚI VÀO ĐÂY)
        // =========================================================================

        // 6. Tạo danh mục sản phẩm trước (Để sản phẩm có product_category_id để liên kết)
        $this->call(ProductCategorySeeder::class);

        // 7. Sinh ngẫu nhiên 100 sản phẩm mẫu (Bốc ngẫu nhiên id từ ProductCategorySeeder)
        $this->call(ProductSeeder::class);
    }
}