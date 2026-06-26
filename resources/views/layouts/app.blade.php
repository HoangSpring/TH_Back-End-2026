<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PHÚ XUÂN')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-uppercase tracking-wider"
                href="{{ url('/') }}">
                <span class="me-2">🏫</span>PHÚ XUÂN
            </a>

            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link text-white me-3" href="{{ url('/') }}">🏠 Trang chủ</a>
                <a class="nav-link text-white me-3" href="{{ route('posts.index') }}">📰 Bài viết</a>
                <a class="nav-link text-white me-3" href="{{ route('products.index') }}">🛒 Cửa hàng</a>
                <a class="nav-link text-white-50 me-3" href="#">ℹ️ Về chúng tôi</a>

                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-sm btn-outline-light px-3 text-white" href="#"
                            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                            <li>
                                <button class="dropdown-item small py-2" data-bs-toggle="modal"
                                    data-bs-target="#profileModal">
                                    ⚙️ Chi tiết Profile
                                </button>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-2 mb-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger w-100 text-start text-white small">
                                        🚪 Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="nav-link btn btn-sm btn-outline-primary text-white me-2 px-3" href="{{ route('login') }}">Đăng
                        nhập</a>
                    <a class="nav-link btn btn-sm btn-primary text-white px-3" href="{{ route('register') }}">Đăng ký</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container my-5 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container d-flex justify-content-between align-items-center small">
            <div>
                <h5 class="h6 mb-1 d-flex align-items-center fw-bold">
                    <span class="me-2">🏫</span>PHÚ XUÂN
                </h5>
                <p class="text-white-50 mb-0">Dự án thực hành môn IT3042 – Lập trình Backend Laravel</p>
            </div>
            <div class="text-white-50 text-end">
                © 2026 Đại học Phú Xuân – Khoa CNTT
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>