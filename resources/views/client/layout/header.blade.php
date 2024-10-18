 <!-- header START -->
 <style>
    #nav2 .nav-link.active {
        color: var(--bs-primary);
        font-weight: bold;
    }

    #nav2 .nav-link {
        transition: color 0.4s ease, font-weight 0.3s ease, text-decoration 0.3s ease;
    }

    #nav2 .nav-link:hover {
        font-weight: bold;
        text-decoration: underline;
        color: var(--bs-primary);
    }
</style>
<!-- nav 1 -->
<nav class="navbar navbar-expand-lg p-0 ">
    <div class="container-fluid  bg-secondary bg-opacity-50">
        <div class="container collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-body active " aria-current="page" href="{{route('contact')}}"> <i class="bi bi-envelope"></i> info@beechoice.net</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body " href="{{route('contact')}}"><i class="bi bi-telephone-inbound-fill"></i>
                        1900.1900.1900</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-body " href=""><i class="bi bi-facebook"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body " href=""><i class="bi bi-instagram"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body " href=""><i class="bi bi-youtube"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body " href=""><i class="bi bi-tiktok"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body " href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                        </svg></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- NAV 2 (Main Navbar) -->
<header class="sticky-top">
    <nav id="nav2" class="navbar navbar-expand-lg">
        <div class="container bg-body rounded-4 mt-3 ">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="../assets/image/logo_ngang.png" alt="logo" height="40px">
            </a>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 h5">
                    <!-- 
                    -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tour') }}">Tour list</a>
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
                        {{-- <a class="nav-link" href="{{ route('tour_chi_tiet') }}">Tour desctiption</a> --}}
                    </li>

                </ul>
            </div>
            <ul class="navbar-nav pe-3" id="account-lg">
                <!-- Dynamic content will be copied here from nav2 -->
                <li class="nav-item dropdown position-relative">
                    <a class="dropdown-toggle btn btn-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tài khoản
                    </a>
                    <ul class="dropdown-menu position-absolute" style="left: -100px; min-width:209px">

                        {{-- khi người dùng chưa đăng nhập thì hiện như này --}}
                        @guest
                        <li class="p-2">Đăng nhập hoặc đăng ký để tận dụng ưu đãi</li>
                        <li class="p-2"><a class="container-fluid btn btn-primary" href="{{ route('login') }}">Đăng nhập khách hàng</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="p-2">Đăng nhập đối tác</li>
                        <li class="p-2"><a class="container-fluid btn btn-outline-primary" href="{{ route('login_admin') }}">Đăng nhập đối tác</a></li>
                        @endguest

                        {{-- khi người dùng đã đăng nhập thì hiện --}}
                        @auth
                        <li><a class="dropdown-item" href="{{ route('myProfile') }}">Thông tin cá nhân</a></li>
                        <li><a class="dropdown-item" href="{{ route('myTour') }}">Tour của tôi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- NAV 3 (Offcanvas Navbar for small screens) -->
    <nav id="nav3" class="navbar bg-body-tertiary fixed-top d-none">
        <div class="container-fluid">
            <div>
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="../assets/image/logo_ngang.png" alt="logo" height="60px">
                </a>
            </div>
            <ul class="navbar-nav justify-content-end pe-3" id="account-sm">
                <!-- chèn tài khoản ở đây -->
            </ul>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        <img src="../assets/image/logo_ngang.png" alt="logo" height="60px">
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
        document.addEventListener('DOMContentLoaded', function () {
            // Hàm để bật/tắt navbars tùy theo kích thước màn hình
            function toggleNavbars() {
                const nav2 = document.getElementById('nav2');
                const nav3 = document.getElementById('nav3');
                const nav2UL = document.querySelector('#nav2 .navbar-nav');
                const nav3UL = document.getElementById('nav3-ul');
                const accountLG = document.getElementById('account-lg');  // Lấy phần tử chứa tài khoản lớn
                const accountSM = document.getElementById('account-sm');  // Phần tử nhỏ để chèn tài khoản

                // Kiểm tra sự tồn tại của các phần tử trước khi thao tác
                if (nav2 && nav3 && nav2UL && nav3UL && accountLG && accountSM) {
                    if (window.innerWidth >= 960) {
                        // Hiển thị nav2 và ẩn nav3 trên màn hình lớn
                        nav2.classList.remove('d-none');
                        nav3.classList.add('d-none');
                    } else {
                        // Hiển thị nav3 và ẩn nav2 trên màn hình nhỏ
                        nav2.classList.add('d-none');
                        nav3.classList.remove('d-none');

                        // Sao chép nội dung của UL từ nav2 vào nav3
                        nav3UL.innerHTML = nav2UL.innerHTML;

                        // Sao chép nội dung của account-lg vào account-sm
                        accountSM.innerHTML = accountLG.innerHTML;
                    }
                }
            }

            // Gọi hàm khi trang load xong
            toggleNavbars();

            // Gọi lại hàm khi thay đổi kích thước cửa sổ
            window.addEventListener('resize', toggleNavbars);
        });

    </script>

</header>

<!-- header END -->