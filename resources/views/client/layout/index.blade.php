<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEE TRAVEL - @yield('title')</title>
    {{-- <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon"> --}}

    <link rel="stylesheet" href="{{asset('')}}assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/bootstrap-custom.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/style.css">
</head>

<body>
    @include('client.layout.header')
    <!-- main -->
    @yield('main')

    <!-- footer -->
    @include('client.layout.footer')
    


    <script src="{{asset('')}}assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('')}}assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>