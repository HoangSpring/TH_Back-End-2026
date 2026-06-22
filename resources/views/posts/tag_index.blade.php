@extends('layouts.app')

@section('title', 'Thẻ tag: ' . $tag->name)

@section('content')
    <div class="container mt-3">
        <div class="mb-4">
            <h1 class="h3">🏷️ Chủ đề: <span class="text-primary">{{ $tag->name }}</span></h1>
            <p class="text-muted">Tìm thấy tổng cộng {{ $posts->total() }} bài viết liên quan</p>
        </div>

        @forelse ($posts as $post)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <span class="text-muted small">#{{ $loop->iteration }}</span>

                    <h5 class="card-title mt-1">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $post->title }}
                        </a>
                    </h5>

                    <p class="card-text text-muted">
                        {{ Str::limit($post->content, 120) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <small class="text-muted">
                            👤 Tác giả: <strong class="text-dark">{{ $post->user->name ?? 'Ẩn danh' }}</strong> &nbsp;·&nbsp;
                            📁 Danh mục: <span
                                class="badge bg-light text-dark border">{{ $post->category->name ?? 'Chưa rõ' }}</span>
                            &nbsp;·&nbsp;
                            💬 {{ $post->comments_count }} bình luận &nbsp;·&nbsp;
                            📅 {{ $post->created_at->diffForHumans() }}
                        </small>

                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary">👁 Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <p class="text-muted fs-5">📭 Chưa có bài viết nào thuộc thẻ tag này.</p>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại trang chủ</a>
            </div>
        @endforelse

        {{-- Hiển thị nút phân trang --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection