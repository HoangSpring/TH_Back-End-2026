<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Dọn dẹp dữ liệu thử nghiệm cũ để tránh lỗi trùng lặp dữ liệu
        User::where('email', 'like', '%@test.com')->delete();

        // 2. Tạo tài khoản QUẢN TRỊ VIÊN (ADMIN)
        $admin = User::factory()->create([
            'name' => 'Admin Lê',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 3. Tạo tài khoản BIÊN TẬP VIÊN (EDITOR)
        $editor = User::factory()->create([
            'name' => 'Editor Phạm',
            'email' => 'editor@test.com',
            'password' => bcrypt('password'),
            'role' => 'editor',
        ]);

        // 4. Tạo tài khoản NGƯỜI DÙNG THƯỜNG (USER - ALICE)
        $alice = User::factory()->create([
            'name' => 'Alice Nguyễn',
            'email' => 'alice@test.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 5. Tạo 3 bài viết giả lập thuộc về quyền sở hữu của riêng Alice
        Post::factory()->count(3)->create([
            'user_id' => $alice->id
        ]);
    }
}