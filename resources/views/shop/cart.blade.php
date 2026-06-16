@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-3 text-primary">Giỏ hàng</h2>
        <p>Đây là trang giỏ hàng của bạn.</p>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-2">Về trang chủ</a>
    </div>
@endsection