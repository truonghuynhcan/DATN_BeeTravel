@extends('client.layout.index')
@section('title')
Trang chủ
@endsection
@section('main')

<!-- BANNER SLIDER -->
<section class="bg-body py-4">
    <div class="container py-2">
        <div class="row banner-img">
            <div class="col-md-8 mb-3 shadow">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('') }}assets/image/trangchu-banner-03.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('') }}assets/image/trangchu-banner-02.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('') }}assets/image/trangchu-banner-01.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-4 mb-3" id="banner-left">

                <form action="{{route('tour.search')}}" method="post">
                    @csrf
                    <!-- Input để người dùng nhập từ khóa -->
                    <input type="text" value="đảo" name="keyword" hidden required />

                    <!-- Loại post (ẩn) -->
                    <input type="hidden" name="type" value="tour" />

                    <!-- Nút gửi form -->
                    <button type="submit" class="btn p-0 m-0 ">
                        <img class="shadow rounded" src="{{ asset('') }}assets/image/trangchu-banner-04.jpg" alt="" style="height: 195px; width: 100%;">
                    </button>
                </form>

                {{-- banner 5 đi vịnh hạn logn --}}
                <a href="{{ route('tour.category', 21) }}">
                    <img class="shadow rounded" src="{{ asset('') }}assets/image/trangchu-banner-05.jpg" alt="" style="height: 195px; width: 100%; margin-top: 10px;">
                </a>
            </div>
        </div>
    </div>
    <script>
        function syncBannerHeight() {
            const bannerLeft = document.getElementById('banner-left');
            const carousel = document.getElementById('carouselExampleAutoplaying');
            const carouselImages = carousel.querySelectorAll('img');

            if (bannerLeft && carousel) {
                // Đợi hình ảnh của banner-left tải xong
                const images = bannerLeft.querySelectorAll('img');
                const allImagesLoaded = Array.from(images).every(img => img.complete && img.naturalHeight !== 0);

                if (allImagesLoaded) {
                    // Lấy chiều cao thực tế của banner-left
                    const bannerLeftHeight = bannerLeft.offsetHeight;

                    // Cập nhật chiều cao của carousel
                    carousel.style.height = bannerLeftHeight + 'px';

                    // Cập nhật chiều cao của tất cả hình ảnh trong carousel
                    carouselImages.forEach(img => {
                        img.style.height = bannerLeftHeight + 'px';
                        img.style.objectFit = 'cover'; // Đảm bảo hình ảnh không bị méo
                    });
                } else {
                    // Nếu ảnh chưa tải xong, thử lại sau một khoảng thời gian ngắn
                    setTimeout(syncBannerHeight, 100);
                }
            }
        }

        // Gọi hàm khi DOM đã tải
        document.addEventListener('DOMContentLoaded', syncBannerHeight);

        // Gọi lại khi kích thước cửa sổ thay đổi
        window.addEventListener('resize', syncBannerHeight);
    </script>

    <style>
        /* Đảm bảo hình ảnh trong carousel luôn điều chỉnh */
        #carouselExampleAutoplaying img {
            width: 100%;
            /* Đảm bảo luôn chiếm toàn bộ chiều rộng */
        }
    </style>
</section>




<nav class="navbar bg-body-tertiary ">
    <div class="container-fluid form justify-content-center align-items-center">
        <form class="d-flex" role="homesearch" action="{{ route('search_homefull.homesearch_all') }}" method="POST">
            @csrf
            <input class="form-control me-2 " type="text" name="keyword" placeholder="Tìm kiếm tổng quát" value="{{ old('keyword') }}">
            <button class="btn btn-warning" type="submit">SEARCH</button>
        </form>
    </div>
    <!-- Hiển thị thông báo lỗi nếu có -->
    <div class="col-sm-4 ">
        @if (session('error'))
        <div class="alert alert-danger mt-2 fw-bold fst-italic ">{{ session('error') }}</div>
        @endif
    </div>

</nav>

