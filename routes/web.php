<?php

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

// 2. BỔ SUNG RESOURCE ROUTE CHO POSTS (Lab Layout) Ở ĐÂY
Route::resource('posts', PostController::class);