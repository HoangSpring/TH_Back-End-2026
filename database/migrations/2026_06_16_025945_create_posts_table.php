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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');

            // ✅ Đã sửa: Xóa dòng lỗi $table->text('') và giữ lại excerpt chuẩn hóa
            $table->string('excerpt', 255)->nullable();

            // ✅ Thêm mốc thời gian đăng bài phục vụ scopePublished() hoạt động đúng đề bài
            $table->timestamp('published_at')->nullable();

            $table->string('status')->default('draft');
            $table->timestamps();
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