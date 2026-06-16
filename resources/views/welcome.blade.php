@extends('layouts.app')

@section('title', 'Trang chủ')

@section('page-header')
    <h1 class="display-5 fw-bold">
        🏠 Chào mừng đến MyLaravelApp!
    </h1>

    <p class="lead mb-0">
        Ứng dụng demo học Laravel – Đại học Phú Xuân
    </p>
@endsection

@section('content')

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        📝 Blog
                    </h5>

                    <p class="card-text">
                        Xem các bài viết mới nhất về Laravel và PHP.
                    </p>

                    <a href="{{ route('articles.index') }}" class="btn btn-primary btn-sm">
                        Xem ngay
                    </a>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        🛒 Cửa hàng
                    </h5>

                    <p class="card-text">
                        Khám phá sản phẩm trong cửa hàng online.
                    </p>

                    <a href="{{ route('shop.products') }}" class="btn btn-success btn-sm">
                        Mua sắm
                    </a>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        ℹ️ Về chúng tôi
                    </h5>

                    <p class="card-text">
                        Tìm hiểu thêm về nhóm phát triển.
                    </p>

                    <a href="{{ route('about') }}" class="btn btn-secondary btn-sm">
                        Xem thêm
                    </a>

                </div>

            </div>
        </div>

    </div>

@endsection