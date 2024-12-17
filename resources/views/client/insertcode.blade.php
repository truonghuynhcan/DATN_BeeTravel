@extends('client.layout.index')
@section('title')
  Quên Mật Khẩu
@endsection
@section('main')
    <div class="container">
    <div class="container-fluid bgdkn">
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6 " style="margin-top: 90px;">
            <div class="container ">
                <div class="login-container">
                    <h2>nhập mã</h2>
                    <form action="" method="POST" >
                    @csrf
                      <div class="form-group">
                        <input type="text" class="form-control" id="ma" name="ma" placeholder="mã"  >
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="mật khẩu mới"  >
                      </div>
                      <button type="submit" class="btn btn-primary w-100">Gửi</button>
                      <div class="form-group mb-5 mt-2">
                      </div>
                    </form>
                  </div>
            
              </div>
        </div>
    </div>
    
</div>
    </div>
@endsection
