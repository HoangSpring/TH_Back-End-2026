<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use App\Policies\PostPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. 🎨 Cấu hình định dạng phân trang bằng Bootstrap 5 của bạn (Giữ nguyên)
        Paginator::useBootstrapFive();

        Gate::policy(Post::class, PostPolicy::class);

        // Gate 1: Kiểm tra quyền sửa bài viết
        Gate::define('update-post', function (User $user, Post $post) {
            // Sử dụng dấu "==" để tự động ép kiểu dữ liệu khi so sánh, tránh lỗi lệch type giữa int và string
            return $user->id == $post->user_id;
        });

        // Gate 2: Kiểm tra quyền xóa bài viết (Tác giả sở hữu HOẶC tài khoản có quyền Admin)
        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->id == $post->user_id || $user->is_admin;
        });
    }
}