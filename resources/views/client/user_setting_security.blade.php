@extends('client.layout.user_page')
@section('title')
    Bảo mật
@endsection
@section('main_user')
<div>
    <h2 class="fs-4 fw-normal mb-0">Bảo mật</h2>
    <p class="opacity-50">Thay đổi cài đặt bảo mật, thiết lập xác thực an toàn hoặc xóa tài khoản của bạn.</p>
</div>
<hr class="opacity-100">
<div class="container">

    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <p class="h6 mb-0">Thay đổi mật khẩu</p>
            <p class="opacity-50">Bạn nên thay đổi 6 tháng một lần để đảm bảo tài khoản an toàn nhất</p>
        </div>
        <a href="">Thay đổi</a>
    </div>
    <hr>
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <p class="h6 mb-0">Xác thực 2 yếu tố</p>
            <p class="opacity-50">Tăng tính bảo mật cho tài khoản của bạn bằng cách thiết lập xác thực hai yếu tố.</p>
        </div>
        <a href="">Cài đặt</a>
    </div>
    <hr>
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <p class="h6 mb-0">Xóa tài khoản</p>
            <p class="opacity-50">Xóa vĩnh viễn tài khoản BeeTravel.com của bạn</p>
        </div>
        <a href="">Xóa tài khoản</a>
    </div>
</div>
@endsection
