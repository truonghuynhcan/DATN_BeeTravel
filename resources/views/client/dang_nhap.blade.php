@extends('client.layout.index')
@section('title')
    Đăng nhập
@endsection
@section('main')
<div class="container">
        <div class="row">
            <div class="col-7 p-lg-3">
                <button type="button" class="btn-close" aria-label="Close"></button>
                <p class="text-center text-uppercase fs-4 fst-italic p-4"><b>Đăng Nhập</b></p>
                <form action="" method="post">
                    @csrf
                <div class="row">
                <div class="col-3"></div>
                <div class="col-6 ">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email Đăng Nhập: </label>
                    <input type="email" name='email' class="form-control border-secondary" id="formGroupExampleInput" placeholder="Tên đăng nhập">
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Mật Khẩu: </label>
                    <input type="password" name='password' class="form-control border-secondary" id="formGroupExampleInput2" placeholder="Mật Khẩu">
                  </div>
                  
                  <div class="form-check ">
                    <input class="form-check-input border-secondary" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Ghi Nhớ Mật Khẩu
                    </label>
                  </div>
                  <div class="row p-lg-3">
                    <div class="d-grid gap-2 col-6 mx-auto text-end ">
                        <p class="text-decoration-none">Chưa Có Tài Khoản!</p>
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto text-start">
                        <a href="{{ route('register') }}" class="text-decoration-none">Đăng Ký </a>
                    </div>
                  </div>
                  <div class="d-grid gap-2 col-6 mx-auto pt-3">
                    <button class="btn btn-primary rounded-pill" type="submit">Đăng Nhập</button>
                  </div>
                </div>
                <div class="col-3"></div>
                @if($errors->any())
<ul>
@foreach ($errors->all() as $error)
<li style="color:red">{{$error}}</li>
@endforeach
</ul>
@endif
</form>
            </div>
            </div>
            <div class="col-5">
                <img src="../assets/image/proxy-image.jpg" class="rounded-start-pill" alt="..." width="530px" height="570px">
            </div>
        </div>
    </div>
    
     
    
     <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
