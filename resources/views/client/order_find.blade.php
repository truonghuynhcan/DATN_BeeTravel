{{-- tour đã đặt --}}
@extends('client.layout.index')
@section('title')
    Đăng nhập
@endsection
@section('main')
    <div class="container">
        <form action="{{ route('order.find_') }}" method="post" class="d-flex justify-content-center flex-column m-auto" style="max-width: 400px">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li style="color:red; decoration:none">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label">Tìm theo Email: <span class="text-danger">(*)</span></label>
                <input value="{{ old('email') }}" type="email" name='email' class="form-control border-secondary" id="email" placeholder="Gmail mà bạn đăng ký tour">
            </div>

            <div class="mb-3 opacity-50">
                <label for="sdt" class="form-label">Tìm theo số điện thoại:</label>
                <input value="{{ old('phone') }}" type="tel" name='phone' class="form-control border-secondary" id="sdt" placeholder="xxxx xxx xxx">
            </div>

            <div class="mb-3">
                <label for="madonghang" class="form-label">Mã đơn hàng: </label>
                <input value="{{ old('madonghang') }}" type="text" name='madonghang' class="form-control border-secondary" id="madonghang" placeholder="#123 hoặc để trống để tìm tất cả">
            </div>

            @if (session('show_confirm_email'))
                <div class="mb-3">
                    <label for="confirm_email" class="form-label">Mã xác nhận email:
                        <small class="fw-medium opacity-75">(mã sẽ được gửi sau khi xác nhận)</small>
                    </label>
                    <input value="{{ old('confirm_email') }}" type="text" name='confirm_email' class="form-control border-secondary" id="confirm_email">
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <button class="container-fluid btn btn-primary rounded fw-bold" type="submit" name="action" value="xacnhan">Xác nhận tìm đơn hàng</button>
                    </div>
                    <div class="col-md-5">
                        <button class="container-fluid btn btn-outline-primary rounded fw-bold" type="submit" name="action" value="guilai">Gửi lại mã</button>
                    </div>
                </div>
            @else
                <button class="container-fluid btn btn-primary rounded fw-bold" type="submit" name="action" value="guimoi">Gửi mã xác nhận</button>
            @endif
        </form>
    </div>


    <script src="{{ asset('') }}assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
