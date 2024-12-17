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
                    <h2>Quên mật khẩu</h2>
                    <form action="" method="POST" >
                    @csrf
                      <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"  >
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
