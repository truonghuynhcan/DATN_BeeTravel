@extends('client.layout.index')
@section('title')
    Trang chủ
@endsection
@section('main')
    {{-- slider --}}
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('') }}assets/image/banner-home-1.png" class="d-block w-100" height="400px" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bee Travel</h5>
                    <p>Tha hồ du lịch</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('') }}assets/image/banner-home-2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Đi cùng BeeChoice</h5>
                    <p>Thoải mái đi chơi</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('') }}assets/image/banner-home-3.png" class="d-block w-100" alt="...">
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
    {{-- banner --}}
    <div class="container mb-3">
        <!-- banner-images -->
        <div class="row banner-img">
            <div class="col-md-6">
                <img src="{{ asset('') }}assets/image/baner 106.png" alt="" style="height: 400px; width: 100%;">
            </div>
            <div class="col-md-6">
                <img src="{{ asset('') }}assets/image/baner 107.png" alt="" style="height: 195px; width: 100%;">
                <img src="{{ asset('') }}assets/image/baner 108.png" alt="" style="height: 195px; width: 100%; margin-top: 10px;">
            </div>
        </div>
    </div>
    <!-- product -->
    <div class="container mb-3">
        <div class="product">
            <h3>ƯU ĐÃI ĐẶC BIỆT</h3>
            <hr class="short-line">
            <p class="gt">Nhanh tay nắm bắt cơ hội giảm giá cuối cùng. Đặt ngay để không bỏ lỡ!</p>
            <div class="button-container">
                <button class="muiten"><i class="bi bi-arrow-left"></i></button>
                <button class="muiten"><i class="bi bi-arrow-right"></i></button>
            </div>
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec</h5>
                            <div class="map">
                                <i class="bi bi-geo-alt" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-qr-code-scan" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Mã tour: <b>PS36499</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: 03/08/2024</p>
                            </div>
                            <div class="gia">
                                <label>Giá từ:</label>
                                <p class="card-text"><b>10.890.000 ₫</b></p>
                            </div>
                            <a href="#" class="btn btn-primary">Đặt ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec</h5>
                            <div class="map">
                                <i class="bi bi-geo-alt" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-qr-code-scan" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Mã tour: <b>PS36499</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: 03/08/2024</p>
                            </div>
                            <div class="gia">
                                <label>Giá từ:</label>
                                <p class="card-text"><b>10.890.000 ₫</b></p>
                            </div>
                            <a href="#" class="btn btn-primary">Đặt ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec</h5>
                            <div class="map">
                                <i class="bi bi-geo-alt" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-qr-code-scan" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Mã tour: <b>PS36499</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: 03/08/2024</p>
                            </div>
                            <div class="gia">
                                <label>Giá từ:</label>
                                <p class="card-text"><b>10.890.000 ₫</b></p>
                            </div>
                            <a href="#" class="btn btn-primary">Đặt ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="" class=" them btn ">Xem tất cả</a>
        </div>
    </div>
    <!-- product -->
    <div class="container mb-3">
        <div class="product">
            <h3>ƯU ĐÃI ĐẶC BIỆT</h3>
            <hr class="short-line">
            <p class="gt">Nhanh tay nắm bắt cơ hội giảm giá cuối cùng. Đặt ngay để không bỏ lỡ!</p>
            <div class="button-container">
                <button class="muiten"><i class="bi bi-arrow-left"></i></button>
                <button class="muiten"><i class="bi bi-arrow-right"></i></button>
            </div>
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec</h5>
                            <div class="map">
                                <i class="bi bi-geo-alt" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-qr-code-scan" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Mã tour: <b>PS36499</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: 03/08/2024</p>
                            </div>
                            <div class="gia">
                                <label>Giá từ:</label>
                                <p class="card-text"><b>10.890.000 ₫</b></p>
                            </div>
                            <a href="#" class="btn btn-primary">Đặt ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec</h5>
                            <div class="map">
                                <i class="bi bi-geo-alt" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-qr-code-scan" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Mã tour: <b>PS36499</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: 03/08/2024</p>
                            </div>
                            <div class="gia">
                                <label>Giá từ:</label>
                                <p class="card-text"><b>10.890.000 ₫</b></p>
                            </div>
                            <a href="#" class="btn btn-primary">Đặt ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Đà Nẵng - Phố cổ Hội An - Cầu Vàng - KDL Bà Nà - Vườn Tượng Apec</h5>
                            <div class="map">
                                <i class="bi bi-geo-alt" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Khởi hành: <b>Tp. Hồ Chí Minh</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-qr-code-scan" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Mã tour: <b>PS36499</b></p>
                            </div>
                            <div class="map">
                                <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                <p class="card-text">Ngày đi: 03/08/2024</p>
                            </div>
                            <div class="gia">
                                <label>Giá từ:</label>
                                <p class="card-text"><b>10.890.000 ₫</b></p>
                            </div>
                            <a href="#" class="btn btn-primary">Đặt ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="" class=" them btn ">Xem tất cả</a>
        </div>
        <!-- Catagory-address -->
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

            <div class="row">
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
                </div>
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
                </div>
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
                </div>
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
                </div>
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
                </div>
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
                </div>
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
                </div>
                <div class="col-3">
                    <img src="../assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" alt="" style="height: 200px; width: 100%;">
                    <p>Địa điểm 1</p>
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
