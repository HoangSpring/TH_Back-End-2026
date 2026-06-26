<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        $comments = [
            'Bài viết rất hay và hữu ích, cảm ơn tác giả!',
            'Mình đã áp dụng thử và thành công, bài viết rất chi tiết.',
            'Bạn có thể giải thích rõ hơn đoạn này được không?',
            'Rất mong chờ những bài viết tiếp theo của blog.',
            'Nội dung khá sâu sắc, đúng thứ mình đang tìm kiếm.',
            'Tuyệt vời quá, mình sẽ share cho bạn bè cùng đọc.',
            'Góc nhìn rất thực tế, hy vọng bạn ra thêm nhiều bài tương tự.',
            'Đọc bài này xong mình vỡ ra được nhiều điều.',
            'Cho mình xin thêm tài liệu tham khảo với nhé!',
            'Tuyệt vời! Chúc blog ngày càng phát triển.'
        ];

        return [
            'body' => $this->faker->randomElement($comments),
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'post_id' => Post::inRandomOrder()->first()->id ?? 1,
            'is_approved' => $this->faker->boolean(80), // 80% được duyệt
        ];
    }
}