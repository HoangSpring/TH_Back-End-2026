<?php

namespace App\Http\Controllers;

// Import đầy đủ các class Request cần thiết
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * 1. Hiển thị danh sách bài viết (Kèm phân trang)
     */
    public function index(): View
    {
        $posts = Post::latest()->paginate(10);
        $totalPosts = $posts->total();

        return view('posts.index', compact('posts', 'totalPosts'));
    }

    /**
     * 2. Giao diện form tạo mới bài viết
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * 3. Xử lý lưu bài viết mới (Áp dụng PRG Pattern)
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        // Tạo bài viết với dữ liệu đã qua kiểm duyệt an toàn
        $post = Post::create($request->validated() + ['user_id' => 1]);

        // Chuyển hướng sang trang chi tiết (show) kèm Flash Message có tên bài viết
        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Tạo bài viết "' . $post->title . '" thành công!');
    }

    /**
     * 4. Xem chi tiết bài viết (Sử dụng Route Model Binding)
     */
    public function show(Post $post): View
    {
        return view('posts.show', compact('post'));
    }

    /**
     * 5. Giao diện form chỉnh sửa bài viết
     */
    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * 6. Xử lý cập nhật thông tin bài viết
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        // Cập nhật dữ liệu sạch
        $post->update($request->validated());

        // Chuyển hướng sang trang chi tiết (show) để kiểm tra kết quả vừa sửa
        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * 7. Xóa bài viết khỏi hệ thống
     */
    public function destroy(Post $post): RedirectResponse
    {
        // ✅ Lưu lại tiêu đề TRƯỚC KHI xóa để đưa vào thông báo Flash
        $title = $post->title;

        $post->delete();

        // Quay lại danh sách và thông báo rõ bài nào vừa bị xóa
        return redirect()
            ->route('posts.index')
            ->with('success', 'Đã xóa bài viết: "' . $title . '"');
    }
}