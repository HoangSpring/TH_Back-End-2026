<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 🌟 Bắt buộc phải thêm trường này vào fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================================================================
    // HELPER METHODS - ĐƯỢC DÙNG TRONG POLICY VÀ GIAO DIỆN BLADE
    // =========================================================================

    /**
     * Kiểm tra xem user có phải là Admin tối cao hay không
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Kiểm tra xem user có quyền từ Editor trở lên hay không (Admin bao gồm cả Editor)
     */
    public function isEditor(): bool
    {
        return in_array($this->role, ['admin', 'editor']);
    }

    /**
     * Kiểm tra xem thực thể Bài viết có thuộc quyền sở hữu của User này hay không
     */
    public function owns(Post $post): bool
    {
        return $this->id === $post->user_id;
    }
}