@extends('client.layout.index')
@section('title')
    Đăng nhập
@endsection
@section('main')
<div class="container d-flex align-items-center justify-content-center vh-100 ">
        <div class="row pt-3">
            <p class="text-center text-uppercase fs-4 fst-italic p-4"><b>Đăng Nhập Đại Lý Doanh Nghiệp</b></p>
            <form action="" method="post">
                    @csrf
                <div class="mb-3 ">
                  <label for="exampleInputText1" class="form-label">Tên đại lý: </label>
                  <input type="text" class="form-control border-black" id="exampleInputText1" aria-describedby="textHelp">
                  <div id="textHelp" class="form-text">Tên cụ thể của doanh nghiệp hợp tác.</div>
                </div>
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label">Email đại lý: </label>
                    <input type="email" class="form-control border-black" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Điền email doanh nghiệp đang hoạt động.</div>
                  </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Mật khẩu: </label>
                  <input type="password" class="form-control border-black" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPhone1" class="form-label">Số điện thoại: </label>
                    <input type="phone" class="form-control border-black" id="exampleInputPhone1">
                  </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input border-black" id="exampleCheck1">
                  <label class="form-check-label " for="exampleCheck1">Lưu mật khẩu</label>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
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
    
     
    
     <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
