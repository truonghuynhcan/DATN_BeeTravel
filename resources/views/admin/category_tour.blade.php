@extends('admin.layout.index')
@section('title')
    Quản lý danh mục tour
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý danh mục tour</h2>
        <a href="{{route('admin.catetourInsert')}}" class="btn btn-primary" style="height: fit-content;">Thêm danh mục tour</a>
    </header>
    
    <section class="bg-body rounded p-2">

        {{-- danh sách danh mục tin tức --}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col" class="text-center">Tên danh mục tour</th>
                    <th scope="col" class="text-center">Slug tour</th>
                    <th scope="col" class="text-center">Loại Tour</th>
                    <th scope="col" class="text-center">Số lượng tour</th>
                    <!-- <th scope="col" class="text-center">Nội dung tin tức</th> -->
                    <!-- <th scope="col" class="text-center">Trạng thái</th> -->
                    <th scope="col" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr ng-repeat="tourcate in category_tour">
                    <th scope="row" class="text-center"><img src="{{ asset('') }}assets/image_tour/@{{ tourcate.image_url }}" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td class="text-center">@{{ tourcate.ten_danh_muc }}</td>
                    <!-- Người đăng ký -->
                    <td class="text-center">@{{ tourcate.slug }}</td>
                    <td class="text-center">@{{ tourcate.tour_nuoc_ngoai == 0 ? 'Tour trong nước' : 'Tour nước ngoài' }}</td>
                    <td class="text-center">@{{ tourcate.tours_count }}</td> <!-- Hiển thị số lượng tour -->
                    <!-- Người đăng ký -->
                    <!-- <td class="text-center">@{{ tourcate.content }}</td> -->
                    <!-- trạng thái -->
                    <!-- <td class="text-center" ng-bind=" tourcate.is_hidden !== 0 ? 'Ẩn Tin' : 'Hiện Tin'"></td> -->

                    <td class="text-center">
                    @if (Auth::guard('admin')->user()->role != 'admin')
                    <a href="/admin/sua-category-tour/@{{ tourcate.id }}" class="btn btn-info">Sửa</a>
                    @endif
                    
                    
                    <a href="/admin/xoa-category-tour/@{{ tourcate.id }}" class="btn btn-info mb-1">Xóa Danh Mục Tour</a>
                        
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            $http.get('/admin/api/danh-sach-category-tour').then(
                function(res) { // success
                    $scope.category_tour = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách tours:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
