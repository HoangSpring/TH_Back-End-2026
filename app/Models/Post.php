<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes; // Kích hoạt cả Factory và Xóa mềm

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'view_count' => 'integer',
    ];

    // ── Local Scopes ────────────────────────────────

    // Scope: chỉ lấy bài đã xuất bản (Đã sửa lỗi đồng bộ thời gian)
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    // Scope: sắp xếp theo lượt xem nhiều nhất
    public function scopePopular(Builder $query): Builder
    {
        return $query->orderByDesc('view_count');
    }

    // Scope: bài viết gần đây
    public function scopeRecent(Builder $query, int $days = 7): Builder
    {
        return $query->where('published_at', '>=', now()->subDays($days));
    }

    // Scope: lọc theo danh mục
    public function scopeOfCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    // Scope cũ từ Lab 1 (Giữ lại để không lỗi trang lọc theo Tag cũ)
    public function scopeByTagSlug($query, $slug)
    {
        return $query->whereHas('tags', function ($tagQuery) use ($slug) {
            $tagQuery->where('slug', $slug);
        });
    }

    // ── Accessor ────────────────────────────────────

    // Thời gian đọc ước tính - ĐÃ FIX LỖI CÚ PHÁP ĐỀ BÀI
    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: fn() => max(1, (int) ceil(str_word_count(strip_tags($this->content)) / 200)) . " phút đọc",
        );
    }

    // ── Relationships ────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }
}