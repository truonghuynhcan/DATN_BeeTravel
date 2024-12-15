@extends('client.layout.index')
@section('title')
    Đăng ký
@endsection
@section('main')
    <div class="container">
        <div class="row">
          <div class="col-lg-4 order-lg-2 p-lg-3 bg-body text-body">
            <img src="{{ asset('assets/image/logo_ngang.png') }}" class="img-fluid">
            <h1 class="text-center text-uppercase fs-3 fw-normal"><b>Đăng Ký Ngay</b></h1>
            <hr>
            @if ($errors->any())
                <ul class="mb-3 list-group list-group-flush">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div>
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Tên Đăng Nhập: </label>
                        <input type="text" name='name' class="form-control border-secondary" id="formGroupExampleInput" placeholder="Tên đăng nhập" value='{{ old('name') }}'>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Mật Khẩu: </label>
                        <input type="password" name='password' class="form-control border-secondary" id="formGroupExampleInput2" placeholder="Mật Khẩu" value='{{ old('password') }}'>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Email: </label>
                        <input type="email" name='email' class="form-control border-secondary" id="formGroupExampleInput" placeholder="Email" value='{{ old('email') }}'>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Số điện thoại: </label>
                        <input type="phone" name='phone' class="form-control border-secondary" id="formGroupExampleInput2" placeholder="Số điện thoại" value='{{ old('phone') }}'>
                    </div>
                    
                    <p class="text-decoration-none">Đã Có Tài Khoản? <a href="{{ route('login') }}" class="">Đăng Nhập!</a></p>
                    <button class="container-fluid fw-bolder btn btn-primary mb-3 p-3">Đăng Ký Ngay</button>
                </form>
            </div>

        </div>
            <div class="col-lg-8 order-lg-1">
                <img src="{{ asset('assets/image/trangchu banner03.jpg') }}" class="w-100">
            </div>
           

        </div>
    </div>
@endsection
