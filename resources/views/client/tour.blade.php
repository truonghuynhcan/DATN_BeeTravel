@extends('client.layout.index')
@section('title')
Tour
@endsection
@section('main')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h1>Tour</h1>
                    <hr>
                    <div class="breadcrumb__links mb-3 d-flex">
                        <a href="./index.html">Home</a>
                        <p>\</p>
                        <span>Tour</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input class="rounded-pill" type="text" placeholder="Search...">
                            <button class="rounded-circle" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion mt-3">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading p-2">
                                    <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                </div>
                                <div id="collapseOne" class="collapse show p-2" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach($categories as $category)
                                                <li><a href="{{ $category->url }}">{{ $category->ten_danh_muc }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option mb-3">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <div class="shop__product__option__left">
                                <p>Hiển thị 1–12 của 126 Tour</p>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <div class="shop__product__option__right">
                                <p>Lọc theo giá:</p>
                                <select class="rounded-3">
                                    <option value="">Tất cả</option>
                                    <option value="">1triệu VND - 5triệu VND</option>
                                    <option value="">6triệu VND - 10triệu VND</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($tours as $tour)
                    <div class="col-12 col-md-6 col-lg-4 col-xxl-4 mb-3">
                        <div class="card text-bg-dark position-relative">
                            <div class="position-absolute start-0" style="top:5px;">
                                <svg width="80" height="40" viewBox="0 0 146 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M144 1H1V61H144L120.405 31L144 1Z" style="fill: var(--bs-primary);" />
                                </svg>
                                <span class="text-body position-absolute start-50 top-50 translate-middle">Mới</span>
                            </div>
                            <img src="{{asset('')}}assets/image_tour/{{$tour->image_url}}" height="350px" class="card-img oject-fit-fill" alt="...">
                            <div class="card-img-overlay m-3 p-2 bg-body text-body" style="top:inherit">
                                <h5 class="card-title">
                                    <a href="{{route('chitiet',$tour->slug)}}" class="text-decoration-none text-body fs-6">
                                        {{$tour->title}}
                                    </a>
                                </h5>
                                <div class="d-flex">
                                    <i class="bi bi-geo-alt"></i>
                                    <p class="card-text">Khởi hành: <b>{{$tour->featured}}</b></p>
                                </div>
                                <div class="d-flex">
                                    <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                    <p class="card-text">Ngày đi: <b>{{$tour->featured_start}}</b></p>
                                </div>
                                <div class="d-flex ">
                                <p><span class="card-text" id="priceDisplay"><b class=" text-danger">{{ number_format($tour->ngayDi->first()->price, 0, ',', '.') }} VNĐ</b></span></p>
                                    <!-- <p class="card-text">Giá: <b class=" text-danger">10.890.000 ₫</b></p> -->
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary container-fluid">Đặt ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection