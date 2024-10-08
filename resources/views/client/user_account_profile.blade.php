@extends('client.layout.user_page')
@section('title')
    Quản lý tài khoản
@endsection
@section('main_user')
    <h2>Tài khoản của tui</h2>
    <p class="opacity-75">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
    <hr>
    <div class="row">
        <form action="" method="post" class="col-8 border-end">
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-end align-items-center text-end">Tài khoản Email</div>
                <div class="col-8"><input type="text" value="beetravel@gmail.com" class="form-control" disabled> </div>
            </div>
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-end align-items-center text-end">Họ và tên</div>
                <div class="col-8"><input type="text" value="Bee Travel" class="form-control"> </div>
            </div>
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-end align-items-center text-end">Số điện thoại</div>
                <div class="col-8"><input type="tel" value="012 3456 789" class="form-control"> </div>
            </div>
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-end align-items-center text-end">Giới tính</div>
                <div class="col-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" checked>
                        <label class="form-check-label" for="inlineRadio3">Ẩn</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4 d-flex justify-content-end align-items-center text-end">Ngày sinh</div>
                <div class="col-8"><input type="date" value="2024-12-25" class="form-control"> </div>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Lưu thay đổi" class="btn btn-primary">
            </div>
        </form>
        <div class="col-4">
            <div class="d-flex flex-column justify-center">
                <img src="../assets/image/logo_BeeTravel.png" width="80%" class="rounded-circle" alt="">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02">
                </div>
                <p class="opacity-75 text-center">Dụng lượng file tối đa 1 MB <br> Định dạng:.JPEG, .PNG</p>
            </div>
        </div>
    </div>
@endsection
