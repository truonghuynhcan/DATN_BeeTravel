@extends('client.layout.index')
@section('title')
    Tin tức
@endsection
@section('main')
    <style>
        a.fs-2::before {
            content: "";
            width: 4px;
            height: 1.5rem;
            background: #ed1c24;
            position: absolute;
            left: 0;
            top: 0.75rem;
        }
    </style>
    <!-- head tin tức -->
    <div class="card text-bg-dark">
        <img src="{{ asset('assets/image_new/contact.jpg') }}" class="card-img object-fit-cover" height="200px" alt="...">
        <div class="card-img-overlay bg-black bg-opacity-50 d-flex flex-column justify-content-center align-items-center">
            <h2 class="card-title">Trang tin tức</h2>
            <p class="card-text">This is a breadcrumb.</p>
        </div>
    </div>

    <!-- category -->
    <section class="container mt-4">
        <a href="{{ route('news') }}" class=" me-2 fs-2 fw-bold text-body text-decoration-none position-relative ps-2">DU LỊCH</a>
        @foreach ($categories as $item)
            <a href="{{ route('categories', $item->id) }}" class=" me-2 fw-bold pb-1 link-body-emphasis opacity-75 text-decoration-none">{{ $item->title }}</a>
        @endforeach
        <hr class="m-0 p-0">
    </section>


    <!-- nội dung -->
    <section class="container my-4">
        @foreach ($news as $item)
            <div class="row">
                <div class="col-9 border-end ">
                    <div class="card text-center">
                        <a href="/tin_tuc_chi_tiet/{{ $item->category_id }}">
                            <img src=" {{ asset('assets/image_new/' . $item->image_url) }}" class="card-img-top" height="400px" alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
        @endforeach

        <div class="col-3">
            @foreach ($reading as $item)
                <div class="card text-center mb-3">
                    <img src="{{ asset('assets/image_new/' . $item->image_url) }}" class="card-img-top object-fit-cover" height="165px" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                    </div>
                </div>
            @endforeach

    </section>

    <!-- TIN TỨC NỔI BẬT -->
    <section class="py-4 bg-body">
        <div class="container mb-3">
            <!-- tin tức mới -->
            <div class="row">
                <div>
                    <div class="yeuthich">
                        <h3>TIN TỨC MỚI</h3>
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
                                        <img src="{{ asset('assets/image_new/' . $item->image_url) }}" class="card-img-top" alt="Tin tức nổi bật" style="object-fit: cover; height: 200px;"> <!-- Đặt chiều cao cố định cho hình ảnh -->
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


@endsection
