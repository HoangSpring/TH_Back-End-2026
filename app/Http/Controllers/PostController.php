<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Giữ lại phục vụ cho hàm authorize() thủ công

class PostController extends Controller
{
    use AuthorizesRequests; // Kích hoạt trait để sử dụng phương thức check quyền thủ công ngoài Resource

    /**
     * 1. Hiển thị danh sách bài viết kết hợp bộ lọc tìm kiếm nâng cao
     */
    public function index(Request $request)
    {
        // 🛡️ BẢO MẬT: Được tự động kiểm tra bởi Middleware 'can:viewAny' từ file Route
        $posts = Post::query()
            ->published()
            ->with(["author", "category", "tags"]) // 🌟 ĐÃ ĐỔI 'user' THÀNH 'author' ĐỂ FIX LỖI 500 WEB
            ->withCount("comments")

            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($q, $catId) {
                $q->ofCategory($catId);
            })
            ->when($request->sort === 'popular', function ($q) {
                $q->popular();
            }, function ($q) {
                $q->latest();
            })
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();
        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * 2. Hiển thị form tạo bài viết mới
     */
    public function create()
    {
        // 🛡️ BẢO MẬT: Được tự động kiểm tra bởi Middleware 'can:create' từ file Route
        return view('posts.create');
    }

    /**
     * 3. Lưu bài viết mới vào CSDL
     */
    public function store(StorePostRequest $request)
    {
        // 🛡️ BẢO MẬT: Được tự động kiểm tra bởi Middleware 'can:create' từ file Route
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']) . '-' . time();
        $data['user_id'] = Auth::id();
        $data['category_id'] = 1;
        $data['status'] = 'published';
        $data['published_at'] = now();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Đã thêm bài viết mới thành công.');
    }

    /**
     * 4. Hiển thị chi tiết một bài viết
     */
    public function show(Post $post)
    {
        // 🛡️ BẢO MẬT: Được tự động kiểm tra bởi Middleware 'can:view' từ file Route
        // 🌟 ĐÃ ĐỔI 'user:id,name' THÀNH 'author:id,name'
        $post->loadCount('comments')->load(['author:id,name', 'comments.user', 'tags']);

        return view('posts.show', compact('post'));
    }

    /**
     * 5. Hiển thị form chỉnh sửa bài viết
     */
    public function edit(Post $post)
    {
        // 🛡️ BẢO MẬT: Được tự động kiểm tra bởi Middleware 'can:update' từ file Route
        return view('posts.edit', compact('post'));
    }

    /**
     * 6. Cập nhật dữ liệu bài viết
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // 🛡️ BẢO MẬT: Được tự động kiểm tra bởi Middleware 'can:update' từ file Route
        $data = $request->validated();

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . time();
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Đã cập nhật bài viết thành công.');
    }

    /**
     * 7. Xóa bài viết khỏi hệ thống (Xóa mềm - Soft Delete)
     */
    public function destroy(Post $post)
    {
        // 🛡️ BẢO MẬT: Được tự động kiểm tra bởi Middleware 'can:delete' từ file Route
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Đã chuyển bài viết vào thùng rác thành công.');
    }

    // =========================================================================
    // 📂 CÁC METHOD NGOÀI RESOURCE (KIỂM TRA POLICY THỦ CÔNG BẰNG HÀM AUTHORIZE)
    // =========================================================================

    public function trashed()
    {
        $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('posts.trashed', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        // Với các phương thức nằm ngoài Resource, ta check Policy thủ công bằng hàm authorize():
        $this->authorize('restore', $post);

        $post->status = 'published';
        $post->published_at = now();
        $post->restore();

        return redirect()->route('posts.trashed')->with('success', 'Đã khôi phục bài viết thành công.');
    }

    public function tagIndex($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        // 🌟 ĐÃ ĐỔI 'user:id,name' THÀNH 'author:id,name'
        $posts = Post::published()->byTagSlug($slug)->with(['author:id,name', 'category:id,name', 'tags:id,name'])->withCount('comments')->latest()->paginate(8);
        return view('posts.tag_index', compact('posts', 'tag'));
    }
}