@extends('client.layout.index')
@section('title')
    Đăng nhập
@endsection
@section('main')
    <div class=" container d-flex flex-column bg-body w-auto" style="max-width:300px">
        <p class="text-center text-uppercase fs-4 p-4"><b>ĐĂNG NHẬP ĐỐI TÁC</b></p>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger"">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('login_admin_') }}" method="post">
            @csrf
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Tài khoản</label>
                <input type="email" class="form-control border-black" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Điền email doanh nghiệp đang hoạt động.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control border-black" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input border-black" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Lưu mật khẩu</label>
            </div>
            <button type="submit" class="mb-3 container-fluid btn btn-primary">Đăng nhập</button>
            <a class="container-fluid btn btn-outline-primary" href="{{route('register_admin')}}">Đăng ký</a>
        </form>
    </div>
@endsection
