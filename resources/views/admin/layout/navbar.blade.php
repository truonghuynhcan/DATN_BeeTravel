<nav class="bg-body-tertiary bg-opacity-25 p-2 overflow-auto sticky-top" style="width: 250px; height: 100vh;">
    <!-- Đối tác - chỉ show thống kê của riêng đối tác -->
    <div class="list-group mb-3">
        <a href="" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
            Dashboard
        </a>
        <a href="" class="list-group-item list-group-item-action">Thống kê tour</a>
        <a href="" class="list-group-item list-group-item-action">Thống kê doanh thu</a>
    </div>
    <div class="list-group mb-3">
        <a href="{{route('admin.order')}}" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
            Quản lý đơn hàng
        </a>
        <a href="{{route('admin.order')}}" class="list-group-item list-group-item-action">Tất cả đơn hàng</a>
        <a href="" class="list-group-item list-group-item-action">Thông kê</a>
    </div>
    <div class="list-group mb-3">
        <a href="{{route('admin.tourManagement')}}" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
            Quản lý Tour
        </a>
        <a href="{{route('admin.tourManagement')}}" class="list-group-item list-group-item-action">Tất cả tour</a>
        <a href="{{route('admin.tourInsert')}}" class="list-group-item list-group-item-action">Thêm tour</a>
        <a href="{{route('admin.CateToursManagement')}}" class="list-group-item list-group-item-action">Danh mục tour</a>
    </div>
    <div class="list-group mb-3">
        <a href="{{route('admin.newsManagement')}}" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
            Quản lý Tin tức
        </a>
        <a href="{{route('admin.newsManagement')}}" class="list-group-item list-group-item-action">Tất cả tin tức</a>
        <a href="{{route('admin.newInsert')}}" class="list-group-item list-group-item-action">Thêm tin tức</a>
        <a href="{{route('admin.CateNewsManagement')}}" class="list-group-item list-group-item-action">Danh mục tin tức</a>
    </div>

    <!-- Show khi là admin -->
    @auth('admin')
        @if (Auth::guard('admin')->user()->role == 'admin')
            <div class="list-group mb-3">
                <a href="{{route('admin.usersManagement')}}" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
                    Quản lý Người dùng
                </a>
                <a href="{{route('admin.providesManagement')}}" class="list-group-item list-group-item-action">Tất cả đối tác</a>
                <!-- <a href="{{route('admin.providerInsert')}}" class="list-group-item list-group-item-action">Thêm đối tác</a> -->
                <a href="{{route('admin.personsManagement')}}" class="list-group-item list-group-item-action">Tất cả Khách hàng</a>
                <!-- <a href="{{route('admin.personInsert')}}" class="list-group-item list-group-item-action">Thêm khách hàng</a> -->
                <a href="{{route('admin.adminusersManagement')}}" class="list-group-item list-group-item-action">Tất cả Admin</a>
                <!-- <a href="{{route('admin.adminInsert')}}" class="list-group-item list-group-item-action">Thêm admin</a> -->
            </div>
        @endif
    @endauth
    <div class="list-group mb-3">
        <a href="" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
            Thông tin cá nhân
        </a>
        <a href="" class="list-group-item list-group-item-action">Tài khoản</a>
        <!-- <a href="" class="list-group-item list-group-item-action">Ngân hàng</a>
        <a href="" class="list-group-item list-group-item-action">Bảo mật</a>
        <a href="" class="list-group-item list-group-item-action">Cài đặt thông báo</a> -->
    </div>
</nav>
