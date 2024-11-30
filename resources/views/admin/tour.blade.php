@extends('admin.layout.index')
@section('title')
    Quản lý tour
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tour</h2>
        <a href="{{route('admin.tourInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm tour mới</a>
    </header>
    <div class="alert alert-danger">
        <h4>Todo</h4>
        <ul>
            <li>Làm thêm lọc tour</li>
        </ul>
    </div>
    <section class="bg-body rounded p-2">
        {{-- Bộ lọc --}}
        <div class="d-flex mb-3">
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
        </div>

        {{-- danh sách tour --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col">Tên tour</th>
                    <th scope="col" class="text-center">Danh mục</th>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <th scope="col" class="text-center">Đối tác</th>
                    @else
                        <th scope="col" class="text-center">Ngày Khởi Hành</th>
                    @endif
                    <th scope="col" class="text-end">Giá</th>
                    <th scope="col" class="text-center">Người đăng ký</th>
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="tour in tours">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_tour/@{{ tour.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td>@{{ tour.title }}</td>
                    <td class="text-center">@{{ tour.category.ten_danh_muc }}</td>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <td class="text-center">@{{ tour.admin.name }}</td>
                    @else
                        <td class="text-center">@{{ tour.ngay_di[0].start_date || 'Chưa có' | date:'dd/MM/yyyy'}}</td>
                    @endif
                    <td class="text-end">@{{ tour.ngay_di[0].price || 0  | number}}</td>
                    <!-- Người đăng ký -->
                    <td class="text-center">0</td>
                    <!-- trạng thái -->
                    <td class="text-center" ng-bind="tour.is_hidden !== 0 ? 'Ẩn' : 'Hiện'"></td>

                    <td class="text-center">
            <a href="/admin/sua-tour/@{{ tour.id }}" class="btn btn-info">Sửa</a>
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
            $http.get('/admin/api/danh-sach-tour/{{ Auth::guard("admin")->user()->id }}').then(
                function(res) { // success
                    $scope.tours = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách tours:', error); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
