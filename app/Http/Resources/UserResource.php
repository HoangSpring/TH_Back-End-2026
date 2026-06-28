<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            // 🔥 BẢO MẬT: Tuyệt đối KHÔNG viết trường 'password' ở đây!
            // Chỉ hiển thị email nếu user đang đăng nhập chính là chủ tài khoản này
            'email' => $this->when(
                $request->user()?->id === $this->id,
                $this->email
            ),
        ];
    }
}