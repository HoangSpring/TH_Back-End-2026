<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Biến đổi dữ liệu danh mục thành mảng JSON
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,

            // Chỉ hiển thị posts_count nếu thuộc tính này có tồn tại trong query (ví dụ khi dùng withCount)
            'posts_count' => $this->when(
                isset($this->posts_count),
                $this->posts_count
            ),
        ];
    }
}