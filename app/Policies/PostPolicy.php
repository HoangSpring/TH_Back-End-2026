<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * before() – Chạy TRƯỚC MỌI phương thức kiểm tra khác trong Policy này.
     * * - Return true  → Cho phép thực hiện hành động ngay lập tức (Admin bypass)
     * - Return null  → Bỏ qua, tiếp tục chuyển xuống các hàm tương ứng bên dưới để check tiếp
     * - LƯU Ý: Tuyệt đối không return false ở đây vì sẽ chặn đứng luôn cả Admin.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true; // Admin bypass toàn bộ hệ thống -> Không cần chạy các hàm dưới
        }

        return null; // Không phải admin -> Tiếp tục chuyển xuống kiểm tra quyền của User/Editor
    }

    /**
     * 1. Quyền xem danh sách bài viết (Khách vãng lai và thành viên đều xem được)
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * 2. Quyền xem chi tiết bài viết (Bài công khai thì ai cũng xem, Bài nháp chỉ tác giả xem được)
     */
    public function view(?User $user, Post $post): bool
    {
        if ($post->status === 'published') {
            return true;
        }

        // Nếu là bài nháp, kiểm tra xem user đăng nhập có trùng id tác giả không
        return $user?->id === $post->user_id;
    }

    /**
     * 3. Quyền hiển thị form tạo bài viết (Bắt buộc phải đăng nhập)
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * 4. Quyền lưu bài viết mới vào CSDL (Bắt buộc phải đăng nhập)
     */
    public function store(User $user): bool
    {
        return true;
    }

    /**
     * 5. Quyền chỉnh sửa bài viết (Editor sửa được tất cả bài, User thường chỉ sửa được bài của mình)
     */
    public function update(User $user, Post $post): bool
    {
        if ($user->isEditor()) {
            return true; // Editor có đặc quyền sửa bất cứ bài viết nào
        }

        return $user->owns($post); // User thường: Chỉ bài của chính mình tạo ra
    }

    /**
     * 6. Quyền xóa bài viết (Chỉ chính chủ sở hữu - Riêng Admin đã được cho qua tự động tại before())
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->owns($post); // Editor không có quyền xóa bài của người khác, chỉ xóa được bài của mình
    }
}