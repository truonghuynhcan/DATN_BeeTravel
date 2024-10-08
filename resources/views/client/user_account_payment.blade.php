@extends('client.layout.user_page')
@section('title')
    Tài khoản ngân hàng
@endsection
@section('main_user')
    <!-- Thẻ tín dụng -->
    <div class="d-flex justify-content-between mb-2">
        <h2 class="fs-4 fw-normal m-0">Thẻ Tín dụng/Ghi nợ</h2>
        <a href="#" class="btn btn-primary text-light"><i class="bi bi-plus"></i> Thêm thẻ</a>
    </div>
    <hr>
    <div class="d-flex justify-content-center align-items-center"style="height: 100px;">
        <span>Bạn chưa liên kết thẻ</span>
    </div>

    <!-- Thẻ ngân hàng -->
    <div class="d-flex justify-content-between mb-2">
        <h2 class="fs-4 fw-normal m-0">Tài khoản ngân hàng của tôi</h2>
        <a href="#" class="btn btn-primary text-light"><i class="bi bi-plus"></i> Thêm thẻ</a>
    </div>
    <hr>
    <div class="row ">
        <div class="col-1 d-flex align-items-center">
            <img src="../assets/image/icon/Icon-TPBank.webp" alt="img ngân hàng" width="100%" class="object-fit-cover">
        </div>
        <div class="col-6">
            <p class="mb-1 text-truncate">Ngân Hàng TMCP Tiên Phong</p>
            <p class=" m-0">Họ và Tên: Bee Travel</p>
            <p class=" m-0"><span class="opacity-75">Chi nhánh:</span>CN Quận 12, TP HCM (TPBank)</p>
        </div>
        <div class="col-1">**113</div>
        <div class="col-4">
            <div class="container-fluid d-flex justify-content-between">
                <a href="#">Xóa</a>
                <a href="#" class="btn btn-outline-primary text-decoration-none disabled">Thiết lập mặt định</a>
            </div>
        </div>

    </div>
@endsection
