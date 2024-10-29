@extends('client.layout.index')
@section('title')
    Đăng nhập
@endsection
@section('main')
    <div class=" container d-flex flex-column bg-body w-auto" style="max-width:300px">
        <p class="text-center text-uppercase fs-4 p-4"><b>ĐĂNG KÝ ĐỐI TÁC</b></p>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger"">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (session('success'))
            <p class="text-bg-success p-2">{{ session('success') }}</p>
        @endif
        <form action="{{ route('register_admin_') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>

                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email">Tên tài khoản:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email/gmail" required>
                <div class="form-text">Điền email/gmail doanh nghiệp đang hoạt động.</div>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <div class="form-text">Tối thiểu 8 ký tự</div>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Xác nhận mật khẩu:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="10 số" required>
                @error('phone')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="form-text mb-3">Chúng tôi sẽ liên hệ để xác nhận trong 24h sau khi bạn đăng ký.</div>

            <button type="submit" class="mb-3 container-fluid btn btn-primary">Đăng ký</button>
            <a class="mb-3 container-fluid btn btn-outline-primary" href="{{ route('login_admin') }}">Đăng Nhập</a>
        </form>
    </div>
@endsection
