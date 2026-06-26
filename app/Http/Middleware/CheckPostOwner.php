<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPostOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy bài viết hoặc tham số từ URL
        $post = $request->route('post');

        // Phòng trường hợp Laravel nhận diện dạng ID (số) thay vì Model Object
        if (is_numeric($post)) {
            $post = Post::find($post);
        }

        // Nếu đi vào các trang Sửa/Xóa mà không tìm thấy bài viết này trong DB -> Trả về 404
        if (!$post instanceof Post) {
            abort(404, 'Bài viết không tồn tại.');
        }

        // Kiểm tra: Nếu ID người đang đăng nhập KHÁC với user_id của bài viết
        if (Auth::id() !== $post->user_id) {
            // Chặn lại lập tức và báo lỗi 403 (Không có quyền)
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }

        return $next($request); // Nếu đúng chủ bài viết, cho phép đi tiếp
    }
}