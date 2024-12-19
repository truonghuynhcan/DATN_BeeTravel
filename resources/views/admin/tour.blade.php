@extends('admin.layout.index')
@section('title')
Quản lý tour
@endsection
@section('main')
<header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
    <h2 class="">Quản lý tour</h2>
    <a href="{{route('admin.tourInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm tour mới</a>
</header>
<div class="alert alert-danger d-none">
    <h4>Todo</h4>
    <ul>
        <li>Làm thêm lọc tour</li>
    </ul>
</div>
<section class="bg-body rounded p-2">
    {{-- Bộ lọc --}}
    <form action="" method="GET" class="d-flex mb-3">
        <!-- Lọc giá -->
        <div class="me-3">
            <label for="price_range" class="form-label">Lọc theo giá</label>
            <select name="price_range" class="form-select form-select-sm" id="price_range" onchange="this.form.submit()">
                <option value="">Tất cả giá</option>
                <option value="0-5000000" {{ request('price_range') == '0-5000000' ? 'selected' : '' }}>Dưới 5.000.000 ₫</option>
                <option value="5000000-10000000" {{ request('price_range') == '5000000-10000000' ? 'selected' : '' }}>5.000.000 ₫ - 10.000.000 ₫</option>
                <option value="10000000-20000000" {{ request('price_range') == '10000000-20000000' ? 'selected' : '' }}>10.000.000 ₫ - 20.000.000 ₫</option>
                <option value="20000000-50000000" {{ request('price_range') == '20000000-50000000' ? 'selected' : '' }}>20.000.000 ₫ - 50.000.000 ₫</option>
                <option value="50000000-" {{ request('price_range') == '50000000-' ? 'selected' : '' }}>Trên 50.000.000 ₫</option>
            </select>
        </div>

        <!-- Lọc ngày -->
        <div class="me-3">
            <label for="start_date" class="form-label">Ngày đi</label>
            <div class="d-flex">
                <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}" onchange="this.form.submit()">
                <span class="mx-2">đến</span>
                <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}" onchange="this.form.submit()">
            </div>
        </div>

        <!-- Lọc địa điểm (Danh mục) -->
        <div class="me-3">
            <label for="location" class="form-label">Lọc theo địa điểm</label>
            <select name="location" class="form-select form-select-sm" id="location" onchange="this.form.submit()">
                <option value="">Tất cả địa điểm</option>
                
            </select>
        </div>
    </form>


    {{-- danh sách tour --}}
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" class="text-center">Ảnh</th>
                <th scope="col">Tên tour</th>
                <th scope="col" class="text-center">Khởi hành </th>
                @if (Auth::guard('admin')->user()->role == 'admin')
                <th scope="col" class="text-center">Đối tác</th>
                @else
                <th scope="col" class="text-center">Ngày Khởi Hành</th>
                @endif
                <th scope="col" class="text-end">Giá</th>
                <!-- <th scope="col" class="text-center">Người đăng ký</th> -->
                <th scope="col" class="text-center">Trạng thái</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr ng-repeat="tour in tours" >
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
                <!-- <td class="text-center">0</td> -->
                <!-- trạng thái -->
                <td class="text-center" ng-bind="tour.is_hidden !== 0 ? 'Ẩn' : 'Hiện'"></td>

                <td class="text-center">
                    <!-- <button class="btn btn-outline-danger">Ẩn Tour</button> -->
                    @if (Auth::guard('admin')->user()->role != 'admin')
                        <a href="/admin/sua-tour/@{{ tour.id }}" class="btn btn-info mb-1">Sửa</a>
                    @endif
                    <button class="btn btn-outline-danger">Ẩn Tour</button>
                    <!-- <a href="/admin/sua-tour/@{{ tour.id }}" class="btn btn-info mb-1">Sửa</a>
                    <button class="btn btn-outline-danger">Xóa</button> -->
                </td>
            </tr>
        </tbody>
    </table>
</section>
<!-- <script>
function hideTour(tourId) {
    // Hiển thị hộp thoại xác nhận
    if (confirm('Bạn có chắc chắn muốn ẩn tour này không?')) {
        // Chuyển hướng đến URL ẩn tour
        window.location.href = `/admin/hide-tour/${tourId}`;
    }
}

function deleteTour(tourId) {
    // Hiển thị hộp thoại xác nhận
    if (confirm('Bạn có chắc chắn muốn xóa tour này không?')) {
        // Chuyển hướng đến URL xóa tour
        window.location.href = `/admin/delete-tour/${tourId}`;
    }
}
</script> -->
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