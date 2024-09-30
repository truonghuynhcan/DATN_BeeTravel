<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEE TRAVEL - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/image/logo_BeeTravel.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('')}}assets/css/bootstrap.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/bootstrap-custom.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/style.css">
</head>

<body class="bg-secondary bg-opacity-10">
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
    


    <script src="{{asset('')}}assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('')}}assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>