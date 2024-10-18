@extends('admin.layout.index')
@section('title')
    Quản lý tour
@endsection
@section('main')
    <header class="bg-body rounded p-2 d-flex justify-content-between mb-2">
        <h2 class="">Quản lý tour</h2>
        <a href="" class="btn btn-primary" style="height: fit-content;">Thêm tour mới</a>
    </header>
    <section class="bg-body rounded p-2">
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
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Ảnh</th>
                    <th scope="col">Tên tour</th>
                    <th scope="col" class="text-center">Danh mục</th>
                    <th scope="col" class="text-end">Giá</th>
                    <th scope="col" class="text-center">Người đăng ký</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row" class="text-center"><img src="../../assets/image/tour01.webp" alt="ảnh" class="object-fit-cover" height="60px"></th>
                    <td>Hà Nội - Hà Giang - Lũng Cú - Đồng Văn - Nơi Đá Nở Hoa</td>
                    <td class="text-center">Hà Nội</td>
                    <td class="text-end">6.990.000</td>
                    <td class="text-center">25</td>
                    <td>
                        <a href="" class="btn btn-info">Sửa</a>
                        <button class="btn btn-outline-danger">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection
