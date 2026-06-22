<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'body', 'is_approved'];

    /**
     Custom quan hệ: Một bình luận chỉ thuộc về một bài viết nhất định
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     Custom quan hệ: Một bình luận chỉ thuộc về một người dùng duy nhất
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}