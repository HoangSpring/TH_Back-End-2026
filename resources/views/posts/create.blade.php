@extends('layouts.app')

@section('title', 'Tạo bài viết mới')

@section('content')
    <div class="container mt-4" style="max-width: 760px;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>✏️ Tạo bài viết mới</h2>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                ← Quay lại danh sách
            </a>
        </div>

        {{-- ① HIỂN THỊ TỔNG HỢP CÁC LỖI Ở ĐẦU FORM --}}
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
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    {{-- ② INPUT TIÊU ĐỀ --}}
                    <div class="mb-4">
                        <label for="title" class="form-label fw-bold">
                            Tiêu đề bài viết <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Ví dụ: Hướng dẫn cài đặt Laravel...">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">Tối thiểu 5 ký tự, tối đa 255 ký tự.</div>
                    </div>

                    {{-- ③ TEXTAREA NỘI DUNG --}}
                    <div class="mb-4">
                        <label for="content" class="form-label fw-bold">
                            Nội dung <span class="text-danger">*</span>
                        </label>
                        <textarea id="content" name="content" rows="8"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Nhập nội dung bài viết...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">Tối thiểu 10 ký tự.</div>
                    </div>

                    <hr>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">💾 Lưu bài viết</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-light">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection