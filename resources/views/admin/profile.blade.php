@extends('admin.layout.index')
@section('title')
    Quản lý tài khoản cá nhân
@endsection
@section('main')
    <!-- <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tất cả người dùng</h2>
        <a href="{{route('admin.personInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm khách hàng mới</a>
    </header> -->
    
    <section class="bg-body rounded p-2 text-center" >
    <h3>Quản lý tài khoản cá nhân</h3>
    
    <!-- Hiển thị thông tin admin -->

    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" class="text-center">Tên người dùng</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Địa chỉ</th>
                @if (Auth::guard('admin')->user()->role == 'admin')
                    <th scope="col" class="text-center">Phân quyền</th>
                    @endif
                <th scope="col" class="text-center">Số điện thoại</th>
                <th scope="col" class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr ng-repeat="userperson in persons">
                <td class="text-center">@{{ userperson.name }}</td>
                <td class="text-center">@{{ userperson.email }}</td>
                <td class="text-center">@{{ userperson.role }}</td>
                <td class="text-center">@{{ userperson.address }}</td>
                <td class="text-center">@{{ userperson.phone }}</td>
                <td class="text-center">
                    <button class="btn btn-outline-danger">Khóa tài khoản</button>
                </td>
            </tr>
        </tbody>
    </table>
</section>
@endsection

@section('viewFunction')
<script>
    viewFunction = function($scope, $http) {
        // Lấy thông tin người dùng từ sessionStorage
        const adminUser = JSON.parse(sessionStorage.getItem('adminUser'));

        if (adminUser) {
            const role = (adminUser.role === 'admin' || adminUser.role === 'provider') ? adminUser.role : null;

            if (role) {
                // Gọi API để lấy thông tin người dùng đang đăng nhập
                $http.get(`/admin/api/get-current-user?role=${role}`).then(
                    function(res) { // success
                        if (res.data.status) {
                            $scope.adminUser = res.data.data; // Lưu thông tin người dùng vào scope
                        } else {
                            console.error('Lỗi:', res.data.message); // Ghi lỗi nếu có
                        }
                    },
                    function(res) { // error
                        console.error('Lỗi khi lấy thông tin người dùng:', res); // Ghi lỗi
                    }
                );
            } else {
                console.error('Vai trò không hợp lệ!');
            }
        } else {
            console.error('Không tìm thấy thông tin người dùng trong session!');
        }
    };
</script>
<!-- <script>
        viewFunction = function($scope, $http) {
            // Gửi vai trò là 'admin' hoặc 'provider'
        const role = ['admin','provider']; // hoặc 'provider', tùy vào logic của bạn
        $http.get(`/admin/api/danh-sach-adminusers?role=${role}`).then(
                function(res) { // success
                    $scope.adminusers = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách provides:', res); // Ghi lỗi
                }
            )
        };
    </script> -->
@endsection