<!-- TOUR NỔI BẬT -->
<section class=" py-4 bg-body">
    <div class="container">

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
        <div class="row" id="tourCards">
            @if ($tours->count() > 0)
            @foreach ($tours as $tour)
            <div class="col-12 col-md-6 col-lg-3 col-xxl-3 mb-3 tour-hidden tour-card" data-position="{{ $tour->featured }}" data-end-date="{{ $tour->featured_end }}" data-start-date="{{ $tour->featured_start }}">
                <div class="card text-bg-dark position-relative">
                    <div class="d-none position-absolute start-0" style="top:5px;">
                        <svg width="80" height="40" viewBox="0 0 146 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M144 1H1V61H144L120.405 31L144 1Z" style="fill: var(--bs-primary);" />
                        </svg>
                        <span class="text-body position-absolute start-50 top-50 translate-middle">Mới</span>
                    </div>
                    <img src="assets/image_tour/{{ $tour->image_url }}" height="450px" class="card-img oject-fit-fill" alt="...">
                    <div class="card-img-overlay m-3 p-2 bg-body text-body" style="top:inherit">
                        <h5 class="card-title">
                            <a href="{{route('tour_chi_tiet',  $tour->id)}}" class="text-decoration-none text-body fs-6">
                                {{ $tour->title }}
                            </a>
                        </h5>
                        <div class="d-flex">
                            <i class="bi bi-geo-alt"></i>
                            <p class="card-text">Khởi hành: <b>{{ $tour->noi_khoi_hanh }}</b></p>
                        </div>
                        <div class="d-flex">
                            <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                            <p class="card-text">Ngày đi:
                                <b>{{ optional($tour->ngayDi->first())->start_date ? \Carbon\Carbon::parse($tour->ngayDi->first()->start_date)->format('d/m/Y') : 'Chưa có ngày đi' }}</b>
                            </p>
                        </div>
                        <div class="d-flex">
                            <i class="fa-regular fa-clock" style="margin-right: 5px; margin-top: 3px;"></i>
                            <p class="card-text">
                                @if(!empty($tour->duration))
                                <b>{{ $tour->duration }}</b>
                                @else
                                <span>Chưa có thông tin</span>
                                @endif
                            </p>
                        </div>
                        <div class="d-flex">
                            <p class="card-text">Giá:
                                <b class="text-danger">
                                    {{ $tour->ngayDi->min('price') ? number_format($tour->ngayDi->min('price')) . ' ₫' : 'Liên hệ' }}
                                </b>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('thanh_toan', $tour->id) }}" class="btn btn-primary container-fluid">Đặt ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="container p-3">
                <div class="row">
                    <div class="alert alert-warning text-center">
                        <p class="fw-bold fst-italic">Không tìm thấy tour bạn vừa nhập. </p>
                    </div>
                </div>
            </div>
            @endif
            <a href="{{ route('tour') }}" class=" them btn ">Xem tất cả</a>
        </div>
    </div>
</section>

<!-- TOUR MỚI NHẤT -->
<section class="py-4 bg-body-secondary">
    <div class="container">

        <div class="d-flex justify-content-between align-items-end">
            <div class="d-flex flex-column text-body">
                <h2 class="">TOUR MỚI NHẤT</h2>
                <hr class="m-0 mb-1 p-0 border-2" width="300px">
                <p class="text-body">Cập nhật những thông tin mới để không bỏ lỡ những chuyến đi mới!</p>
            </div>
        </div>
        <div class="row">
        @if($tours_moinhat->count() > 0)
            @foreach ($tours_moinhat as $tour)
            <div class="col-12 col-md-6 col-lg-3 col-xxl-3 mb-3">
                <div class="card text-bg-dark position-relative">
                    <div class="position-absolute start-0" style="top:5px;">
                        <svg width="80" height="40" viewBox="0 0 146 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M144 1H1V61H144L120.405 31L144 1Z" style="fill: var(--bs-primary);" />
                        </svg>
                        <span class="text-body position-absolute start-50 top-50 translate-middle">Mới</span>
                    </div>
                    <img src="{{ asset('') }}assets/image_tour/{{ $tour->image_url }}" height="450px" class="card-img oject-fit-fill" alt="...">
                    <div class="card-img-overlay m-3 p-2 bg-body text-body" style="top:inherit">
                        <h5 class="card-title">
                            <a href="{{ route('tour_chi_tiet', $tour->id) }}" class="text-decoration-none text-body fs-6">
                                {{ $tour->title }}
                            </a>
                        </h5>
                        <div class="d-flex">
                            <i class="bi bi-geo-alt"></i>
                            <p class="card-text">Khởi hành tại: <b>{{ $tour->noi_khoi_hanh }}</b></p>
                        </div>
                        <div class="d-flex">
                            <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                            <b>{{ optional($tour->ngayDi->first())->start_date ? \Carbon\Carbon::parse($tour->ngayDi->first()->start_date)->format('d/m/Y') : 'Chưa có ngày đi' }}</b>
                        </div>
                        <div class="d-flex">
                            <i class="fa-regular fa-clock" style="margin-right: 5px; margin-top: 3px;"></i>
                            <p class="card-text">
                                @if(!empty($tour->duration))
                                <b>{{ $tour->duration }}</b>
                                @else
                                <span>Chưa có thông tin</span>
                                @endif
                            </p>
                        </div>
                        <div class="d-flex">
                            <p class="card-text">Giá:
                                <b class="text-danger">
                                    {{ $tour->ngayDi->min('price') ? number_format($tour->ngayDi->min('price')) . ' ₫' : 'Liên hệ' }}
                                </b>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('thanh_toan', $tour->id) }}" class="btn btn-primary container-fluid">Đặt ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="container p-3">
                <div class="row">
                    <div class="alert alert-warning text-center">
                        <p class="fw-bold fst-italic">Không tìm thấy tour bạn vừa nhập. </p>
                    </div>
                </div>
            </div>
            @endif
            <a href="{{ route('tour') }}" class=" them btn d-none">Xem tất cả</a>
        </div>
    </div>
