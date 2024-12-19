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
                <label for="exampleInputEmail1" class="form-label">Nhập mã</label>
                <input type="text" id="ma" name="ma" placeholder="Điền mã" class="form-control border-black" >
                <div id="emailHelp" class="form-text">Mã đã gửi vô email của bạn</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Mật khẩu mới" class="form-control border-black" >
            </div>
           
            <button type="submit" class="mb-3 container-fluid btn btn-primary">Gửi</button>
          
        </form>


    </div>

    
    <!-- <div class="container-fluid bgdkn">
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
    
</div> -->
    </div>
@endsection
