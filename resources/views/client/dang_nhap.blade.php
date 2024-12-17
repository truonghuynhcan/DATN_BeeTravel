@extends('client.layout.index')
@section('title')
    Đăng nhập
@endsection
@section('main')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 bg-body text-body">
                <div class="m-auto" style="max-width: 350px">
                    <img src="{{ asset('assets/image/logo_ngang.png') }}" class="img-fluid" alt="">
                    <h1 class="text-center text-uppercase fs-3 fw-normal">Welcome again!</h1>
                    <hr class="border-2 border-primary">
                    @if ($errors->any())
                        <ul class="mb-3 list-group list-group-flush">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Email đăng nhập</label>
                            <input type="email" name='email' class="form-control border-secondary" id="formGroupExampleInput">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Mật khẩu</label>
                            <input type="password" name='password' class="form-control border-secondary" id="formGroupExampleInput2">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input border-secondary" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Ghi Nhớ Mật Khẩu
                            </label>
                        </div>

                        <button class=" container-fluid fw-bolder btn btn-primary mb-3 p-3" type="submit">Đăng Nhập</button>
                        <p class="text-decoration-none">Chưa Có Tài Khoản? <a href="{{ route('register') }}" class="mb-3">Đăng Ký Ngay!</a></p>
                        <p class="text-decoration-none"> <a href="{{ route('forgotpassword') }}" class="mb-3">Quên mật khẩu</a></p>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <img src="{{ asset('assets/image/trangchu banner03.jpg') }}" class="w-100" alt="...">
            </div>
        </div>
    </div>



    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
