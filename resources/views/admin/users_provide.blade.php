@extends('admin.layout.index')
@section('title')
    Quản lý đối tác 
@endsection
@section('main')
    <!-- <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tất cả đối tác</h2>
        <a href="{{route('admin.providerInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm đối tác mới</a>
    </header> -->
    
    <section class="bg-body rounded p-2">
    <h3 class="">Quản lý đối tác của Bee Travel</h3>
        {{-- danh sách người dùng theo phân biệt admin/user/provide --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <!-- <th scope="col" class="text-center">Ảnh</th> -->
                    <th scope="col" class="text-center">Tên người dùng</th>
                    <th scope="col" class="text-center">Email</th>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <th scope="col" class="text-center">Phân quyền</th>
                    @else (Auth::guard('admin')->user()->role == 'provider')
                        <th scope="col" class="text-center">Phân quyền</th>
                    @endif
                    <th scope="col" class="text-center">Số điện thoại</th>
                    <th scope="col" class="text-center">Trạng thái</th>
                    <!-- <th scope="col" class="text-center">Nội dung tin tức</th> -->
                    <!-- <th scope="col" class="text-center">Trạng thái</th> -->
                    <!-- <th scope="col" class="text-center">Hành động</th> -->
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="userprovide in providers">
                    <!-- <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_new/@{{ userprovide.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th> -->
                    <td class="text-center">@{{ userprovide.name }}</td>
                    <td class="text-center">@{{ userprovide.email }}</td>
                    <td class="text-center">@{{ userprovide.role }}</td>
                    <td class="text-center">@{{ userprovide.phone }}</td>
                    <td class="text-center badge text-bg-success m-2" style="display: flex; align-items: center; justify-content: center; height: 30px;">@{{ userprovide.is_block === 0 ? 'Còn hoạt động' : 'Đã bị khóa' }}</td>
                    <!-- Người đăng ký -->
                    <!-- <td class="text-center">@{{ newItem.content }}</td> -->
                    <!-- trạng thái -->
                    <!-- <td class="text-center" ng-bind=" useradmin.is_hidden !== 0 ? 'Ẩn Tin' : 'Hiện Tin'"></td> -->

                    <!-- <td class="text-center">
                        <button class="btn btn-outline-danger">Khóa tài khoản</button>
                        </td> -->
                
        </tr>
                    <!-- <a href="/admin/sua-provider/@{{ userprovide.id }}" class="btn btn-info">Sửa</a> -->
                        <!-- <button class="btn btn-outline-danger">Khóa tài khoản</button> -->
                </tr>
            </tbody>
        </table>
    </section>
@endsection

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            // Gửi vai trò là 'admin' hoặc 'provider'
        const role = 'provider'; // hoặc 'provider', tùy vào logic của bạn
        $http.get(`/admin/api/danh-sach-user-provide?role=${role}`).then(
                function(res) { // success
                    $scope.providers = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách provides:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
