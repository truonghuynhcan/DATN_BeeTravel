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
    <img src="../assets/image/contact.jpg" class="card-img object-fit-cover" height="200px" alt="...">
    <div class="card-img-overlay bg-black bg-opacity-50 d-flex flex-column justify-content-center align-items-center">
        <h2 class="card-title">Trang tin tức</h2>
        <p class="card-text">This is a breadcrumb.</p>
    </div>
</div>

<!-- category -->
<section class="container mt-4">
    @foreach($categories as $item)
        <a href="{{ route('categories',  $item->id) }}" class="me-2 fs-2 fw-bold text-body text-decoration-none position-relative ps-2">{{ $item->title }}</a>
    @endforeach
    <hr class="m-0 p-0">
</section>


<!-- nội dung -->
<section class="container my-4">
    @foreach($news as $item)
    <div class="row">
        <div class="col-9 border-end ">
            <div class="card text-center">
            <a href="/tin_tuc_chi_tiet/{{$item->category_id}}">
            <img src="{{ asset($item->image_url) }}" class="card-img-top" height="400px" alt="...">
            </a>
                <div class="card-body">
                    <h5 class="card-title">{{$item->title}}</h5>{{$item->description}}</p>
                </div>
            </div> 
        </div>
        @endforeach
        
        <div class="col-3">
        @foreach($reading as $item)
            <div class="card text-center mb-3">
                <img src="{{ asset($item->image_url) }}" class="card-img-top object-fit-cover" height="165px" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                </div>
            </div>
        @endforeach
</div>
        
    </div>
   
    <hr>

</section>


<!-- banner tin tức -->
<section class="mb-4">
    <img src="../assets/image/contact.jpg" alt="" height="200px" width="100%" class="object-fit-cover">
</section>

<!-- danh mục tin tức -->
<section class="container">
    <div class="row">
    @foreach($news as $item)
        <div class="col-9">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{asset($item->image_url)}}" height="100%" width="100%" class="object-fit-cover rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->title}}</h5>
                            <p class="card-text">{{$item->description}}</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @foreach($reading as $item)
        <div class="col-3">
            <div class="card mb-3 bg-body-secondary bg-opacity-10 border-0">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{asset($item->image_url)}}" height="100%" width="100%" class="object-fit-cover " alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-1">
                            <h5 class="card-title h6 mb-1">{{$item->title}}</h5>
                            <span>{{$item->reading}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <hr>
        </div>
    </div>
</section>
@endsection