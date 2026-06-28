<?php

// File: routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\PostController;

/*
|--------------------------------------------------------------------------
| API Version 1 Routes
|--------------------------------------------------------------------------
| Toàn bộ các routes dưới đây mặc định đã được Laravel gắn tiền tố '/api'.
| Ta gom nhóm (Group) và bổ sung thêm prefix 'v1' cùng name 'api.v1.'
*/

Route::prefix('v1')->name('api.v1.')->group(function () {

    // Sử dụng apiResource() để tự động ánh xạ bộ 5 endpoints của Lab 1:
    // index, store, show, update, destroy
    Route::apiResource('posts', PostController::class);

});