<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Models\Post;    // Map class vào Policy
use App\Models\Product; // Map class vào Policy
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. CÁC ROUTE CÔNG KHAI (PUBLIC ROUTES)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| 2. CÁC ROUTE BẮT BUỘC ĐĂNG NHẬP (PROTECTED ROUTES)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // --- Quản lý tài khoản cá nhân ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =========================================================================
    // PHÂN HỆ: BÀI VIẾT (POSTS) - BẢO MẬT BẰNG POLICY
    // =========================================================================
    // Sử dụng 'can:create,' . Post::class để kiểm tra quyền tạo bài viết
    Route::get('/posts/create', [PostController::class, 'create'])->middleware('can:create,' . Post::class)->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->middleware('can:create,' . Post::class)->name('posts.store');

    Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::post('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');

    // Kiểm tra quyền sửa/xóa dựa trên tham số {post} đồng bộ với PostPolicy
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('can:update,post')->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('can:update,post')->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('can:delete,post')->name('posts.destroy');


    // =========================================================================
    // PHÂN HỆ: CỬA HÀNG / SẢN PHẨM (PRODUCTS) - BẢO MẬT BẰNG POLICY
    // =========================================================================
    // Kiểm tra quyền tạo sản phẩm mới dựa trên ProductPolicy
    Route::get('/products/create', [ProductController::class, 'create'])->middleware('can:create,' . Product::class)->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->middleware('can:create,' . Product::class)->name('products.store');

    Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');

    // Kiểm tra quyền sửa/xóa dựa trên tham số {product} đồng bộ với ProductPolicy
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('can:update,product')->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('can:update,product')->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('can:delete,product')->name('products.destroy');
});

/*
|--------------------------------------------------------------------------
| 3. CÁC ROUTE CÔNG KHAI ĐẶT DƯỚI CÙNG (PUBLIC ROUTES AT THE END)
|--------------------------------------------------------------------------
*/

// 🌟 ĐÃ SỬA: Loại bỏ mảng middleware 'can:viewAny' và 'can:view' gán cứng ở route.
// Việc cho phép Guest vào xem danh sách/chi tiết, hoặc ẩn bài Draft đã được xử lý tự động gọn gàng bên trong Policy rồi.
Route::resource('posts', PostController::class)->only(['index', 'show']);

// 🏷️ Đường dẫn lọc bài viết theo tag
Route::get('/tags/{slug}', [PostController::class, 'tagIndex'])->name('tags.index');

// 🌟 ĐÃ SỬA: Áp dụng tương tự cho Resource của Sản phẩm công khai
Route::resource('products', ProductController::class)->only(['index', 'show']);


// Nạp các tuyến đường đăng ký/đăng nhập tự động từ file auth.php
require __DIR__ . '/auth.php';