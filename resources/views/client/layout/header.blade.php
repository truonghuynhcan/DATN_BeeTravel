<style>
    #nav2 .nav-link.active{
        color: var(--bs-primary);
        font-weight: bold;
    }
    #nav2 .nav-link{
        transition: color 0.4s ease, font-weight 0.3s ease, text-decoration 0.3s ease;
    }
    #nav2 .nav-link:hover{
        font-weight: bold;
        text-decoration: underline;
        color: var(--bs-primary);
    }
</style>
<header>
    <!-- nav 1 -->
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container-fluid  bg-secondary bg-opacity-50">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-body active " aria-current="page" href="#"> <i class="bi bi-envelope"></i> info@beechoice.net</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-body " href="#"><i class="bi bi-telephone-inbound-fill"></i>
                            1900.1900.1900</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-body " href="#"><i class="bi bi-geo-alt-fill"></i> Chọn điểm khởi
                            hành</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-body dropdown-toggle " href="{{ route('login') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('register') }}">Đăng Ký</a></li>
                            <li><a class="dropdown-item" href="{{ route('login') }}">Đăng Nhập</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAV 2 (Main Navbar) -->
    <nav id="nav2" class="navbar navbar-expand-lg bg-body">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('') }}assets/image/logo_ngang.png" alt="logo" height="60px">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto h5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news') }}">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('thanh_toan') }}">Thanh toán</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('thanh_toan') }}">Tour list</a>
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('tour_chi_tiet') }}">Tour desctiption</a> --}}
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tài khoản
                        </a>
                        <ul class="dropdown-menu" style="left: -45px;">
                            <li><a class="dropdown-item" href="{{route('myProfile')}}">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="{{route('myTour')}}">Tour của tôi</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- NAV 3 (Offcanvas Navbar for small screens) -->
    <nav id="nav3" class="navbar bg-body-tertiary fixed-top d-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('') }}assets/image/logo_ngang.png" alt="logo" height="60px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        <img src="{{ asset('') }}assets/image/logo_ngang.png" alt="logo" height="60px">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" id="nav3-ul">
                        <!-- Dynamic content will be copied here from nav2 -->
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleNavbars() {
                const nav2 = document.getElementById('nav2');
                const nav3 = document.getElementById('nav3');
                const nav2UL = document.querySelector('#nav2 .navbar-nav');
                const nav3UL = document.getElementById('nav3-ul');

                if (window.innerWidth >= 992) {
                    // Show nav2 and hide nav3
                    nav2.classList.remove('d-none');
                    nav3.classList.add('d-none');
                } else {
                    // Show nav3 and hide nav2
                    nav2.classList.add('d-none');
                    nav3.classList.remove('d-none');

                    // Copy the content of nav2 UL into nav3 UL
                    nav3UL.innerHTML = nav2UL.innerHTML;
                }
            }

            // Run on load
            toggleNavbars();

            // Run on window resize
            window.addEventListener('resize', toggleNavbars);
        });
    </script>
</header>
