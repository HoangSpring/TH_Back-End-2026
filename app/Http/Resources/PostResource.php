<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug ?? null,
            'body' => $this->body,
            'status' => $this->status,

            // 🎯 ĐÂY LÀ TRỌNG TÂM: So sánh ID tài khoản đang gọi API với user_id của bài viết
            // Nếu khớp sẽ trả về true, lệch trả về false. Frontend sẽ dựa vào đây để ẩn/hiện nút Sửa/Xóa.
            'is_author' => $request->user()?->id === $this->user_id,

            // Chuyển đổi dữ liệu lồng nhau (Nested) an toàn chống lỗi N+1 Query
            'category' => new CategoryResource($this->whenLoaded('category')),
            'author' => new UserResource($this->whenLoaded('author')),

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}