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

    {{-- Thêm class flex-grow-1 bọc nội dung và ép Footer xuống đáy --}}
    <div class="container mt-3 flex-grow-1">

        {{-- Nhúng Blade partial chứa các Flash Message --}}
        @include('partials.flash-messages')

        {{-- Nội dung thay đổi động của các view con --}}
        @yield('content')

    </div>

    {{-- Phần Footer --}}
    @include('partials.footer')

    {{-- Thêm Script Bootstrap 5 ở cuối để các nút đóng (x) alert hoạt động được --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JavaScript tự động ẩn Flash Message sau 5 giây (Auto-dismiss) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
                setTimeout(function () {
                    var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                }, 5000); // 5000ms = 5 giây
            });
        });
    </script>

    {{-- Vùng chờ đẩy script của các view con --}}
    @stack('scripts')
</body>

</html>