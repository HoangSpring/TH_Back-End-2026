@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container py-4">
        <a href="{{ route('products.index') }}" class="btn btn-light btn-sm mb-4">⬅ Quay lại cửa hàng</a>

        <div class="row g-5">
            <div class="col-md-6">
                <img src="{{ $product->image }}" class="img-fluid rounded shadow-sm w-100" alt="{{ $product->name }}">
            </div>

            <div class="col-md-6">
                <span class="badge bg-info text-dark mb-2">📦 {{ $product->productCategory->name }}</span>
                <h1 class="fw-bold mb-3 text-dark">{{ $product->name }}</h1>

                <h2 class="text-danger fw-bold my-4">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h2>

                <div class="p-3 bg-light rounded mb-4">
                    <p class="mb-1"><strong>Tình trạng:</strong>
                        @if($product->stock > 0)
                            <span class="text-success fw-bold">Còn hàng ({{ $product->stock }} sản phẩm trong kho)</span>
                        @else
                            <span class="text-danger fw-bold">Hết hàng</span>
                        @endif
                    </p>
                    <p class="mb-0"><strong>Ngày đăng bán:</strong> {{ $product->created_at->format('d/m/Y') }}</p>
                </div>

                <h5 class="fw-bold">📝 Mô tả sản phẩm:</h5>
                <p class="text-muted lh-lg">{{ $product->description }}</p>

                <button class="btn btn-success btn-lg px-5 mt-3 @if($product->stock <= 0) disabled @endif">
                    🛒 Thêm vào giỏ hàng
                </button>
            </div>
        </div>
    </div>
@endsection