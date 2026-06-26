@extends('layouts.app')

@section('title', 'Thùng rác bài viết')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <div>
            <h1 class="h3 mb-1">🗑 Thùng rác bài viết</h1>
            <p class="text-muted mb-0">Danh sách các bài viết đã xóa mềm</p>
        </div>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">
            ⬅ Quay lại danh sách
        </a>
    </div>

    @forelse ($posts as $post)
        <div class="card mb-3 shadow-sm border-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title text-muted mb-1">{{ $post->title }}</h5>
                    <small class="text-danger">
                        📅 Đã xóa lúc: {{ $post->deleted_at->format('d/m/Y H:i') }} ({{ $post->deleted_at->diffForHumans() }})
                    </small>
                </div>

                {{-- Form gửi request PATCH kích hoạt hàm khôi phục --}}
                <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <p class="text-muted fs-5">📭 Thùng rác hiện tại trống rỗng.</p>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
@endsection