</section>

<!-- product feature end -->



<!-- Catagory-address -->

<section class="py-4 bg-body">
    <div class="container mb-3">
        <!-- tin tức mới -->
        <div class="row">
            <div>
                <div class="yeuthich">
                    <h3>TIN TỨC NỔI BẬT</h3>
                    <hr class="short-line">
                    <div class="button-container">
                        <!-- <button class="muiten"><i class="bi bi-arrow-left"></i></button>
                                                    <button class="muiten"><i class="bi bi-arrow-right"></i></button> -->
                    </div>
                </div>

                <div class="row" id="tourNews">
                    @if ($latestNews->count() > 0)
                    @foreach ($latestNews as $item)
                    <div class="col-md-3 mb-3 tour-new" data-position="{{ $item->reading }}"> <!-- Sử dụng col-md-3 để có 4 ô trên một hàng -->
                        <div class="card h-100"> <!-- H-100 để các card có chiều cao bằng nhau -->
                            <img src="assets/image_new/{{ $item->image_url }}" class="card-img-top" alt="Tin tức nổi bật" style="object-fit: cover; height: 200px;"> <!-- Đặt chiều cao cố định cho hình ảnh -->
                            <div class="card-body d-flex flex-column"> <!-- Sử dụng flex để căn chỉnh nội dung -->
                                <h6 class="card-title">{{ $item->title }}</h6>
                                <p class="card-text">{{ $item->description }}</p>
                                <a href="{{ route('client.tin_tuc_chi_tiet', $item->id) }}" class="btn btn-sm btn-outline-primary mt-auto">Đọc thêm</a> <!-- Nút ở dưới cùng -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="container p-3">
                        <div class="row">
                            <div class="alert alert-warning text-center">
                                <p class="fw-bold fst-italic">Không tìm thấy tin tức nào như bạn đã tìm kiếm hiện tại. </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DANH MỤC - ĐIỂM ĐẾN YÊU THÍCH -->
