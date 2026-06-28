@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mt-4">
        {{-- =========================================================================
        1. KHỐI CHI TIẾT BÀI VIẾT (POST DETAILS)
        ========================================================================= --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h1 class="h2 mb-2">{{ $post->title }}</h1>

                <div class="text-muted mb-3">
                    {{-- 🌟 ĐÃ ĐỔI TỪ $post->user->name THÀNH $post->author->name ĐỂ KHÔNG BỊ LỖI TRANG --}}
                    👤 Tác giả: <strong>{{ $post->author->name ?? 'Ẩn danh' }}</strong> &nbsp;·&nbsp;
                    📅 {{ $post->created_at->format('d/m/Y H:i') }}
                </div>

                {{-- HIỂN THỊ DANH SÁCH THẺ TAGS --}}
                <div class="mb-4">
                    @forelse($post->tags as $tag)
                        <a href="{{ route('tags.index', $tag->slug) }}" class="badge bg-secondary text-decoration-none me-1"
                            style="font-size: 0.85rem; font-weight: 500;">
                            🏷️ {{ $tag->name }}
                        </a>
                    @empty
                        <span class="text-muted small">Chưa có thẻ tag nào cho bài viết này.</span>
                    @endforelse
                </div>

                <hr>
                <div class="post-content fs-5 mb-4" style="line-height: 1.8;">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <hr>

                {{-- =========================================================================
                2. KHỐI QUẢN LÝ HÀNH ĐỘNG (SỬA LỖI ĐIỀU KIỆN ẨN/HIỆN NÚT THEO ĐÚNG POLICY)
                ========================================================================= --}}
                <div class="post-actions mt-3">

                    {{-- ✏️ NÚT SỬA BÀI VIẾT: Chỉ hiển thị khi User hiện tại có quyền sửa (là Tác giả / Editor / Admin) --}}
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm me-2 fw-bold text-dark">
                            ✏️ Chỉnh sửa bài viết
                        </a>
                    @endcan

                    {{-- 🗑️ NÚT XÓA BÀI VIẾT: Chỉ hiển thị khi User hiện tại có quyền xóa bài viết này --}}
                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn chắc chắn muốn xóa bài viết này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm fw-bold">
                                🗑️ Xóa bài viết
                            </button>
                        </form>
                    @endcan

                </div>
            </div>
        </div>

        {{-- =========================================================================
        3. KHỐI BÌNH LUẬN (COMMENTS SECTION)
        ========================================================================= --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">💬 Bình luận ({{ $post->comments_count ?? 0 }})</h5>
            </div>
            <div class="card-body">
                @forelse($post->approvedComments ?? [] as $comment)
                    <div class="p-3 mb-2 bg-light rounded border-start border-primary border-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="text-dark">👤 {{ $comment->user->name ?? 'Người dùng ẩn danh' }}</strong>
                            <small class="text-muted">🕒 {{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-0 text-secondary mt-1" style="font-size: 0.95rem;">
                            {{ $comment->body }}
                        </p>
                    </div>
                @empty
                    <p class="text-muted text-center py-3 mb-0">Chưa có bình luận nào được phê duyệt cho bài viết này.</p>
                @endforelse
            </div>
        </div>

        {{-- NÚT QUAY LẠI HỆ THỐNG --}}
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">⬅ Quay lại danh sách</a>
    </div>
@endsection