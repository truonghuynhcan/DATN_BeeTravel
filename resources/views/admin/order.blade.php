@extends('admin.layout.index')
@section('title')
    Quản lý đơn hàng
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý đơn hàng</h2>
        {{-- <a href="{{route('admin.tourInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm tour mới</a> --}}
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
                    <th scope="col" class="text-center">Id ĐH</th>
                    <th scope="col">Tên KH</th>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <th scope="col" class="text-center">Đối tác</th>
                    @else
                        <th scope="col" class="text-center">SĐT</th>
                    @endif
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col" class="text-end">Tổng tiền</th>
                    <th scope="col" class="text-center">Ngày đặt</th>
                    <th scope="col" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="order in order_list | orderBy:'-id'">
                    <td scope="col" class="text-center">@{{order.id}}</td>
                    <td scope="col">@{{order.fullname}}</td>
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <td scope="col" class="text-center"><a href="@{{order.admin_id}}">@{{order.admin_name}}</a></td>
                    @else
                        <td scope="col" class="text-center">@{{order.phone}}</td>
                    @endif
                    <td scope="col" class="text-center">@{{order.status}}</td>
                    <td scope="col" class="text-end">@{{order.total_price | number}} ₫</td>
                    <td scope="col" class="text-center"><input type="datetime-local" disabled value="@{{order.created_at}}" class="border-0 bg-none"></td>
                    <td scope="col" class="text-center">
                        <a href="">Sửa</a>
                        <a href="">Xóa</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            $http.get('/admin/api/danh-sach-don-hang/{{ Auth::guard('admin')->user()->id }}').then(
                function(res) { // success
                    $scope.order_list = res.data.data;
                    console.log($scope.order_list);

                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách đơn hàng:', error); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
