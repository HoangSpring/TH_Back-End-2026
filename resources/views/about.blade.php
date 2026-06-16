@extends('layouts.app')

@section('title', 'Giới thiệu')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-3 text-primary">Giới thiệu</h2>
        <p>Đây là trang giới thiệu của Phú Xuân Blog.</p>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-2">Về trang chủ</a>
    </div>
@endsection