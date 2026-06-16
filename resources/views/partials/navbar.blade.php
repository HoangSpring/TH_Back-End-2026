{{-- resources/views/partials/navbar.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1B2A4A;">
    <div class="container">
        {{-- Logo / Brand --}}
        <a class="navbar-brand fw-bold" href="/">
            📝 Phú Xuân Blog
        </a>

        {{-- Nút hamburger khi thu nhỏ trên điện thoại --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Các liên kết Điều hướng --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">🏠 Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">📰 Bài viết</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts/create">✏ Viết bài</a>
                </li>
            </ul>
        </div>
    </div>
</nav>