@extends('layouts.app')

@section('title', 'Sản phẩm')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-3 text-primary">Sản phẩm</h2>
        <p>Đây là trang sản phẩm của cửa hàng.</p>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-2">Về trang chủ</a>
    </div>
@endsection