@extends('client.layout.index')
@section('title')
    Admin Demo
@endsection
@section('main')

<div class="container">
<p class="text-center text-uppercase fs-4 fst-italic p-4"><b>Trang Admin</b></p>
@auth
<h3>Xin chào {{Auth()->user()->name}}</h3>
<form action="{{route('dangxuat')}}" method='post'>
@csrf
<button class="btn btn-primary rounded-pill">Đăng Xuất</button>
</form>
@else
<a href="/dang-nhap">Đăng Nhập</a>
@endauth
        <div class="row pt-4">
            <div class="col-3 bg-dark-subtle ">
                  <ul class="nav nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Trang thống kê</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                      </li>
                  </ul>
                  <ul class="nav nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Trang người dùng</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                      </li>
                  </ul>
                  <ul class="nav nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Trang sản phẩm</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                      </li>
                  </ul>
                  <ul class="nav nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Phản hồi người dùng</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                      </li>
                  </ul>
                  <ul class="nav nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Bài Post sản phẩm</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                      </li>
                  </ul>
                  <ul class="nav nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Voucher hiện tại</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                      </li>
                  </ul>
            </div>
            <div class="col-9 ">
                <div class="d-grid gap-2 d-md-flex justify-content-md-start m-2">
                    <button class="btn btn-primary me-md-2" type="button">Thêm tour su lịch mới</button>
                  </div>
                <ul class="list-group list-group-horizontal list-group-item-danger">
                    <li class="list-group-item" style="height: 60px; width: 103.5px;">Hình ảnh </li>
                    <li class="list-group-item" style="height: 60px; width: 167px;">Tour du lịch</li>
                    <li class="list-group-item" style="height: 60px; width: 146.5px;">Danh mục Tour </li>
                    <li class="list-group-item" style="height: 60px; width: 178px;">Giá ngươì lớn</li>
                    <li class="list-group-item" style="height: 60px; width: 133.5px;">Số ngày đi </li>
                    <li class="list-group-item" style="height: 60px; width: 101px;">Hành động</li>
                    
                  </ul>
                  <ul class="list-group list-group-horizontal-sm list-group-item-primary list">
                    <li class="list-group-item"><img src="../assets/image/proxy-image.jpg" class="rounded" alt="..." width="70px" height="70px"></li>
                    <li class="list-group-item">Đà Lạt - Đồi Thông</li>
                    <li class="list-group-item">Tour trong nước</li>
                    <li class="list-group-item">450.000 VNĐ/ người</li>
                    <li class="list-group-item">5 Ngày 4 Đêm</li>
                    <li class="list-group-item">
                        <a href="#" class=" text-warning-emphasis">Sửa</a> / <a href="#" class="text-danger">Xóa</a>
                    </li>
                  </ul>
                  <ul class="list-group list-group-horizontal-sm list-group-item-primary list">
                    <li class="list-group-item"><img src="../assets/image/proxy-image.jpg" class="rounded" alt="..." width="70px" height="70px"></li>
                    <li class="list-group-item">Đà Lạt - Đồi Thông</li>
                    <li class="list-group-item">Tour trong nước</li>
                    <li class="list-group-item">450.000 VNĐ/ người</li>
                    <li class="list-group-item">5 Ngày 4 Đêm</li>
                    <li class="list-group-item">
                        <a href="#" class=" text-warning-emphasis">Sửa</a> / <a href="#" class="text-danger">Xóa</a>
                    </li>
                  </ul>
                  <ul class="list-group list-group-horizontal-sm list-group-item-primary list">
                    <li class="list-group-item"><img src="../assets/image/proxy-image.jpg" class="rounded" alt="..." width="70px" height="70px"></li>
                    <li class="list-group-item">Đà Lạt - Đồi Thông</li>
                    <li class="list-group-item">Tour trong nước</li>
                    <li class="list-group-item">450.000 VNĐ/ người</li>
                    <li class="list-group-item">5 Ngày 4 Đêm</li>
                    <li class="list-group-item">
                        <a href="#" class=" text-warning-emphasis">Sửa</a> / <a href="#" class="text-danger">Xóa</a>
                    </li>
                  </ul>
                  <ul class="list-group list-group-horizontal-sm list-group-item-primary list">
                    <li class="list-group-item"><img src="../assets/image/proxy-image.jpg" class="rounded" alt="..." width="70px" height="70px"></li>
                    <li class="list-group-item">Đà Lạt - Đồi Thông</li>
                    <li class="list-group-item">Tour trong nước</li>
                    <li class="list-group-item">450.000 VNĐ/ người</li>
                    <li class="list-group-item">5 Ngày 4 Đêm</li>
                    <li class="list-group-item">
                        <a href="#" class=" text-warning-emphasis">Sửa</a> / <a href="#" class="text-danger">Xóa</a>
                    </li>
                  </ul>
                  <ul class="list-group list-group-horizontal-sm list-group-item-primary list">
                    <li class="list-group-item"><img src="../assets/image/proxy-image.jpg" class="rounded" alt="..." width="70px" height="70px"></li>
                    <li class="list-group-item">Đà Lạt - Đồi Thông</li>
                    <li class="list-group-item">Tour trong nước</li>
                    <li class="list-group-item">450.000 VNĐ/ người</li>
                    <li class="list-group-item">5 Ngày 4 Đêm</li>
                    <li class="list-group-item">
                        <a href="#" class=" text-warning-emphasis">Sửa</a> / <a href="#" class="text-danger">Xóa</a>
                    </li>
                  </ul>
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center pt-2">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item"><a class="page-link" href="#">6</a></li>
                      <li class="page-item"><a class="page-link" href="#">7</a></li>
                      <li class="page-item"><a class="page-link" href="#">...</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
