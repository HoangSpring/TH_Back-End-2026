<?php

namespace App\Http\Controllers;

// Đã import Form Request mới thay thế cho Request mặc định
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    // 1. Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        $totalPosts = $posts->total();
        return view('posts.index', compact('posts', 'totalPosts'));
    }

    // 2. Form tạo mới
    public function create()
    {
        return view('posts.create');
    }

    // 3. Xử lý lưu (Sử dụng StorePostRequest gọn gàng)
    public function store(StorePostRequest $request)
    {
        // Mass-assignment an toàn tuyệt đối với dữ liệu đã được validate
        Post::create($request->validated() + ['user_id' => 1]);

        return redirect()->route('posts.index')
            ->with('success', 'Tạo bài viết thành công!');
    }

    // 4. Xem chi tiết
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5. Form chỉnh sửa
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 6. Xử lý cập nhật (Sử dụng UpdatePostRequest)
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('posts.edit', $post)
            ->with('success', 'Cập nhật bài viết thành công!');
    }

    // 7. Xóa bài viết
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Đã xóa bài viết.');
    }
}