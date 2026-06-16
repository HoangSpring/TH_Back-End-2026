<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ĐÃ SỬA: Import Model Post để tương tác với Database thật
use App\Models\Post;

class PostController extends Controller
{
    // 1. Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        // ĐÃ SỬA: Tính toán tổng số bài viết để truyền sang View tránh lỗi Undefined variable
        $totalPosts = $posts->total();

        return view('posts.index', compact('posts', 'totalPosts'));
    }

    // 2. Hiển thị form tạo bài viết mới
    public function create()
    {
        return view('posts.create');
    }

    // 3. Xử lý lưu bài viết mới (Đã có Validation tiếng Việt)
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|string|min:5|max:255',
                'content' => 'required|string|min:10',
            ],
            [
                'title.required' => 'Tiêu đề bài viết không được để trống.',
                'title.min' => 'Tiêu đề phải có ít nhất :min ký tự.',
                'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',
                'content.required' => 'Nội dung bài viết không được để trống.',
                'content.min' => 'Nội dung phải có ít nhất :min ký tự.',
            ]
        );

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => 1, // Tạm thời giả lập user_id = 1
        ]);

        return redirect()->route('posts.index')
            ->with('success', 'Tạo bài viết thành công!');
    }

    // 4. Xem chi tiết bài viết
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5. Hiển thị form chỉnh sửa bài viết
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 6. Xử lý cập nhật bài viết (Đã có Validation tiếng Việt)
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate(
            [
                'title' => 'required|string|min:5|max:255',
                'content' => 'required|string|min:10',
            ],
            [
                'title.required' => 'Tiêu đề bài viết không được để trống.',
                'title.min' => 'Tiêu đề phải có ít nhất :min ký tự.',
                'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',
                'content.required' => 'Nội dung bài viết không được để trống.',
                'content.min' => 'Nội dung phải có ít nhất :min ký tự.',
            ]
        );

        $post->update($validated);

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