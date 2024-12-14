@extends('admin.layout.index')
@section('title')
    Quản lý người dùng 
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tất cả người dùng</h2>
    </header>
    <div class="alert alert-warning">
        <h4>Todo</h4>
        <ul>
            <li>Đang thực hiện</li>
        </ul>
    </div>
    <section class="bg-body rounded p-2">
    <h3 class="">Quản lý Admin</h3>
        {{-- danh sách người dùng theo phân biệt admin/user/provide --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col" class="text-center">Tên người dùng</th>
                    <th scope="col" class="text-center">Email</th>
                    @if (Auth::guard('admin')->user()->role == 'admin' || Auth::guard('admin')->user()->role == 'provider' || Auth::guard('admin')->user()->role == 'pending')
    <th scope="col" class="text-center">Phân quyền</th>
@endif
                    <th scope="col" class="text-end">Số điện thoại</th>
                    <!-- <th scope="col" class="text-center">Nội dung tin tức</th> -->
                    <!-- <th scope="col" class="text-center">Trạng thái</th> -->
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="useradmin in admins">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_new/@{{ useradmin.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td class="text-center">@{{ useradmin.name }}</td>
                    <td class="text-center">@{{ useradmin.email }}</td>
                    <td class="text-center">@{{ useradmin.role }}</td>
                    <td class="text-center">@{{ useradmin.phone }}</td>
                    <!-- Người đăng ký -->
                    <!-- <td class="text-center">@{{ newItem.content }}</td> -->
                    <!-- trạng thái -->
                    <!-- <td class="text-center" ng-bind=" useradmin.is_hidden !== 0 ? 'Ẩn Tin' : 'Hiện Tin'"></td> -->

                    <td>
                        <a href="" class="btn btn-info">Sửa</a>
                        <button class="btn btn-outline-danger">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <section class="bg-body rounded p-2">
    <h3 class="">Quản lý User</h3>
        {{-- danh sách người dùng theo phân biệt admin/user/provide --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col" class="text-center">Tên người dùng</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Địa chỉ</th>
                    <th scope="col" class="text-end">Số điện thoại</th>
                    <!-- <th scope="col" class="text-center">Nội dung tin tức</th> -->
                    <!-- <th scope="col" class="text-center">Trạng thái</th> -->
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="usertong in users">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_new/@{{ usertong.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td class="text-center">@{{ usertong.name }}</td>
                    <td class="text-center">@{{ usertong.email }}</td>
                    <td class="text-center">@{{ usertong.address }}</td>
                    <td class="text-center">@{{ usertong.phone }}</td>
                    <!-- Người đăng ký -->
                    <!-- <td class="text-center">@{{ newItem.content }}</td> -->
                    <!-- trạng thái -->
                    <!-- <td class="text-center" ng-bind=" useradmin.is_hidden !== 0 ? 'Ẩn Tin' : 'Hiện Tin'"></td> -->

                    <td>
                        <a href="" class="btn btn-info">Sửa</a>
                        <button class="btn btn-outline-danger">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            // Gửi yêu cầu lấy danh sách người dùng cho cả 'admin' và 'provider'
        const roles = ['admin', 'provider','pending']; // Mảng chứa cả hai vai trò
        $http.get(`/admin/api/danh-sach-useradmin?roles=${roles.join(',')}`).then(
                function(res) { // success
                    $scope.admins = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách admins:', res); // Ghi lỗi
                }
            )
            // Gửi yêu cầu đến API để lấy danh sách người dùng
        $http.get('/admin/api/danh-sach-user').then(
            function(res) { // success
                $scope.users = res.data.data; // Gán dữ liệu vào scope
            },
            function(res) { // error
                console.error('Lỗi khi lấy danh sách người dùng:', res); // Ghi lỗi
            }
        )
        };
    </script>
@endsection
