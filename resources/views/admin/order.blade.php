@extends('admin.layout.index')
@section('title')
    Quản lý đơn hàng
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý đơn hàng</h2>
        {{-- <a href="{{route('admin.tourInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm tour mới</a> --}}
    </header>
    <div class="alert alert-danger d-none">
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
            <div class="w-25 ms-auto d-none">
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
                    <th scope="col">Thông tin KH</th>
                    <th scope="col" class="text-center">Thông tin tour</th>
                    <th scope="col" class="text-center">Thanh toán</th>
                    <th scope="col" class="text-center">Trạng thái</th>
                    <th scope="col" class="text-center">Số người đi</th>
                    <th scope="col" class="text-end">Tổng tiền</th>
                    <th scope="col" class="text-center">Ngày đặt</th>
                    <th scope="col" class="text-center d-none">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="order in order_list | orderBy:'-id'">
                    {{-- id đơn hàng --}}
                    <td scope="col" class="text-center">@{{ order.id }}</td>
                    {{-- họ và tên --}}
                    <td scope="col">@{{ order.fullname }} <br><small class="text-body-secondary">@{{ order.phone }} <br>@{{ order.email }}</small> </td>
                    <!-- <td scope="col" class="text-center"><a href="@{{ order.admin_id }}">@{{ order.admin_name }}</a></td> -->

                    {{-- THÔNG TIN TOUR --}}
                    <td scope="col" class="">
                        @{{ order.tour_name }}
                        <br>
                        <small class="text-body-secondary"><i class="bi bi-calendar-check"></i> Vào ngày @{{ order.ngaydi }}</small>
                        <br>
                        <small class="text-body-secondary"><i class="bi bi-geo-alt"></i> Xuất phát: @{{ order.noi_khoi_hanh }}</small>
                    </td>

                    {{-- TRẠNG THÁI THANH TOÁN --}}
                    <td scope="col" class="text-center">
                        <select ng-change="updateOrderPaid(order)" ng-model="order.is_paid"  ng-init="order.is_paid = order.is_paid ? '1' : '0'" class="form-select form-select-sm" aria-label="Default select example" style="min-width:80px">
                            <option value="0">Chưa thanh toán</option>
                            <option value="1">Đã thanh toán</option>
                        </select>

                    </td>

                    {{-- trạng thái đơn hàng --}}
                    <td scope="col" class="text-center">
                        <select ng-change="updateOrderStatus(order)" ng-model="order.status" class="form-select form-select-sm" aria-label="Default select example" style="min-width:80px">
                            <option value="waiting">Chờ xác nhận</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="cancel">Hủy tour</option>
                            <option value="finished">Hoàn thành</option>
                        </select>
                    </td>
                    {{-- SỐ NGƯỜI ĐI --}}
                    <td scope="col" class="text-center">@{{ order.customer_count | number }}</td>
                    {{-- GIÁ TIỀN --}}
                    <td scope="col" class="text-end">@{{ order.total_price | number }} ₫</td>
                    <td scope="col" class="text-center"><input type="datetime-local" disabled value="@{{ order.created_at }}" class="border-0 bg-none"></td>
                    <td scope="col" class="text-center d-none">
                        <a href="#">Sửa</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            $http.get('/admin/api/danh-sach-don-hang/{{ Auth::guard('admin')->user()->id }}').then(
                function(res) { // success
                    $scope.order_list = res.data.data;
                    // console.log($scope.order_list);

                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách đơn hàng:', error); // Ghi lỗi
                }
            )

            $scope.updateOrderPaid = function(order) {

                // Gửi yêu cầu POST để cập nhật trạng thái
                $http.post('/admin/api/update-order-paid', {
                    order_id: order.id,                    
                    order_is_paid: order.is_paid,                    
                }).then(function(response) {
                    // Xử lý thành công
                    alert('Cập nhật thanh toán thành công!');
                }).catch(function(error) {
                    // Xử lý lỗi
                    alert('Cập nhật thanh toán thất bại! Vui lòng thử lại.');
                });
            };

            $scope.updateOrderStatus = function(order) {
                // Gửi yêu cầu POST để cập nhật trạng thái
                $http.post('/admin/api/update-order-status', {
                    order_id: order.id,
                    status: order.status
                }).then(function(response) {
                    // Xử lý thành công
                    alert('Cập nhật trạng thái thành công!');
                }).catch(function(error) {
                    // Xử lý lỗi
                    alert('Cập nhật trạng thái thất bại! Vui lòng thử lại.');
                });
            };
        };
    </script>
@endsection
