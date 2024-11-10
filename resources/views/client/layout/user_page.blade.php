@extends('client.layout.index')
@section('main')
    <!-- head profile -->
    <section>
        <div class="card text-bg-dark">
            <img src="{{asset('')}}assets/image/head01.jpg" class="card-img object-fit-cover" height="200px" width="100%">
            <div class="card-img-overlay bg-black bg-opacity-50 d-flex justify-content-center align-items-center">
                <h2 class="card-title">Thông tin của tôi</h2>
            </div>
        </div>
    </section>

    <!-- thong tin  -->
    <section class="container my-4">
        <div class="row">
            <!-- navbar người dùng -->
            <div class="col-3 p-2">
                <!-- avatar -->
                <div class="card border-0 mb-3" style="background-color: inherit;">
                    <div class="row g-0">
                        <div class="col-md-3 d-flex align-items-center">
                            <img src="{{ asset('assets/image_avatar/' . (Auth::user()->image_url??'user.jpg')) }}" width="100%" class="object-fit-cover rounded-circle bg-body">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title h6">{{Auth::user()->name}}</h5>
                                <p class="card-text"><small class="text-body-secondary"><i class="bi bi-pen"></i> Sửa hồ sơ</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <!-- nav -->
                <div class="d-flex flex-column">
                    <a href="{{route('myProfile')}}" class="text-decoration-none"><i class="bi bi-person link-primary"></i> Tài khoản của tui</a>
                    <a href="{{route('myProfile')}}" class="text-decoration-none px-4 link-body-emphasis">Hồ sơ</a>
                    <a href="{{route('myPayment')}}" class="text-decoration-none px-4 link-body-emphasis">Ngân hàng</a>
                    <a href="{{route('settingNotification')}}" class="text-decoration-none px-4 link-body-emphasis">Cài đặt thông báo</a>
                    <a href="{{route('settingSecurity')}}" class="text-decoration-none px-4 link-body-emphasis">Bảo mật</a>

                    <a href="{{route('myTour')}}" class="text-decoration-none link-success"> <i class="bi bi-clipboard-minus"></i> Chuyến đi của tui</a>
                    
                    <a href="{{route('settingNotificationsOrder')}}" class="text-decoration-none link-danger"><i class="bi bi-bell link-danger"></i> Thông báo</a>
                </div>
            </div>


            <!-- hiển thị thông tin -->
            <div class="col-9 px-2">
                <div class="bg-body p-2 rounded" style="min-height: 300px;">
                    @yield('main_user')
                </div>
            </div>
        </div>
    </section>
@endsection
