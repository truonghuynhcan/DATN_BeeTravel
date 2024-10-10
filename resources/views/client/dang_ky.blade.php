@extends('client.layout.index')
@section('title')
    Đăng ký
@endsection
@section('main')
<div class="container">
        <div class="row">
            <div class="col-5 p-3">
                <img src="../assets/image/proxy-image.jpg" class="rounded-end-circle" alt="..." width="590px" height="640px">
            </div>
            <div class="col-7 p-lg-3">
                <!-- <button type="button" class="btn-close" aria-label="Close"></button> -->
                <p class="text-center text-uppercase fs-4 fst-italic p-4"><b>Đăng Ký</b></p>
                
                <div class="row">
                <div class="col-3"></div>
                <div class="col-6 ">
                <form action="" method="post">
                @csrf
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Tên Đăng Nhập: </label>
                    <input type="text" name='name' class="form-control border-secondary" id="formGroupExampleInput" placeholder="Tên đăng nhập" value='{{old('name')}}'>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Mật Khẩu: </label>
                    <input  type="password" name='password' class="form-control border-secondary" id="formGroupExampleInput2" placeholder="Mật Khẩu" value='{{old('password')}}'>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email: </label>
                    <input type="email" name='email' class="form-control border-secondary" id="formGroupExampleInput" placeholder="Email" value='{{old('email')}}'>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Số điện thoại: </label>
                    <input type="phone" name='phone' class="form-control border-secondary" id="formGroupExampleInput2" placeholder="Số điện thoại" value='{{old('phone')}}'>
                  </div>
                  @if($errors->any())
<ul>
@foreach ($errors->all() as $error)
<li style="color:red">{{$error}}</li>
@endforeach
</ul>
@endif
                  <!-- <div class="form-check ">
                    <input class="form-check-input border-secondary" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Ghi Nhớ Mật Khẩu
                    </label>
                  </div> -->
                  <div class="row p-lg-3">
                    <div class="d-grid gap-2 col-6 mx-auto text-end ">
                        <p class="text-decoration-none">Đã Có Tài Khoản!</p>
                    </div>

                    <div class="d-grid gap-2 col-4 mx-auto text-start">
                        <a href="{{ route('login') }}" class="text-decoration-none">Đăng Nhập </a>
                    </div>
                  </div>
                  <div class="d-grid gap-2 col-6 mx-auto pt-3">
                    <button class="btn btn-primary rounded-pill">Đăng Ký</button>
                  </div>
                  
                  </form>
                </div>
                <div class="col-3"></div>
                
                
                
            </div>
            
            </div>
            
        </div>
    </div>
    
     
    
     <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
