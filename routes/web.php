<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController; // 🌟 THÊM MỚI CONTROLLER SẢN PHẨM
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
    // PHÂN HỆ: BÀI VIẾT (POSTS)
    // =========================================================================
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::post('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');

    Route::middleware(['post.owner'])->group(function () {
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    // =========================================================================
    // PHÂN HỆ: CỬA HÀNG / SẢN PHẨM (PRODUCTS) 🌟 (THÊM MỚI VÀO ĐÂY)
    // =========================================================================
    // Các tuyến đường tĩnh đặt TRÊN để không bị tham số biến {product} chặn mất
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Tuyến đường Thùng rác và Khôi phục sản phẩm
    Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');

    // Các tuyến đường sửa/xóa (Đặt dưới cùng của nhóm auth)
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

/*
|--------------------------------------------------------------------------
| 3. CÁC ROUTE CÔNG KHAI ĐẶT DƯỚI CÙNG (PUBLIC ROUTES AT THE END)
|--------------------------------------------------------------------------
| Đặt sau cùng để tránh việc tham số biến {post} và {product} nuốt mất các URL tĩnh
*/

// Sinh ra: GET /posts (index) và GET /posts/{post} (show)
Route::resource('posts', PostController::class)->only(['index', 'show']);

// 🏷️ Đường dẫn lọc bài viết theo tag
Route::get('/tags/{slug}', [PostController::class, 'index'])->name('tags.index');


// 🌟 THÊM MỚI: Sinh ra tuyến đường công khai xem danh sách và chi tiết sản phẩm
// Sinh ra: GET /products (index) và GET /products/{product} (show)
Route::resource('products', ProductController::class)->only(['index', 'show']);


// Nạp các tuyến đường đăng ký/đăng nhập tự động từ file auth.php
require __DIR__ . '/auth.php';