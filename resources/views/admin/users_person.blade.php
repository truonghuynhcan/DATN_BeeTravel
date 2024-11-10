@extends('admin.layout.index')
@section('title')
    Quản lý người dùng 
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tất cả người dùng</h2>
        <a href="{{route('admin.personInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm khách hàng mới</a>
    </header>
    <div class="alert alert-warning">
        <h4>Todo</h4>
        <ul>
            <li>Đang thực hiện</li>
        </ul>
    </div>
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
                <tr ng-repeat="userperson in persons">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_new/@{{ userperson.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td class="text-center">@{{ userperson.name }}</td>
                    <td class="text-center">@{{ userperson.email }}</td>
                    <td class="text-center">@{{ userperson.address }}</td>
                    <td class="text-center">@{{ userperson.phone }}</td>
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
            // Gửi yêu cầu đến API để lấy danh sách người dùng
        $http.get('/admin/api/danh-sach-person').then(
            function(res) { // success
                $scope.persons = res.data.data; // Gán dữ liệu vào scope
            },
            function(res) { // error
                console.error('Lỗi khi lấy danh sách người dùng:', res); // Ghi lỗi
            }
        )
        };
    </script>
@endsection
