@extends('client.layout.index')

@section('title')
Tour
@endsection

@section('main')
<section class="breadcrumb-option d-none">
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
<section class="shop spad mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <!-- Form tìm kiếm -->
                        <form action="{{ route('tour.search') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="{{ old('keyword') }}" class="form-control">
                                <button class="btn btn-outline-primary" type="summit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>

                        <!-- Hiển thị thông báo lỗi nếu có -->
                        @if (session('error'))
                        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif
                    </div>

                    <!-- Sidebar danh mục -->
                    <div class="bg-body p-2 mt-4">
                        <h4 class="text-center">Danh mục</h4>
                        <div class="categories">
                            <!-- Mục dành cho tour trong nước -->
                            <div class="border p-2 rounded mb-3">
                                <h5>Tour Trong Nước</h5>
                                <div class="list-group list-group-flush">
                                    @foreach ($categories as $category)
                                    @if ($category->tour_nuoc_ngoai == 0)
                                    {{-- is_nuocngoai = false: Tour trong nước --}}
                                    <a href="{{ route('tour.category', $category->id) }}" class="list-group-item list-group-item-action">
                                        {{ $category->ten_danh_muc }}
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Mục dành cho tour nước ngoài -->
                            <div class="border p-2 rounded">
                                <h5>Tour Nước Ngoài</h5>
                                <div class="list-group list-group-flush">
                                    @foreach ($categories as $category)
                                    @if ($category->tour_nuoc_ngoai == 1)
                                    {{-- is_nuocngoai = true: Tour nước ngoài --}}
                                    <a href="{{ route('tour.category', $category->id) }}" class="list-group-item list-group-item-action">
                                        {{ $category->ten_danh_muc }}
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tin tức -->
                    <div class="new mt-3 p-2">
                        <h4>Tin tức</h4>
                        <div class="row">
                            @if ($news->count() > 0)
                            @foreach ($news as $new)
                            <div class="card mb-3 ps-0 bg-light bg-opacity-75" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset('assets/image_new/' . $new->image_url) }}" class="h-100 w-100 object-fit-cover rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <a href="{{ route('client.tin_tuc_chi_tiet', $new->id) }}" class="text-decoration-none fw-medium text-body">{{ $new->title }}</a> <!-- Sửa từ $news->id thành $new->id -->
                                            </h6>
                                            <p class="card-text">
                                                <small class="text-body-secondary">
                                                    {{ $new->created_at ? $new->created_at->format('d/m/y') : '' }}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
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
                <form action="{{ route('tour.filter') }}" method="GET" class="d-flex mb-3">
                    <!-- Đảm bảo tham số category_id được gửi -->
                    <input type="hidden" name="category_id" value="{{ $category->id }}">

                    <!-- Lọc giá -->
                    <div class="me-3">
                        <label for="price_range" class="form-label">Lọc theo giá</label>
                        <select name="price_range" class="form-select form-select-sm price-range" onchange="this.form.submit()">
                            <option value="">Tất cả giá</option>
                            <option value="0-5000000" {{ request('price_range') == '0-5000000' ? 'selected' : '' }}>Dưới 5.000.000 &#8363;</option>
                            <option value="5000000-10000000" {{ request('price_range') == '5000000-10000000' ? 'selected' : '' }}>5.000.000 ₫ - 10.000.000 ₫</option>
                            <option value="10000000-20000000" {{ request('price_range') == '10000000-20000000' ? 'selected' : '' }}>10.000.000 ₫ - 20.000.000 ₫</option>
                            <option value="20000000-50000000" {{ request('price_range') == '20000000-50000000' ? 'selected' : '' }}>20.000.000 ₫ - 50.000.000 ₫</option>
                            <option value="50000000-" {{ request('price_range') == '50000000-' ? 'selected' : '' }}>Trên 50.000.000 ₫</option>
                        </select>
                    </div>

                    <!-- Lọc ngày -->
                    <div class="me-3">
                        <label for="start_date" class="form-label">Ngày đi</label>
                        <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}" onchange="this.form.submit()">
                    </div>

                    <!-- Lọc địa điểm -->
                    <div class="me-3">
                        <label for="location" class="form-label">Lọc theo địa điểm</label>
                        <select name="location" class="form-select form-select-sm" id="location" onchange="this.form.submit()">
                            <option value="">Tất cả địa điểm</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('location') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->ten_danh_muc }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>


                <!-- Danh sách tour -->
                <div class="row">
                    @if ($tours->count() > 0)
                    @foreach ($tours as $tour)
                    <div class="col-12 col-md-6 col-lg-4 mb-3 tour-hidden">
                        <div class="card text-bg-dark position-relative">
                            <div class="position-absolute start-0 d-none" style="top:5px;">
                                <svg width="80" height="40" viewBox="0 0 146 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M144 1H1V61H144L120.405 31L144 1Z" style="fill: var(--bs-primary);" />
                                </svg>
                                <span class="text-body position-absolute start-50 top-50 translate-middle">Mới</span>
                            </div>
                            <img src="assets/image_tour/{{ $tour->image_url }}" height="400px" class="card-img oject-fit-fill" alt="...">
                            <div class="card-img-overlay m-3 p-2 bg-body text-body" style="top:inherit">
                                <h5 class="card-title">
                                    <a href="/tour/{{ $tour->id }}" class="text-decoration-none text-body fs-6">
                                        {{ $tour->title }}
                                    </a>
                                </h5>
                                <div class="d-flex">
                                    <i class="bi bi-geo-alt"></i>
                                    <p class="card-text">Khởi hành: <b>{{ $tour->featured }}</b></p>
                                </div>
                                <div class="d-flex">
                                    <i class="bi bi-calendar3" style="margin-right: 5px; height: 20px;"></i>
                                    <p class="card-text">Ngày đi:
                                        <b>{{ optional($tour->ngayDi->first())->start_date ? \Carbon\Carbon::parse($tour->ngayDi->first()->start_date)->format('d/m/Y') : 'Chưa có ngày đi' }}</b>
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
                    <div class="col-12">
                        <p>Không tìm thấy kết quả nào.</p>
                    </div>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="container">
                    <div class="d-flex justify-content-center mt-4">
                        <div>
                            {{ $tours->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection