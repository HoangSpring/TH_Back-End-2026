@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')


    {{-- Header section: tiêu đề + thống kê --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <div>
            <h1 class="h3 mb-1">📰 Danh sách bài viết</h1>
            <p class="text-muted mb-0">Tổng cộng {{ $posts->total() }} bài viết</p>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            ✏ Viết bài mới
        </a>
    </div>

    {{-- 🌟 PHẦN THÊM MỚI (LAB 2): Form tìm kiếm và Bộ lọc nâng cao chuẩn Bootstrap 5 --}}
    <div class="card mb-4 bg-light border shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('posts.index') }}" class="row g-3 align-items-center">
                {{-- Ô tìm kiếm từ khóa --}}
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white">🔍</span>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Tìm kiếm theo tiêu đề...">
                    </div>
                </div>

                {{-- Dropdown lọc theo danh mục --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <select name="category_id" class="form-select">
                        <option value="">📂 Tất cả danh mục</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown sắp xếp --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <select name="sort" class="form-select">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>⏱ Mới nhất</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>🔥 Phổ biến nhất
                        </option>
                    </select>
                </div>

                {{-- Các nút hành động --}}
                <div class="col-12 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-dark w-100">Lọc bài</button>
                    @if(request()->has('search') || request()->has('category_id') || request()->has('sort'))
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-danger" title="Xóa bộ lọc">❌</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    {{-- ───────────────────────────────────────────────────────────── --}}

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
                            {{ Str::limit($post->content, 100) }}
                        </p>

                        {{-- Thông tin tác giả, danh mục và lượt bình luận (Lab 2 & Lab 3 - Tối ưu) --}}
                        <div class="mb-2">
                            <small class="text-muted">
                                👤 Tác giả: <strong class="text-dark">{{ $post->user->name ?? 'Ẩn danh' }}</strong>
                                &nbsp;·&nbsp;
                                📁 Danh mục: <span
                                    class="badge bg-light text-dark border">{{ $post->category->name ?? 'Chưa phân loại' }}</span>
                                &nbsp;·&nbsp;
                                ⏱ <span class="text-dark font-weight-bold">{{ $post->reading_time }}</span>
                                &nbsp;·&nbsp;
                                💬 {{ $post->comments_count }} bình luận &nbsp;·&nbsp;
                                📅 {{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>

                        {{-- Danh sách các thẻ Tag (Đã bổ sung bộ kiểm tra an toàn tích hợp liên kết) --}}
                        <div class="mt-2">
                            @foreach($post->tags as $tag)
                                @if(!empty($tag->slug))
                                    <a href="{{ route('tags.index', $tag->slug) }}" class="badge bg-secondary text-decoration-none me-1"
                                        style="font-weight: 500; font-size: 0.8rem;">
                                        🏷️ {{ $tag->name }}
                                    </a>
                                @else
                                    <span class="badge bg-secondary me-1" style="font-weight: 500; font-size: 0.8rem; opacity: 0.7;">
                                        🏷️ {{ $tag->name }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="ms-3">
                        <x-badge :status="$post->status"></x-badge>
                    </div>
                </div>

                {{-- Nút hành động --}}
                <div class="mt-3 pt-2 border-top d-flex gap-2">
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">👁 Xem chi tiết</a>

                    {{-- Chỉ hiện nút Sửa/Xóa nếu user đang đăng nhập và là chủ sở hữu bài viết --}}
                    @if(Auth::check() && Auth::id() === $post->user_id)
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
                    @endif
                </div>
            </div>
        </div>

        {{-- Thêm xử lý đặc biệt cho phần tử cuối trong trang hiện tại --}}
        @if ($loop->last)
            <p class="text-center text-muted small mt-3">
                — Đã hiển thị {{ $loop->count }} bài viết trên trang này —
            </p>
        @endif

    @empty
        {{-- Hiển thị khi không có bài viết nào khớp với bộ lọc tìm kiếm --}}
        <div class="text-center py-5">
            <p class="text-muted fs-4">📭 Không tìm thấy bài viết nào phù hợp.</p>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-2">
                🔄 Reset bộ lọc
            </a>
        </div>

    @endforelse

    {{-- 📊 Hiển thị bộ nút chuyển trang Bootstrap --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>

@endsection