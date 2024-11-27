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
                        <a href="{{ route('home') }}">Home</a>
                        <p>\</p>
                        <span>Tour</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <!-- Form tìm kiếm -->
                        <form action="{{ route('tour.search') }}" method="POST">
                            @csrf
                            <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="{{ old('keyword') }}">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>

                        <!-- Hiển thị thông báo lỗi nếu có -->
                        @if(session('error'))
                        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div>

                    <!-- Sidebar danh mục -->
                    <div class="shop__sidebar__accordion mt-3">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading p-1 text-center">
                                    <h4><a data-toggle="collapse" data-target="#collapseOne">Danh mục</a></h4>
                                </div>
                                <div id="collapseOne" class="collapse show " data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach($categories as $category)
                                                <li><a href="{{ route('tour.category', $category->id) }}">{{ $category->ten_danh_muc }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <style>
                                        .shop__sidebar__categories ul li a {
                                            text-decoration: none;
                                            color: inherit;
                                            padding: 5px;
                                            display: inline-block;
                                            transition: border 0.3s ease, color 0.3s ease;
                                        }

                                        .shop__sidebar__categories ul li a:hover {
                                            border: 1px solid #007bff;
                                            border-radius: 4px;
                                            color: #007bff;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tin tức -->
                    <div class="new">
                        <h4>Tin tức</h4>
                        <div class="row">
                            @if($news->count() > 0)
                            @foreach($news as $new)
                            <div>
                                <div class="new__item">
                                    <a href="{{ route('client.tin_tuc_chi_tiet', $new->id) }}"> <!-- Sửa từ $news->id thành $new->id -->
                                        <img src="{{ asset('assets/image/'.$new->image_url) }}" alt="" class="img-fluid"> <!-- Sửa thuộc tính hinh_anh thành image_url -->
                                    </a>
                                    <div class="new__item__text">
                                        <h5>
                                            <a href="{{ route('client.tin_tuc_chi_tiet', $new->id) }}">{{ $new->title }}</a> <!-- Sửa từ $news->id thành $new->id -->
                                        </h5>
                                    </div>
                                    <div class="new__item__date">
                                        {{ $new->created_at ? $new->created_at->format('d/m/Y') : 'N/A' }}
                                    </div>
                                    <style>
                                        .new__item__text a{
                                            text-decoration: none;
                                            color: black;
                                        }
                                        .new__item__text a:hover{
                                            color: #ffc107;
                                        }
                                    </style>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-12">
                                <p>Không có tin tức nào.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <!-- Phần lọc tour -->
                <div class="shop__filter mb-3">
                    <form action="{{ route('tour.filter') }}" method="GET" class="d-flex ms-auto" style="width: 30%;">
                        <select name="price_range" class="form-select me-2">
                            <option value="">Tất cả giá</option>
                            <option value="1-5" {{ request('price_range') == '1-5' ? 'selected' : '' }}>1 triệu VND - 5 triệu VND</option>
                            <option value="6-10" {{ request('price_range') == '6-10' ? 'selected' : '' }}>6 triệu VND - 10 triệu VND</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Lọc</button>
                    </form>
                </div>

                <!-- Danh sách tour -->
                <div class="row">
                    @if($tours->count() > 0)
                    @foreach($tours as $tour)
                    <div class="col-12 col-md-6 col-lg-4 col-xxl-4 mb-3">
                        <div class="card text-bg-dark position-relative">
                            <div class="position-absolute start-0" style="top:5px;">
                                <svg width="80" height="40" viewBox="0 0 146 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M144 1H1V61H144L120.405 31L144 1Z" style="fill: var(--bs-primary);" />
                                </svg>
                                <span class="text-body position-absolute start-50 top-50 translate-middle">Mới</span>
                            </div>
                            <img src="{{ asset('assets/image_tour/'.$tour->image_url) }}" height="450px" class="card-img object-fit-fill" alt="...">
                            <div class="card-img-overlay m-3 p-2 bg-body text-body" style="top:inherit">
                                <h5 class="card-title">
                                    <a href="/tour/{{$tour->id}}" class="text-decoration-none text-body fs-6">
                                        {{$tour->title ?? 'Không có tiêu đề' }}
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
                                <div class="d-flex">
                                    <p class="card-text">Giá: <b class="text-danger">{{ number_format($tour->price, 0, ',', '.') }} ₫</b></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{route('thanh_toan',$tour->id)}}" class="btn btn-primary container-fluid">Đặt ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-12">
                        <p>Không tìm thấy kết quả nào.</p>
                    </div>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                Trang {{ $tours->currentPage() }} / {{ $tours->lastPage() }}
                            </div>
                            <div>
                                {{ $tours->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection