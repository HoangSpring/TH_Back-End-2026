@extends('layouts.app')

@section('title', 'Cửa hàng Phú Xuân')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-uppercase fw-bold text-primary">🛒 Danh sách sản phẩm</h2>

        <div class="card p-3 shadow-sm border-0 mb-4 bg-white">
            <form action="{{ route('products.index') }}" method="GET" class="row g-2 align-items-center">

                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">🔍</span>
                        <input type="text" name="search" class="form-control border-start-0"
                            placeholder="Tìm kiếm theo tên sản phẩm..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">📁</span>
                        <select name="category_id" class="form-select border-start-0">
                            <option value="">Tất cả danh mục</option>
                            @foreach($productCategories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">⏱</span>
                        <select name="sort" class="form-select border-start-0">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100 fw-bold">Lọc sản phẩm</button>
                </div>

            </form>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $product->image ?? 'https://picsum.photos/600/400' }}" class="card-img-top"
                            alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-info text-dark mb-2 align-self-start">
                                📦 {{ $product->productCategory->name ?? 'Chưa phân loại' }}
                            </span>

                            <h5 class="card-title fw-bold text-dark text-truncate" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h5>
                            <p class="card-text text-muted small flex-grow-1"
                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                {{ $product->description }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="text-danger fw-bold fs-5">{{ number_format($product->price, 0, ',', '.') }}
                                    đ</span>
                                <span class="text-muted small">Kho: {{ $product->stock }}</span>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0 p-3 pt-0">
                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-outline-primary btn-sm w-100 fw-bold">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-4">❌ Không tìm thấy sản phẩm nào phù hợp!</div>
                    <a href="{{ route('products.index') }}" class="btn btn-link btn-sm mt-2">Xóa bộ lọc</a>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>

    </div>
@endsection