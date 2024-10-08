{{-- tour của tôi --}}
@extends('client.layout.user_page')
@section('title')
    Tour của tôi
@endsection
@section('main_user')
    <style>
        #myTour .link-body-emphasis.active {
            color: rgba(var(--bs-link-color-rgb)) !important;
            font-weight: bold;
            text-decoration: underline;
            text-decoration-color: rgba(var(--bs-link-color-rgb)) !important;
        }
    </style>
    <div id="myTour">
        <div class="mb-3 d-flex justify-content-evenly bg-secondary bg-opacity-25 p-2 rounded">
            <a href="" class="nav-link link-body-emphasis active">Tour</a>
            <a href="" class="nav-link link-body-emphasis">Hotel</a>
            <a href="" class="nav-link link-body-emphasis">Airline ticket</a>
        </div>
        <div class="mb-3 d-flex justify-content-evenly bg-secondary bg-opacity-25 p-2 rounded">
            <a href="" class="text-center nav-link link-body-emphasis active">Tất cả</a>
            <a href="" class="text-center nav-link link-body-emphasis">Chờ thanh toán</a>
            <a href="" class="text-center nav-link link-body-emphasis">Chờ xác nhận</a>
            <a href="" class="text-center nav-link link-body-emphasis">Đã thanh toán</a>
            <a href="" class="text-center nav-link link-body-emphasis">Hủy tour</a>
            <a href="" class="text-center nav-link link-body-emphasis">Quá hạn thanh toán</a>
        </div>
        <div class="p-2">
            <div class="d-flex justify-content-center align-items-center"style="height: 100px;">
                <span>Bạn chưa đăng ký tour nào</span>
            </div>
            <div class="card border-0 mb-3">
                <div class="row g-0">
                    <div class="col-md-2 d-flex align-items-center">
                        <img src="../assets/image/tour01.webp" class="img-fluid object-fit-cover rounded" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nhật Bản: Osaka - Kyoto - Nagoya - Tokyo -Núi Phú Sĩ - Làng cổ Oshino Hakkai | Thưởng thức bò Wagyu</h5>
                            <p class="card-text">Ngày khởi hành <span><input type="date" value="2024-12-24" class="border px-2 text-primary fw-bold" disabled></span></p>
                        </div>
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <a href="" class="btn btn-outline-primary">Xem đơn</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card border-0 mb-3">
                <div class="row g-0">
                    <div class="col-md-2 d-flex align-items-center">
                        <img src="../assets/image/tour01.webp" class="img-fluid object-fit-cover rounded" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nhật Bản: Osaka - Kyoto - Nagoya - Tokyo -Núi Phú Sĩ - Làng cổ Oshino Hakkai | Thưởng thức bò Wagyu</h5>
                            <p class="card-text">Ngày khởi hành <span><input type="date" value="2024-12-24" class="border px-2 text-primary fw-bold" disabled></span></p>
                        </div>
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <a href="" class="btn btn-outline-primary">Xem đơn</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card border-0 mb-3">
                <div class="row g-0">
                    <div class="col-md-2 d-flex align-items-center">
                        <img src="../assets/image/tour01.webp" class="img-fluid object-fit-cover rounded" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nhật Bản: Osaka - Kyoto - Nagoya - Tokyo -Núi Phú Sĩ - Làng cổ Oshino Hakkai | Thưởng thức bò Wagyu</h5>
                            <p class="card-text">Ngày khởi hành <span><input type="date" value="2024-12-24" class="border px-2 text-primary fw-bold" disabled></span></p>
                        </div>
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <a href="" class="btn btn-outline-primary">Xem đơn</a>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
