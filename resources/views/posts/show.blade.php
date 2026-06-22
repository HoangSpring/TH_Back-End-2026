@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mt-4">
        {{-- Chi tiết bài viết --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h1 class="h2 mb-2">{{ $post->title }}</h1>

                <div class="text-muted mb-3">
                    👤 Tác giả: <strong>{{ $post->user->name ?? 'Ẩn danh' }}</strong> &nbsp;·&nbsp;
                    📅 {{ $post->created_at->format('d/m/Y H:i') }}
                </div>

                {{-- HIỂN THỊ TẤT CẢ TAG CÓ LINK DẪN ĐẾN TRANG TAG --}}
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
                <div class="post-content fs-5" style="line-height: 1.8;">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>

        {{-- HIỂN THỊ DANH SÁCH COMMENT KÈM TÊN TÁC GIẢ VÀ THỜI GIAN ĐĂNG --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">💬 Bình luận ({{ $post->comments_count }})</h5>
            </div>
            <div class="card-body">
                @forelse($post->approvedComments as $comment)
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

        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">⬅ Quay lại danh sách</a>
    </div>
@endsection