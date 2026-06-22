<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * 🌟 1. CẬP NHẬT (LAB 2): Hiển thị danh sách bài viết kết hợp bộ lọc tìm kiếm nâng cao (when)
     */
    public function index(Request $request)
    {
        $posts = Post::query()
            ->published()                          // Gọi Local Scope lọc bài đã đăng và đúng mốc thời gian
            ->with(["user", "category", "tags"])   // Eager loading tối ưu chống lỗi N+1
            ->withCount("comments")                // Tích hợp comments_count vào danh sách

            // Bộ lọc 1: Tìm kiếm theo từ khóa tiêu đề (Nếu có truyền params ?search=...)
            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })

            // Bộ lọc 2: Lọc theo danh mục bài viết (Nếu có truyền params ?category_id=...)
            ->when($request->category_id, function ($q, $catId) {
                $q->ofCategory($catId);            // Sử dụng Scope truyền tham số
            })

            // Bộ lọc 3: Sắp xếp dữ liệu (Nếu ?sort=popular xếp theo lượt xem, ngược lại xếp mới nhất)
            ->when($request->sort === 'popular', function ($q) {
                $q->popular();                     // Sử dụng scopePopular() sắp xếp theo view_count
            }, function ($q) {
                $q->orderByDesc('published_at');   // Default: Bài viết mới nhất
            })

            ->paginate(10)
            ->withQueryString();                   // Giữ lại các tham số lọc trên URL khi bấm chuyển trang

        // Lấy thêm toàn bộ danh mục để truyền xuống đổ vào thanh Dropdown Filter của View
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * 2. Hiển thị form tạo bài viết mới
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * 3. Lưu bài viết mới vào CSDL
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);

        $data['user_id'] = 1;
        $data['category_id'] = 1;

        Post::create($data);

        return redirect()->route('posts.index')
            ->with('success', 'Đã thêm bài viết mới thành công.');
    }

    /**
     * 4. Hiển thị chi tiết một bài viết
     */
    public function show($id)
    {

        $post = Post::with(['user:id,name', 'comments.user', 'tags'])
            ->withCount('comments')
            ->findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * 5. Hiển thị form chỉnh sửa bài viết
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * 6. Cập nhật dữ liệu bài viết
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'Đã cập nhật bài viết thành công.');
    }

    /**
     * 7. Xóa bài viết khỏi hệ thống (Xóa mềm)
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Đã chuyển bài viết vào thùng rác thành công.');
    }

    // =========================================================================
    // 📂 CÁC METHOD PHỤC VỤ THÙNG RÁC - SOFT DELETE 
    // =========================================================================

    /**
     * 8. Giao diện Thùng rác
     */
    public function trashed()
    {
        $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);

        return view('posts.trashed', compact('posts'));
    }

    /**
     * 9. Khôi phục bài viết từ thùng rác
     */
    public function restore($id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('posts.trashed')
            ->with('success', 'Đã khôi phục bài viết thành công về danh sách.');
    }

    // =========================================================================
    // 📂 PHẦN LIỆT KÊ BÀI VIẾT THEO THẺ TAG
    // =========================================================================

    /**
     * 10. Trang danh sách lọc bài viết theo từng Tag cụ thể thông qua Scope
     */
    public function tagIndex($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = Post::select('id', 'user_id', 'category_id', 'title', 'slug', 'content', 'status', 'created_at')
            ->published()
            ->byTagSlug($slug)
            ->with([
                'user:id,name',
                'category:id,name',
                'tags:id,name'
            ])
            ->withCount('comments')
            ->latest()
            ->paginate(8);

        return view('posts.tag_index', compact('posts', 'tag'));
    }
}