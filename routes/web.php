<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PostController;

// 1. Route Trang chủ
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 2. Route Giới thiệu
Route::get('/about', function () {
    return view('about');
})->name('about');

// 3. Route Liên hệ
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Nhóm các routes có chung tiền tố /shop
Route::prefix('shop')->group(function () {
    // 4. Route sản phẩm 
    Route::get('/products', function () {
        return view('shop.products');
    })->name('shop.products');

    // 5. Route giỏ hàng
    Route::get('/cart', function () {
        return view('shop.cart');
    })->name('shop.cart');
});

// Resource Route cho Articles (Lab 2)
Route::resource('articles', ArticleController::class);


// =========================================================================
// 📂 NHÓM ROUTE POSTS & TAGS (ĐÃ SẮP XẾP THỨ TỰ ƯU TIÊN CHUẨN)
// =========================================================================

// Đặt Route Thùng Rác lên trước Resource (Bắt buộc)
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');

// Route Khôi phục dữ liệu từ Thùng rác
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

// ✅ ĐƯA ROUTE TAG LÊN TRÊN RESOURCE: Đảm bảo đường dẫn độc lập không bị tranh chấp
Route::get('tags/{slug}', [PostController::class, 'tagIndex'])->name('tags.index');

// Resource Route của Post đặt ở cuối cùng của nhóm
Route::resource('posts', PostController::class);