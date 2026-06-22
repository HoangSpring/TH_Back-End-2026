<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo admin account cố định
        \App\Models\User::create([
            'name' => 'Admin Blog',
            'email' => 'admin@phu-xuan-blog.test',
            'password' => bcrypt('password'),
        ]);

        // Tạo 9 user ngẫu nhiên 
        \App\Models\User::factory()->count(9)->create();
    }
}