@extends('layouts.app')

@section('title', 'Blog - Danh sách bài viết')

@section('page-header')

    <h1>📝 Blog</h1>

    <p class="mb-0">
        {{ count($articles) }} bài viết
    </p>

@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="h4 mb-0">
        Tất cả bài viết
    </h2>

    <a href="{{ route('articles.create') }}"
       class="btn btn-primary">
        + Thêm bài viết
    </a>

</div>

@forelse($articles as $article)

    <div class="card mb-3 shadow-sm">

        <div class="card-body">

            <h5 class="card-title">

                <a href="{{ route('articles.show', $article['id']) }}"
                   class="text-decoration-none">

                    {{ $article['title'] }}

                </a>

            </h5>

            <p class="card-text text-muted small">

                ✍ {{ $article['author'] }}
                •
                📅 {{ $article['date'] }}

            </p>

            <a href="{{ route('articles.show', $article['id']) }}"
               class="btn btn-outline-primary btn-sm">

                Đọc tiếp →

            </a>

        </div>

    </div>

@empty

    <div class="alert alert-info">
        Chưa có bài viết nào.
    </div>

@endforelse

@endsection