<div class="yeuthich">
    <h3>ĐIỂM ĐẾN YÊU THÍCH</h3>
    <hr class="short-line">
    <p>Hãy chọn một điểm đến du lịch nổi tiếng dưới đây để khám phá các chuyến đi độc quyền của chúng tôi với
        mức giá vô cùng hợp lý.</p>
    <div class="address">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-truong-nuoc-tab" data-bs-toggle="pill" data-bs-target="#pills-truong-nuoc" type="button" role="tab" aria-controls="pills-truong-nuoc" aria-selected="true">Trong nước</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-nuocngoai-tab" data-bs-toggle="pill" data-bs-target="#pills-nuocngoai" type="button" role="tab" aria-controls="pills-nuocngoai" aria-selected="false">Nước Ngoài</button>
            </li>
        </ul>
    </div>

    <div class="tab-content container" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-truong-nuoc" role="tabpanel" aria-labelledby="pills-truong-nuoc-tab">
            <div class="row">
                @foreach ($categories as $category)
                @if ($category->tour_nuoc_ngoai == 0)
                {{-- is_nuocngoai = false: Tour trong nước --}}
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card text-bg-dark">
                        <img src="{{ asset('') }}assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" height="200px" class="card-img object-fit-fill" alt="...">
                        <div class="card-img-overlay bg-black bg-opacity-50 d-flex justify-content-center align-items-center">
                            <li><a href="{{ route('tour.category', $category->id) }}">{{ $category->ten_danh_muc }}</a></li>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="pills-nuocngoai" role="tabpanel" aria-labelledby="pills-nuocngoai-tab">
            <div class="row">
                @foreach ($categories as $category)
                @if ($category->tour_nuoc_ngoai == 1)
                {{-- is_nuocngoai = false: Tour trong nước --}}
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card text-bg-dark">
                        <img src="{{ asset('') }}assets/image/64114914e5a8ec33c25f2e2407db47a5.jpg" height="200px" class="card-img object-fit-fill" alt="...">
                        <div class="card-img-overlay bg-black bg-opacity-50 d-flex justify-content-center align-items-center">
                            <li><a href="{{ route('tour.category', $category->id) }}">{{ $category->ten_danh_muc }}</a></li>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<section>
    <div class="dichvu container">
        <div class="row">
            <div class="mb-3 col-md-3 col-sm-6 col-xs-12">
                <div class="card h-100 mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-hand-index-thumb fs-1 text-danger"></i>
                            {{-- <img src="..." class="img-fluid rounded-start" alt="..."> --}}
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title text-danger fw-bold">GIÁ TỐT-NHIỀU ƯU ĐÃI</h5>
                                <p class="card-text fw-medium">Ưu đãi và quà tặng hấp dẫn khi đặt ngay hôm nay</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-3 col-sm-6 col-xs-12">
                <div class="card h-100 mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart4 fs-1 text-danger"></i>
                            {{-- <img src="..." class="img-fluid rounded-start" alt="..."> --}}
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title text-danger fw-bold">THANH TOÁN AN TOÀN</h5>
                                <p class="card-text fw-medium">Được bào mật một cách nghiêm ngặt</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-3 col-sm-6 col-xs-12">
                <div class="card h-100 mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-pencil fs-1 text-danger"></i>
                            {{-- <img src="..." class="img-fluid rounded-start" alt="..."> --}}
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title text-danger fw-bold">TƯ VẤN MIỄN PHÍ</h5>
                                <p class="card-text fw-medium">Hỗ trợ tư vấn online tư vấn miễn phí</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-3 col-sm-6 col-xs-12">
                <div class="card h-100 mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-star fs-1 text-danger"></i>
                            {{-- <img src="..." class="img-fluid rounded-start" alt="..."> --}}
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title text-danger fw-bold">THƯƠNG HIỆU UY TÍN</h5>
                                <p class="card-text fw-medium">Thương hiệu lữ hành hàng đầu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="commitment-box mb-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-hand-index-thumb"></i>
                        <div>
                            <span>GIÁ TỐT-NHIỀU ƯU ĐÃI</span>
                            <p>Ưu đãi và quà tặng hấp dẫn khi mua tuor online</p>
                        </div>
                    </div>
                </div>
                <div class="commitment-box mb-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-cart4"></i>
                        <div>
                            <span>THANH TOÁN AN TOÀN</span>
                            <p>Được bào mật một cách nghiêm ngặt</p>
                        </div>
                    </div>
                </div>
                <div class="commitment-box mb-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-pencil"></i>
                        <div>
                            <span>TƯ VẤN MIỄN PHÍ</span>
                            <p>Hỗ trợ tư vấn online tư vấn miễn phí</p>
                        </div>
                    </div>
                </div>
                <div class="commitment-box mb-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="commitment">
                        <i class="bi bi-star"></i>
                        <div>
                            <span>THƯƠNG HIỆU UY TÍN</span>
                            <p>Thương hiệu lữ hành hàng đầu</p>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>
</section>
<!-- dichvukhac -->



{{-- Liên hệ --}}
<style>
    .contact-container {
        position: relative;
        width: 70%;
        max-width: 1200px;
        background: rgba(6, 121, 159, 0.892);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        margin: 30px auto;
    }

    .contact-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
    }

    .contact-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.5;
    }

    .contact-content {
        position: relative;
        z-index: 2;
        display: flex;
        gap: 20px;
        padding: 20px;
    }

    .contact-info,
    .contact-form {
        flex: 1;
        padding: 20px;
        color: #fff;
    }

    .contact-info {
        border-right: 1px solid rgba(255, 255, 255, 0.3);
    }

    .contact-info h2,
    .contact-form h2 {
        margin-bottom: 15px;
        color: #fff;
    }

    .contact-form .form-group {
        margin-bottom: 15px;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .contact-form button {
        padding: 10px 170px;
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .contact-form button:hover {
        background-color: #0056b3;
    }

    #map-container {
        width: 70%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: rgba(173, 216, 230, 0.7);
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
    }

    #map {
        border-radius: 10px;
    }
</style>
<div class="contact-container">
    <div class="contact-background">
        <img src="{{ asset('') }}assets/image/contact.jpg" alt="Contact Background">
    </div>
    <div class="contact-content">
        <div class="contact-info">
            <h2>BEE TRAVEL</h2>
            <p><strong>Địa chỉ:</strong> QTSC 1, Phường Tân Chánh Hiệp, Quận 12, TP.HCM</p>
            <p><strong>Website:</strong> beetravel.com</p>
            <p><strong>Email:</strong> info@beetravel.com</p>
            <p><strong>Điện thoại:</strong> 0123 456 789</p>
        </div>
        <div class="contact-form">
            <h2>Liên hệ với chúng tôi</h2>
            @if (!empty($data))
            <h1>{{ $data['title'] }}</h1>
            <p><strong>Tên:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Nội dung:</strong> {{ $data['message'] }}</p>
            @endif
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="message">Nội dung</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary container-fluid">Gửi thông tin</button>
            </form>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
    </div>

</div>
@endsection