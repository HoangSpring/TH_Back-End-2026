@extends('layouts.app')

@section('title', 'Danh sách bài viết')

<x-alert type="success" :dismissible="true">
    <x-slot:title>Hệ thống thông báo!</x-slot:title>
    Bạn đã áp dụng thành công Anonymous Component và Named Slot của Bài Lab 3!
</x-alert>

@section('content')

    {{-- Header section: tiêu đề + thống kê --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">📰 Danh sách bài viết</h1>
            {{-- Hiển thị tổng số bài --}}
            <p class="text-muted mb-0">Tổng cộng {{ $totalPosts }} bài viết</p>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            ✏ Viết bài mới
        </a>
    </div>

    {{-- @forelse: kết hợp @foreach + xử lý trường hợp rỗng --}}
    @forelse ($posts as $post)

        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        {{-- Số thứ tự dùng $loop->iteration --}}
                        <span class="text-muted small">#{{ $loop->iteration }}</span>

                        {{-- Tiêu đề bài viết – link đến trang chi tiết --}}
                        <h5 class="card-title mt-1">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h5>

                        {{-- Tóm tắt nội dung --}}
                        <p class="card-text text-muted">
                            {{ Str::limit($post->body, 100) }}
                        </p>

                        {{-- Thông tin tác giả và ngày đăng --}}
                        <small class="text-muted">
                            👤 {{ $post->author }} &nbsp;·&nbsp; 📅 {{ $post->created_at->diffForHumans() }}
                        </small>
                    </div>

                    <div class="ms-3">
                        <x-badge :status="$post->status"></x-badge>
                    </div>
                </div>

                {{-- Nút hành động --}}
                <div class="mt-2 pt-2 border-top d-flex gap-2">
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">👁 Xem</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">✏ Sửa</a>

                    {{-- Form xóa --}}
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Xóa bài viết này?')">
                            🗑 Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Thêm xử lý đặc biệt cho phần tử cuối --}}
        @if ($loop->last)
            <p class="text-center text-muted small mt-3">
                — Đã hiển thị tất cả {{ $loop->count }} bài viết —
            </p>
        @endif

    @empty
        {{-- Hiển thị khi không có bài viết nào --}}
        <div class="text-center py-5">
            <p class="text-muted fs-4">📭 Chưa có bài viết nào.</p>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">
                ✏ Viết bài đầu tiên
            </a>
        </div>

    @endforelse

@endsection