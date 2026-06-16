<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{--
    @yield('title', 'Phú Xuân Blog')
    -> Nếu view con định nghĩa @section('title', 'Tên trang') thì hiện 'Tên trang | Phú Xuân Blog'
    -> Nếu view con KHÔNG định nghĩa -> hiện 'Phú Xuân Blog' (giá trị mặc định)
    --}}
    <title>@yield('title', 'Phú Xuân Blog') | Phú Xuân Blog</title>

    {{-- Bootstrap 5 CSS từ CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- @stack('styles'): vùng chờ để view con đẩy CSS riêng vào nếu cần --}}
    @stack('styles')
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    {{-- Thanh điều hướng Navbar --}}
    @include('partials.navbar')

    {{-- Thêm class flex-grow-1 vào đây để bọc nội dung và ép Footer xuống đáy luôn luôn chuẩn --}}
    <div class="container mt-3 flex-grow-1">

        {{-- KHU VỰC THÊM MỚI: Tự động bắt mọi trạng thái thông báo hệ thống --}}
        @foreach (['success', 'danger', 'warning', 'info'] as $type)
            @if (session($type) || ($type === 'danger' && session('error')))
                @php 
                    $msg = session($type) ?? session('error');
                    $icon = match ($type) {
                        'success' => '✅',
                        'danger' => '❌',
                        'warning' => '⚠',
                        default => 'ℹ',
                    };
                @endphp
                <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                    {{ $icon }} {{ $msg }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach

        {{-- Nội dung thay đổi động của các view con --}}
        @yield('content')
        
    </div>

    {{-- Phần Footer --}}
    @include('partials.footer') 

    {{-- Thêm Script Bootstrap 5 ở cuối để các nút đóng (x) alert hoặc menu dropdown hoạt động được --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
