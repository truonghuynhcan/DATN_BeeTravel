@extends('client.layout.index')
@section('title')
    Tin tức chi tiết
@endsection
@section('main')
<!-- Header/ Tiêu đề tin tức -->
<section class="container mt-4">
    <div class="row">
        <div class="col-md-9">
            <h1 class="fw-bold">{{$newShow->title}}</h1>
            <p class="text-muted">Đăng bởi Tác giả | 14/10/2024</p>
            <img src="{{$newShow->image_url}}" alt="Resort 5 Sao" class="img-fluid mb-4">
            <!-- <p class="text-muted">Ảnh: Nguồn</p> -->

            <!-- Nội dung tin tức -->
            <article class="mb-5">
            @foreach($newShow->content as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
                
            </article>

            <!-- Chia sẻ mạng xã hội -->
            <div class="mb-4">
                <h5 class="fw-bold">Chia sẻ bài viết:</h5>
                <button class="btn btn-primary btn-sm me-2">Facebook</button>
                <button class="btn btn-info btn-sm me-2">Twitter</button>
                <button class="btn btn-danger btn-sm">Email</button>
            </div>

            <!-- Bài viết liên quan -->
            <div>
                <h4 class="fw-bold">Tin liên quan</h4>
                <div class="row">
                    @foreach($news as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{$item->image_url}}" class="card-img-top" alt="Tin liên quan 1">
                            <div class="card-body">
                                <h6 class="card-title">{{$item->title}}</h6>
                                <p class="card-text">{{$item->description}}</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar: Tin nổi bật -->
        <div class="col-md-3">
            <h4 class="fw-bold">Tin nổi bật</h4>
            <div class="list-group mb-4">
                <a href="#" class="list-group-item list-group-item-action">
                    <h6 class="mb-1">Tiêu đề tin nổi bật 1</h6>
                    <small>14/10/2024</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h6 class="mb-1">Tiêu đề tin nổi bật 2</h6>
                    <small>14/10/2024</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h6 class="mb-1">Tiêu đề tin nổi bật 3</h6>
                    <small>14/10/2024</small>
                </a>
            </div>

            <!-- Quảng cáo (Placeholder) -->
            <div class="mb-4">
                <img src="{{$newShow->image_url}}" class="img-fluid" alt="Quảng cáo">
            </div>
        </div>
    </div>
</section>


@endsection