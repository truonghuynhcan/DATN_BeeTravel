@extends('admin.layout.index')
@section('title')
    Quản lý danh mục tin tức 
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý danh mục tin tức</h2>
        <a href="" class="btn btn-primary" style="height: fit-content;">Thêm danh mục tin tức</a>
    </header>
    <div class="alert alert-warning">
        <h4>Todo</h4>
        <ul>
            <li>Đếm tour theo danh mục</li>
        </ul>
    </div>
    <section class="bg-body rounded p-2">

        {{-- danh sách danh mục tin tức --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col" class="text-center">Tên danh mục tin tức</th>
                    <th scope="col" class="text-center">Slug tin tức</th>
                    <!-- <th scope="col" class="text-center">Nội dung tin tức</th> -->
                    <!-- <th scope="col" class="text-center">Trạng thái</th> -->
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="cate in category_new">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_new/@{{ cate.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td class="text-center">@{{ cate.title }}</td>
                    <!-- Người đăng ký -->
                    <td class="text-center">@{{ cate.slug }}</td>
                    <!-- Người đăng ký -->
                    <!-- <td class="text-center">@{{ cate.content }}</td> -->
                    <!-- trạng thái -->
                    <!-- <td class="text-center" ng-bind=" cate.is_hidden !== 0 ? 'Ẩn Tin' : 'Hiện Tin'"></td> -->

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
            $http.get('api/danh-sach-category-new').then(
                function(res) { // success
                    $scope.category_new = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách news:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
