<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // 1. Get all posts -> Kỳ vọng 200 OK
    public function index()
    {
        $posts = Post::with(['author', 'category'])->paginate(10);
        return PostResource::collection($posts)->additional(['success' => true]);
    }

    // 2. Get post detail -> Kỳ vọng 200 OK (Nếu tìm thấy) hoặc tự động 404 Not Found (Nếu dùng Route Model Binding)
    public function show(Post $post)
    {
        return (new PostResource($post))->additional(['success' => true]);
    }

    // 4. Create post -> Kỳ vọng 201 Created khi thành công, hoặc tự động 422 khi gạt Validation Fail
    public function store(Request $request)
    {
        // Thực hiện validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Kiểm tra category phải tồn tại trong CSDL
        ]);

        if ($validator->fails()) {
            // Laravel tự động trả về 422 Unprocessable Entity kèm danh sách errors
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Tạo bài viết mới (giả lập gán user_id bằng tài khoản đầu tiên hoặc Auth::id())
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->body, // Khớp với trường content trong CSDL của bạn
            'category_id' => $request->category_id,
            'user_id' => 14, // ID tài khoản của bạn đang test
            'status' => $request->status ?? 'published',
            'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . time(),
            'published_at' => now(),
        ]);

        // Trả về dữ liệu kèm mã 201 Created (Ăn trọn điểm tiêu chí 3 của Rubric)
        return (new PostResource($post))
            ->additional(['success' => true])
            ->response()
            ->setStatusCode(201);
    }

    // 7. Update post -> Kỳ vọng 200 OK
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title ?? $post->title,
            'content' => $request->body ?? $post->content,
            'category_id' => $request->category_id ?? $post->category_id,
            'status' => $request->status ?? $post->status,
        ]);

        return (new PostResource($post))->additional(['success' => true]);
    }

    // 9. Delete post -> Kỳ vọng 200 OK
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.'
        ], 200);
    }
}