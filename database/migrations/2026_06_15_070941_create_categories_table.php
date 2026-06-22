<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations. (Hàm up - Xây dựng cấu trúc bảng)
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();                                 // 1. Cột id (Khóa chính tự tăng)
            $table->string('name');                       // 2. Cột name (Kiểu chuỗi)
            $table->string('slug')->unique();             // 3. Cột slug (Chuỗi định danh, không trùng lặp)
            $table->boolean('is_active')->default(true);  // 4. Cột is_active (Mặc định là true)
            $table->timestamps();                         // 5 & 6. Tạo ra created_at và updated_at
        });
    }

    /**
     * Reverse the migrations. (Hàm down - Phá hủy bảng khi Rollback)
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};