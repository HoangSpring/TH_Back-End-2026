<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Cột id tự tăng
            $table->string('title'); // Cột tiêu đề bài viết
            $table->text('content'); // Cột nội dung bài viết
            $table->unsignedBigInteger('user_id')->default(1); // Giả lập user_id để liên kết dữ liệu
            $table->timestamps(); // Tạo 2 cột tự động: created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};