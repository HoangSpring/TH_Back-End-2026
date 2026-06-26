@extends('layouts.app')

@section('title', 'Phú Xuân Blog - Trang chủ')

@section('content')
    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 bg-white p-3">
                <div class="card-body">
                    <h5 class="card-title mb-2 d-flex align-items-center">
                        <span class="me-2">📝</span>Blog
                    </h5>
                    <p class="card-text text-muted small mb-4">Xem các bài viết mới nhất về Laravel và PHP.</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm px-3">Xem ngay</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 bg-white p-3">
                <div class="card-body">
                    <h5 class="card-title mb-2 d-flex align-items-center">
                        <span class="me-2">🛒</span>Cửa hàng
                    </h5>
                    <p class="card-text text-muted small mb-4">Khám phá sản phẩm trong cửa hàng online.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-sm px-3">Mua hàng</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 bg-white p-3">
                <div class="card-body">
                    <h5 class="card-title mb-2 d-flex align-items-center">
                        <span class="me-2">ℹ️</span>Về chúng tôi
                    </h5>
                    <p class="card-text text-muted small mb-4">Tìm hiểu thêm về nhóm phát triển.</p>
                    <a href="#" class="btn btn-secondary btn-sm px-3">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>
@endsection