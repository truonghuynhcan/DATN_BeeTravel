@extends('admin.layout.index')
@section('title')
    Quản lý tin tức 
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tin tức</h2>
        <a href="{{route('admin.newInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm tin tức mới</a>
    </header>
    
    <section class="bg-body rounded p-2">
        {{-- Bộ lọc --}}
        <!-- <div class="d-flex mb-3">
            <div class="me-3">
                <label for="area" class="form-label">Lọc theo danh mục</label>
                <select class="form-select form-select-sm" id="area" aria-label="Small select example">
                    <option selected>Danh mục tour - Chưa chọn</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="me-3">
                <label for="date" class="form-label">Chọn ngày</label>
                <div class="d-flex">
                    <input type="date" class="form-control form-control-sm" id="date1">
                    <span class="mx-2">đến</span>
                    <input type="date" class="form-control form-control-sm" id="date2">
                </div>
            </div>
            <div class="w-25 ms-auto">
                <label for="" class="form-label">Chọn ngày</label>
                <div class=" input-group" style="height: fit-content;">
                    <input type="text" class="form-control form-control-sm" placeholder="Tìm kiếm tên tour, danh mục tour" aria-label="Tìm tour" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2">Tìm</button>
                </div>
            </div>
        </div> -->

        {{-- danh sách tour --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col">Tên tour</th>
                    <th scope="col" class="text-center">Danh mục</th>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <th scope="col" class="text-center">Đối tác</th>
                    @endif
                        <!-- <th scope="col" class="text-center">Ngày Khởi Hành</th> -->
                    <th scope="col" class="text-center">Nội dung tin tức</th>
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="newItem in news">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_new/@{{ newItem.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td>@{{ newItem.title }}</td>
                    <td class="text-center">@{{ newItem.news_category.title }}</td>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <td class="text-center">@{{ newItem.admin.name }}</td>
                    @endif
                    <td class="text-center">@{{ newItem.description }}</td>
                    <!-- Người đăng ký -->
                    <!-- <td class="text-center">@{{ newItem.content }}</td> -->
                    <!-- trạng thái -->
                    <td class="text-center" ng-bind=" newItem.is_hidden !== 0 ? 'Ẩn Tin' : 'Hiện Tin'"></td>

                    <td class="text-center">
                    @if (Auth::guard('admin')->user()->role != 'admin')
                    <a href="/admin/sua-tintuc/@{{ newItem.id }}" class="btn btn-info">Sửa</a>
                    @endif
                    
                    
                    <a href="/admin/xoa-tintuc/@{{ newItem.id }}" class="btn btn-info mb-1">Xóa Tin Tức</a>
                        <!-- <a href="/admin/sua-tintuc/@{{ newItem.id }}" class="btn btn-info">Sửa</a>
                        <button class="btn btn-outline-danger">Xóa</button> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            $http.get('/admin/api/danh-sach-new/{{ Auth::guard("admin")->user()->id }}').then(
                function(res) { // success
                    $scope.news = res.data.data;
                    console.log($scope.news);
                    
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách tours:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
