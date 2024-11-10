@extends('admin.layout.index')
@section('title')
    Quản lý Admin
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tất cả admin</h2>
        <a href="{{route('admin.adminInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm admin mới</a>
    </header>
    <div class="alert alert-warning">
        <h4>Todo</h4>
        <ul>
            <li>Đang thực hiện</li>
        </ul>
    </div>
    <section class="bg-body rounded p-2">
    <h3 class="">Quản lý admin của Bee Travel</h3>
        {{-- danh sách người dùng theo phân biệt admin/user/provide --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col" class="text-center">Tên người dùng</th>
                    <th scope="col" class="text-center">Email</th>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <th scope="col" class="text-center">Phân quyền</th>
                    @else (Auth::guard('admin')->user()->role == 'provider')
                        <th scope="col" class="text-center">Phân quyền</th>
                    @endif
                    <th scope="col" class="text-end">Số điện thoại</th>
                    <!-- <th scope="col" class="text-center">Nội dung tin tức</th> -->
                    <!-- <th scope="col" class="text-center">Trạng thái</th> -->
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="admin_user in adminusers">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_new/@{{ admin_user.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td class="text-center">@{{ admin_user.name }}</td>
                    <td class="text-center">@{{ admin_user.email }}</td>
                    <td class="text-center">@{{ admin_user.role }}</td>
                    <td class="text-center">@{{ admin_user.phone }}</td>
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
            // Gửi vai trò là 'admin' hoặc 'provider'
        const role = 'admin'; // hoặc 'provider', tùy vào logic của bạn
        $http.get(`/admin/api/danh-sach-adminusers?role=${role}`).then(
                function(res) { // success
                    $scope.adminusers = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách provides:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
