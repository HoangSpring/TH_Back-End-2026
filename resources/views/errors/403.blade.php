@extends('layouts.app')
@section('title', 'Không có quyền truy cập')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-4 fw-bold text-muted">403</h1>
        <h3 class="text-muted mb-4">Bạn không có quyền thực hiện thao tác này</h3>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">Quay lại</a>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Trang chủ</a>
    </div>
@endsection