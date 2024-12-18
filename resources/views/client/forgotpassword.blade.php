@extends('client.layout.index')
@section('title')
  Quên Mật Khẩu
@endsection
@section('main')
    <div class="container">
    
    <div class=" container d-flex flex-column bg-body w-auto" style="max-width:400px">
    <p class="text-center text-uppercase fs-4 p-4"><b>QUÊN MẬT KHẨU</b></p>
    <form action="" method="post">
            @csrf
            <div class="mb-3 ">
                <label  class="form-label">Nhập email</label>
                <input type="email"  id="email" name="email" placeholder="Email" class="form-control border-black">
                <div id="emailHelp" class="form-text">Điền email bạn đã đăng ký.</div>
            </div>
           
            <button type="submit" class="mb-3 container-fluid btn btn-primary">Gửi</button>
          
        </form>


    </div>

    
    </div>
@endsection
