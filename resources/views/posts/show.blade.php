@extends('layouts.app')
@section('title', $post->title)
@section('content')

    {{-- Breadcrumb điều hướng --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Trang chủ</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('posts.index') }}">Bài viết</a>
            </li>
            <li class="breadcrumb-item active">{{ Str::limit($post->title, 40) }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h1 class="h2 mb-3">{{$post->title}}</h1>
                    {{-- Meta thông tin --}}
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                        <span class="text-muted">👤 {{ $post->author }}</span>
                        <span class="text-muted">📅 {{ $post->created_at->format('d/m/Y H:i')  }}</span>
                        <x-badge :status="$post->status"></x-badge>
                    </div>
                    {{-- Nội dung --}}
                    <div class="post-content" style="line-height: 1.8; font-size: 1.05rem;">
                        {{ $post->content }}
                    </div>
                </div>
            </div>

            {{-- Nút điều hướng dưới --}}
            <div class="d-flex justify-content-between mb-4">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">&larr; Quay lại danh sách</a>
                <div class="d-flex gap-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">✏ Sửa bài</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">🗑 Xóa</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar bên phải --}}
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light"><strong>📋 Thông tin bài viết</strong></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ $post->id }}</li>
                    <li class="list-group-item"><strong>Tác giả:</strong> {{ $post->author }}</li>
                    <li class="list-group-item">
                        <strong>Ngày đăng:</strong><br>
                        {{ $post->created_at->format('d/m/Y') }} ({{ $post->created_at->diffForHumans() }})
                    </li>
                    <li class="list-group-item">
                        <strong>Trạng thái:</strong>
                        @if ($post->status === 'published')
                            <span class="text-success fw-bold">Đã xuất bản</span>
                        @else
                            <span class="text-warning fw-bold">Bản nháp</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection