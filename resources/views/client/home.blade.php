@extends('client.layout.index')
@section('title')
    Trang chủ
@endsection
@section('main')
    {{-- slider --}}
    <div id="carouselExampleCaptions" class="carousel slide ">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('') }}assets/image/banner-home-1.png" class="d-block w-100" style="min-height: 200px" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bee Travel</h5>
                    <p>Tha hồ du lịch</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('') }}assets/image/banner-home-2.png" class="d-block w-100" style="min-height: 200px" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Đi cùng BeeChoice</h5>
                    <p>Thoải mái đi chơi</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('') }}assets/image/banner-home-3.png" class="d-block w-100" style="min-height: 200px" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bee Travel</h5>
                    <p>Tha hồ du lịch</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- banner-images -->
    <div class="container my-4 py-2 d-none">
        <div class="row banner-img">
            <div class="col-md-6">
                <img class="shadow rounded" src="{{ asset('') }}assets/image/baner 106.png" alt="" style="height: 400px; width: 100%;">
            </div>
            <div class="col-md-6">
                <img class="shadow rounded" src="{{ asset('') }}assets/image/baner 107.png" alt="" style="height: 195px; width: 100%;">
                <img class="shadow rounded" src="{{ asset('') }}assets/image/baner 108.png" alt="" style="height: 195px; width: 100%; margin-top: 10px;">
            </div>
        </div>
    </div>


    <!-- product feature start -->
    <section class=" mb-4 py-4 bg-secondary bg-opacity-25">
        <div class="container">
            {{-- heading --}}
            <div class="d-flex justify-content-between align-items-end">
                <div class="d-flex flex-column text-body">
                    <h2 class="">ƯU ĐÃI ĐẶC BIỆT</h2>
                    <hr class="m-0 mb-1 p-0 border-2" width="300px">
                    <p class="text-body">Nhanh tay nắm bắt cơ hội giảm giá cuối cùng. Đặt ngay để không bỏ lỡ!</p>
                </div>
                <div class="button-container">
                    <button class="muiten"><i class="bi bi-arrow-left"></i></button>
                    <button class="muiten"><i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 mb-3">
                    <div class="card text-bg-dark position-relative">
                        <div class="position-absolute start-0" style="top:5px;">
                            <svg width="80" height="40" viewBox="0 0 146 62" fill="none"xmlns="http://www.w3.org/2000/svg">
                                <path d="M144 1H1V61H144L120.405 31L144 1Z" style="fill: var(--bs-primary);" />
                            </svg>
                            <span class="text-body position-absolute start-50 top-50 translate-middle">Mới</span>
                        </div>
                        <img src="{{ asset('') }}assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" height="450px" class="card-img oject-fit-fill" alt="...">
                        <div class="card-img-overlay m-3 p-2 bg-body bg-opacity-75 text-body" style="top:inherit">
                            <h5 class="card-title">
                                <a href="{{route('tour_chi_tiet','alo')}}" class="text-decoration-none text-body fs-6">
                                    Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec
                                </a>
                            </h5>

                            <div class="d-flex">
                                <i class="bi bi-geo-alt"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="d-flex">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: <b>03/08/2024</b></p>
                            </div>
                            <div class="d-flex ">
                                <p class="card-text">Giá: <b class=" text-danger">10.890.000 ₫</b></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary container-fluid">Đặt ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 mb-3">
                    <div class="card text-bg-dark">
                        <img src="{{ asset('') }}assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" height="450px" class="card-img oject-fit-fill" alt="...">
                        <div class="card-img-overlay m-3 p-2 bg-body text-body" style="top:inherit">
                            <h5 class="card-title">
                                <a href="#" class="text-decoration-none text-body fs-6">
                                    Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec
                                </a>
                            </h5>

                            <div class="d-flex">
                                <i class="bi bi-geo-alt"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="d-flex">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: <b>03/08/2024</b></p>
                            </div>
                            <div class="d-flex ">
                                <p class="card-text">Giá: <b class=" text-danger">10.890.000 ₫</b></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary container-fluid">Đặt ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 mb-3">
                    <div class="card text-bg-dark">
                        <img src="{{ asset('') }}assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" height="450px" class="card-img oject-fit-fill" alt="...">
                        <div class="card-img-overlay m-3 p-2 bg-body text-body" style="top:inherit">
                            <h5 class="card-title">
                                <a href="#" class="text-decoration-none text-body fs-6">
                                    Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec
                                </a>
                            </h5>

                            <div class="d-flex">
                                <i class="bi bi-geo-alt"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="d-flex">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: <b>03/08/2024</b></p>
                            </div>
                            <div class="d-flex ">
                                <p class="card-text">Giá: <b class=" text-danger">10.890.000 ₫</b></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary container-fluid">Đặt ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class=" them btn ">Xem tất cả</a>
            </div>
    </section>
    <!-- product feature end -->


    <!-- Catagory-address -->
    <div class="container mb-3">
        <div class="yeuthich">
            <h3>ĐIỂM ĐẾN YÊU THÍCH</h3>
            <hr class="short-line">
            <p>Hãy chọn một điểm đến du lịch nổi tiếng dưới đây để khám phá các chuyến đi độc quyền của chúng tôi với
                mức giá vô cùng hợp lý.</p>
            <div class="address">
                <a href="">MIỀN BẮC</a>
                <a href="">MIỀN NAM</a>
                <a href="">MIỀN ĐÔNG NAM BỘ</a>
                <a href="">MIỀN TÂY NAM BỘ</a>
            </div>

            {{-- mobile,taplet (6kv), laptop(8kv) --}}
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card text-bg-dark">
                        <img src="{{ asset('') }}assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" height="200px" class="card-img object-fit-fill" alt="...">
                        <div class="card-img-overlay bg-black bg-opacity-50 d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-center">Địa điểm 0</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- dichvukhac -->
        <div class="dichvu">
            <div class="row">
                <div class="commitment-box col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-hand-index-thumb"></i>
                        <div>
                            <span>GIÁ TỐT-NHIỀU ƯU ĐÃI</span>
                            <p>Ưu đãi và quà tặng hấp dẫn khi mua tuor online</p>
                        </div>
                    </div>
                </div>
                <div class="commitment-box col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-cart4"></i>
                        <div>
                            <span>THANH TOÁN AN TOÀN</span>
                            <p>Được bào mật một cách nghiêm ngặt</p>
                        </div>
                    </div>
                </div>
                <div class="commitment-box col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-pencil"></i>
                        <div>
                            <span>TƯ VẤN MIỄN PHÍ</span>
                            <p>Hỗ trợ tư vấn online tư vấn miễn phí</p>
                        </div>
                    </div>
                </div>
                <div class="commitment-box col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-star"></i>
                        <div>
                            <span>THƯƠNG HIỆU UY TÍN</span>
                            <p>Thương hiệu lữ hành hàng đầu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
