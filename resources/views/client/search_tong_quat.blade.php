@extends('client.layout.index')

@section('title')
Search Tổng Quát
@endsection
@section('main')
{{-- Search tổng quá, sử dụng lại sau --}}
<div class="container">
<nav class="navbar bg-body-tertiary ">
  <div class="container-fluid form justify-content-center align-items-center">
    <form class="d-flex" role="search" action="{{ route('search_tong_quat.search_all') }}" method="POST">
    @csrf
      <input class="form-control me-2 " type="text" name="keyword" placeholder="Tìm kiếm tổng quát" value="{{ old('keyword') }}">
      <button class="btn btn-warning" type="submit">SEARCH</button>
    </form>
    </div>
    <!-- Hiển thị thông báo lỗi nếu có -->
     <div class="col-sm-4 ">
        @if(session('error'))
            <div class="alert alert-danger mt-2 fw-bold fst-italic ">{{ session('error') }}</div>
        @endif
    </div>
  
</nav>
     
     
                        <!-- Show tour tổng quát -->
                        <div class="row">
                        <div class="d-flex justify-content-between align-items-end">
            <div class="d-flex flex-column text-body">
                <h2 class="">Tour Tổng Quát</h2>
                <hr class="m-0 mb-1 p-0 border-2" width="300px">
                <p class="text-body">Tổng hợp tất cả tour du lịch đang có trên website</p>
            </div>
        </div>
                    @if($search->count() > 0)
                    @foreach($search as $tour)
                    <div class="col-12 col-md-6 col-lg-4 col-xxl-4 mb-3">
                        <div class="card text-bg-dark position-relative">
                            <div class="position-absolute start-0" style="top:5px;">
                                <svg width="80" height="40" viewBox="0 0 146 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M144 1H1V61H144L120.405 31L144 1Z" style="fill: var(--bs-primary);" />
                                </svg>
                                <span class="text-body position-absolute start-50 top-50 translate-middle">Mới</span>
                            </div>
                            <img src="{{ asset('assets/image/'.$tour->image_url) }}" height="450px" class="card-img object-fit-fill" alt="...">
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
                                    <a href="#" class="btn btn-primary container-fluid">Đặt ngay</a>
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
                </div>
                
                    <!-- Show Tin Tức Tổng Quát -->
                    <div class="d-flex justify-content-between align-items-end">
            <div class="d-flex flex-column text-body">
                <h2 class="">TIN TỨC TỔNG QUÁT</h2>
                <hr class="m-0 mb-1 p-0 border-2" width="300px">
                <p class="text-body">Tổng hợp tất cả tin tức về các tour du lịch hiện có</p>
            </div>
        </div>
                        <div class="row">
                            @if($news->count() > 0)
                            @foreach($news as $new)
                            <div class="card col-sm-4 mb-3 p-3">
                                <img class="img-fluid " src="{{$new->image_url}}" alt="..." >
                                    <div class="card-body">
                                        <h5 class="card-title">{{$new->title}}</h5>
                                        <p class="card-text">{{$new->description}}</p>
                                        <p class="card-text"><small class="text-body-secondary fw-bold fst-italic">Số lượt xem: <i class="bi bi-eye"></i> {{$new->reading}}</small></p>
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




    @endsection