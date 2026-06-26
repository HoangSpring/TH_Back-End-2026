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
        // Danh sách các tiêu đề mẫu tiếng Việt
        $titles = [
            '10 mẹo học lập trình web hiệu quả cho người mới bắt đầu',
            'Sự khác biệt giữa Laravel và CodeIgniter là gì?',
            'Hướng dẫn xây dựng RESTful API với Laravel 11',
            'Tại sao PHP vẫn còn phổ biến trong năm nay?',
            'Cách tối ưu hóa hiệu suất cơ sở dữ liệu MySQL',
            'Tìm hiểu về Design Patterns trong PHP',
            'Làm thế nào để bảo mật ứng dụng web của bạn?',
            'Khám phá những tính năng mới nhất của Laravel 11',
            'Lộ trình trở thành Backend Developer chuyên nghiệp',
            'Chia sẻ kinh nghiệm phỏng vấn vị trí Web Developer',
        ];

        // Danh sách các đoạn văn mẫu tiếng Việt
        $paragraphs = [
            'Lập trình web đang là một trong những lĩnh vực hot nhất hiện nay với nhu cầu tuyển dụng cực kỳ cao. Nếu bạn đam mê công nghệ và muốn tự tay xây dựng những trang web tuyệt đẹp, đây chính là bài viết dành cho bạn.',
            'Framework Laravel mang đến cho lập trình viên một bộ công cụ mạnh mẽ và cú pháp thanh lịch, giúp việc phát triển các dự án web trở nên nhanh chóng và thú vị hơn bao giờ hết.',
            'Khi thiết kế cơ sở dữ liệu, điều quan trọng là phải đảm bảo tính chuẩn hóa nhằm giảm thiểu sự trùng lặp và cải thiện tính toàn vẹn của dữ liệu trong thời gian dài.',
            'Bảo mật luôn là vấn đề được ưu tiên hàng đầu. Một ứng dụng web tốt không chỉ cần chạy nhanh mà còn phải an toàn trước các cuộc tấn công phổ biến như SQL Injection hay XSS.',
            'Với cộng đồng hỗ trợ lớn mạnh và tài liệu phong phú, việc học lập trình PHP và Laravel ngày càng dễ dàng tiếp cận với tất cả mọi người.',
            'Việc áp dụng Design Pattern không chỉ giúp code trở nên dễ đọc, dễ bảo trì mà còn hỗ trợ làm việc nhóm hiệu quả hơn trong các dự án lớn.',
        ];

        $title = $this->faker->randomElement($titles) . ' ' . rand(1, 100);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . rand(100, 999),
            'content' => $this->faker->randomElement($paragraphs) . "\n\n" . $this->faker->randomElement($paragraphs) . "\n\n" . $this->faker->randomElement($paragraphs),
            'excerpt' => $this->faker->randomElement($paragraphs),
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