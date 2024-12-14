<!DOCTYPE html>
<html lang="vn" data-bs-theme="" style="font-size: 14px">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEE TRAVEL - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/image/logo_BeeTravel.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap.css">
    {{-- Fonaweosome --}}
    <script src="https://kit.fontawesome.com/0e14ebdea1.js" crossorigin="anonymous"></script>
    {{--
    <link href="{{asset('')}}assets/fontawesome-free-6.6.0-web/css/fontawesome.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/fontawesome-free-6.6.0-web/css/brands.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/fontawesome-free-6.6.0-web/css/solid.css" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap-custom.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">

    <!-- Insert the blade containing the TinyMCE configuration and source script -->
    <x-head.tinymce-config />

</head>

<body class="bg-secondary bg-opacity-10">
    <!-- Overlay -->
    {{-- @include('client.layout.overlay') --}}


    @include('client.layout.header')
    <!-- Breadcrumb -->
    {{-- <div class="container mb-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Du lịch</a></li>
                <li class="breadcrumb-item"><a href="#">Trong nước</a></li>
                <li class="breadcrumb-item"><a href="#">Miền Bắc</a></li>
                <li class="breadcrumb-item active d-inline-block text-truncate" style="max-width: 40vh;" aria-current="page">Hà Nội - Lào Cai - Quảng Ninh - Ninh Bình: Sapa - Bản Cát Cát - Fansipan Hạ Long - Động Thiên Cung - Yên Tử - Kdl Tràng An - Bái Đính</li>
            </ol>
        </nav>
    </div> --}}
    <!-- main -->
    @yield('main')

    <!-- footer -->
    @include('client.layout.footer')


    <script src="{{ asset('') }}assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tours = document.querySelectorAll('.tour-hidden');
            const leftButton = document.querySelector('.button-container .muiten:nth-child(1)');
            const rightButton = document.querySelector('.button-container .muiten:nth-child(2)');
            let currentIndex = 0;
            const toursPerPage = 4; // Số lượng tour muốn hiển thị mỗi lần

            // Cập nhật hiển thị các tour dựa trên currentIndex
            function updateTourDisplay() {
                tours.forEach((tour, index) => {
                    if (index >= currentIndex && index < currentIndex + toursPerPage) {
                        tour.style.display = 'block';
                    } else {
                        tour.style.display = 'none';
                    }
                });
            }

            // Sự kiện khi nhấn nút trái
            leftButton.addEventListener('click', () => {
                currentIndex = (currentIndex - toursPerPage + tours.length) % tours.length;
                updateTourDisplay();
            });

            // Sự kiện khi nhấn nút phải
            rightButton.addEventListener('click', () => {
                currentIndex = (currentIndex + toursPerPage) % tours.length;
                updateTourDisplay();
            });

            // Khởi tạo hiển thị tour ban đầu
            updateTourDisplay();
        });

        //lọc tour
        document.getElementById('price_range').addEventListener('change', function() {
            if (this.value) {
                this.form.submit();
            }
        });
    </script>


</body>

</html>