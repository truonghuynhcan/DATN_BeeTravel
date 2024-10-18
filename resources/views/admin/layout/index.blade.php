<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title') - BeeTravel</title>

    <!-- css -->
    <link rel="stylesheet" href="{{asset('')}}assets/css/bootstrap.css">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- js -->
    <script src="{{asset('')}}assets/bootstrap/js/bootstrap.bundle.min.js" defer></script>

    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->


    <!-- TRÌNH SOẠN THẢO -->
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/j3c0uo9sihhr95e3j0x613exxpc573dgffjby8r3q6q0aand/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    
</head>

<body class="bg-dark-subtle bg-opacity-25">
    <header class="bg-body container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{asset('')}}assets/image/logo_ngang.png" alt="" height="60px">

            <div class="d-flex">
                <button type="button" class="btn btn-outline-primary position-relative me-4 mt-2">
                    <i class="bi bi-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
                <div class="dropdown">
                    <button class="btn btn-secondary bg-secondary bg-opacity-75 rounded-circle p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('')}}assets/image/logo_BeeTravel.png" class="object-fit-cover" height="35px" width="35px" alt="">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr>
                        </li>
                        <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- navbar & nội dung chỉnh -->
    <div class="d-flex">
        <!-- navbar left/ thanh trái -->
        <nav class="bg-body-tertiary bg-opacity-25 p-2 overflow-auto sticky-top" style="width: 250px; height: 100vh;">


            <!-- Đối tác - chỉ show thống kê của riêng đối tác -->
            <div class="list-group mb-3">
                <a href="" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
                    Dashboard
                </a>
                <a href="" class="list-group-item list-group-item-action">Thống kê tour</a>
                <a href="" class="list-group-item list-group-item-action">Thống kê doanh thu</a>
            </div>
            <div class="list-group mb-3">
                <a href="" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
                    Quản lý Tour
                </a>
                <a href="tat-ca-tour.html" class="list-group-item list-group-item-action">Tất cả tour</a>
                <a href="add-new-tour.html" class="list-group-item list-group-item-action">Thêm tour</a>
                <a href="danh-muc-tour.html" class="list-group-item list-group-item-action">Danh mục tour</a>
            </div>
            <div class="list-group mb-3">
                <a href="" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
                    Quản lý Tin tức
                </a>
                <a href="tat-ca-tin-tuc.html" class="list-group-item list-group-item-action">Tất cả tin tức</a>
                <a href="add-new-tin.html" class="list-group-item list-group-item-action">Thêm tin tức</a>
                <a href="danh-muc-tin-tuc.html" class="list-group-item list-group-item-action">Danh mục tin tức</a>
            </div>


            <!-- Show khi là admin -->
            <div class="list-group mb-3">
                <a href="" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
                    Quản lý Người dùng
                </a>
                <a href="" class="list-group-item list-group-item-action">Tất cả đối tác</a>
                <a href="" class="list-group-item list-group-item-action">Thêm đối tác</a>
                <a href="" class="list-group-item list-group-item-action">Tất cả Khách hàng</a>
                <a href="" class="list-group-item list-group-item-action">Thêm khách hàng</a>
                <a href="" class="list-group-item list-group-item-action">Tất cả Admin</a>
                <a href="" class="list-group-item list-group-item-action">Thêm admin</a>
            </div>
            <div class="list-group mb-3">
                <a href="" class="list-group-item list-group-item-action bg-primary-subtle" aria-current="true">
                    Thông tin cá nhân
                </a>
                <a href="" class="list-group-item list-group-item-action">Tài khoản</a>
                <a href="" class="list-group-item list-group-item-action">Ngân hàng</a>
                <a href="" class="list-group-item list-group-item-action">Bảo mật</a>
                <a href="" class="list-group-item list-group-item-action">Cài đặt thông báo</a>
            </div>
        </nav>

        <!-- show nội dung -->
        <section class="w-100 d-inline bg-body-secondary p-2">
            <!-- JS CHO TRÌNH SOẠN THẢO -->
            <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
            <script>
                tinymce.init({
                    selector: 'textarea#content',
                    height: 800,
                    menubar: true,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'advcode', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'powerpaste', 'code'
                    ],
                    toolbar: 'undo redo | insert | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code',
                    powerpaste_allow_local_images: true,
                    powerpaste_word_import: 'prompt',
                    powerpaste_html_import: 'prompt',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
                });
            </script>
            <form action="" method="post">
                <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top">
                    <h2 class="">Thêm tin mới</h2>
                    <div>
                        <button type="submit" name="post" class="btn btn-primary" style="height: fit-content;">Đăng / Cập nhật</button>
                        <button type="submit" name="postHidden" href="" class="btn btn-outline-primary" style="height: fit-content;">Lưu nháp / Ẩn</button> <!-- lưu với trạng thái ẩn -->
                    </div>
                </header>

                <div class="row">
                    <!-- NỘI DUNG CHI TIẾT -->
                    <div class="col-9">
                        <section class="bg-body rounded mb-3">
                            <input name="title" class="form-control form-control-lg" type="text" placeholder="Tiêu đề" aria-label=".form-control-lg example">
                        </section>

                        <section class="bg-body rounded p-2 mb-3">
                            <h5>Mô tả ngắn</h5>
                            <textarea name="description" class="d-block w-100"></textarea>
                        </section>

                        <section class="bg-body rounded p-2 mb-3">
                            <h5>Nội dung</h5>
                            <textarea name="content" id="content"></textarea>
                        </section>
                    </div>


                    <!-- NỘI DUNG NAV RIGHT THÊM, Cate, IMG, 2n1d, phương tiện -->
                    <div class="col-3">
                        <section class="bg-body rounded mb-3 p-2">
                            <label for="cate" class="form-label">
                                <h5>Chọn danh mục</h5>
                            </label>
                            <select class="form-select form-select-sm" id="area" aria-label="Small select example">
                                <option selected>Chọn danh mục tour</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </section>
                        <section class="bg-body rounded mb-3 p-2">
                            <p class="mb-2">
                            <h5>Ảnh đại diện</h5>
                            </p>
                            <label for="fileUpload" class="form-label">
                                <img id="mainImage" src="{{asset('')}}assets/image/img_phaceholder.jpg" alt="ảnh nè" width="100%" class="img-thumbnail object-fit-contain mb-3">
                            </label>
                            <input type="file" class="form-control mb-3" accept="image/*" id="fileUpload">
                        </section>

                        <section class="bg-body rounded mb-3 p-2">
                            <!-- chọn ngày để tin được đăng -->
                            <div class=" mb-3">
                                <h6>Ngày đăng tin</h6>
                                <input type="date" class="form-control" value="">
                            </div>
                            <div class="">
                                <h6>Lần chỉnh sửa cuối</h6>
                                <!-- get updated_at -->
                                <input type="date" class="form-control" disabled value="">
                            </div>
                        </section>


                        <section class="bg-body rounded mb-3 p-2">
                            <label for="">Tổng view</label>
                            <input type="number" class="form-control" disabled id="" value="0">
                        </section>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script src="{{asset()}}assets/js/angular.min.js"></script>
</body>

</html>