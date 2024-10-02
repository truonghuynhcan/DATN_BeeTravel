@extends('client.layout.user_page')
@section('title')
    Cài đặt thông báo
@endsection
@section('main_user')
<div class="container d-flex justify-content-between align-items-center">
    <div>
        <p class="mb-0">Email thông báo</p>
        <p class="opacity-50">Thông báo và nhắc nhở quan trọng về tài khoản sẽ không thể bị tắt</p>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
    </div>
</div>

<hr>
<div class="container d-flex justify-content-between align-items-center">
    <div>
        <p class="mb-0">Thông báo SMS</p>
        <p class="opacity-50">Thông báo và nhắc nhở quan trọng về tài khoản sẽ không thể bị tắt</p>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked2">
    </div>
</div>
@endsection
