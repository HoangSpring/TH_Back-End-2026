<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết tới bảng posts, nếu bài viết bị xóa thì comment tự xóa theo
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            // Khóa ngoại liên kết tới bảng users, nếu user bị xóa thì comment tự xóa theo
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('body');
            $table->boolean('is_approved')->default(false); // Trạng thái duyệt bình luận
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};