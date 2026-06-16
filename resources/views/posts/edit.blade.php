@extends('layouts.app')
@section('title', 'Chỉnh sửa: ' . $post->title)
@section('content')

    <div class="container mt-4" style="max-width: 760px">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>✏️ Chỉnh sửa bài viết</h2>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">&larr; Xem lại bài viết</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠ Vui lòng kiểm tra lại các trường sau:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('posts.update', $post) }}">
                    @csrf
                    @method('PUT')

                    {{-- 1. Ô NHẬP TIÊU ĐỀ --}}
                    <div class="mb-4">
                        <label for="title" class="form-label fw-bold">Tiêu đề bài viết <span
                                class="text-danger">*</span></label>

                        {{-- ĐÃ SỬA: Đổ dữ liệu gốc $post->title vào tham số thứ hai của old() --}}
                        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                            class="form-control @error('title') is-invalid @enderror" placeholder="">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. Ô NHẬP NỘI DUNG --}}
                    <div class="mb-4">
                        <label for="content" class="form-label fw-bold">Nội dung bài viết <span
                                class="text-danger">*</span></label>

                        {{-- ĐÃ SỬA: Đổ dữ liệu gốc $post->content vào tham số thứ hai của old() và chuyển thành content
                        thay vì body --}}
                        <textarea id="content" name="content" rows="8"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="">{{ old('content', $post->content) }}</textarea>

                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">💾 Lưu thay đổi</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-light">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection