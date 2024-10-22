@extends('admin.layout.index')
@section('title')
    Thêm tour
@endsection
@section('main')
    <!-- TRÌNH SOẠN THẢO -->
    <script>
        tinymce.init({
            selector: 'textarea#content',
            height: 400,
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
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top">
            <h2 class="">Thêm tour mới</h2>
            <div>
                <button type="submit" name="post" class="btn btn-primary" style="height: fit-content;">Đăng / Cập nhật</button>
                <button type="submit" name="postHidden" href="" class="btn btn-outline-primary" style="height: fit-content;">Lưu nháp / Ẩn</button> <!-- lưu với trạng thái ẩn -->
            </div>
        </header>
        <div class="alert alert-danger">
            <h4>Todo</h4>
            <ul>
                <li>tim fhiểm làm api hoặc truyền trực tiếp</li>
            </ul>
        </div>
        <div class="row">
            <!-- NỘI DUNG CHI TIẾT -->
            <div class="col-9">
                <section class="bg-body rounded mb-3">
                    <input class="form-control form-control-lg" type="text" placeholder="Tên tour" aria-label=".form-control-lg example">
                </section>

                <section class="bg-body rounded p-2 mb-3"> <!-- ẩn khi là đối tác -->
                    <h5>Nổi bật</h5>
                    <div class="d-flex">
                        <div class="me-3">
                            <label for="area" class="form-label">Chọn vị trí</label>
                            <select class="form-select form-select-sm" id="area" aria-label="Small select example">
                                <option selected>Mã vị trí</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                            </select>
                        </div>
                        <div class="me-3">
                            <label for="date" class="form-label">Chọn ngày bắt đầu, kết thúc</label>
                            <div class="d-flex">
                                <input type="date" class="form-control form-control-sm" id="date1">
                                <span class="mx-2">đến</span>
                                <input type="date" class="form-control form-control-sm" id="date2">
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-body rounded p-2 mb-3">
                    <h5>Mô tả ngắn</h5>
                    <textarea class="d-block w-100"></textarea>
                </section>

                <section class="bg-body rounded p-2 mb-3">
                    <h5>Chi tiết Tour</h5>
                    <textarea id="content"></textarea>
                </section>

                <!-- Ngày đi / ngày khởi hành -->
                <section class="bg-body rounded p-2 mb-3">
                    <h5>Ngày giờ khởi hành</h5>
                    <p class="form-label text-body-tertiary">Chọn ngày giờ khởi hành</p>

                    <div id="departure-container">
                        <div class="mb-4 departure-block">
                            <div class="d-flex">
                                <input type="datetime-local" class="form-control form-control-sm fw-bold" name="departure-date[]" style="max-width: fit-content;">
                                <hr class="d-inline w-100">
                                <button class="btn btn-outline-danger btn-sm ms-2 remove-departure">Xóa</button> <!-- Nút xóa -->
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="adult-price" class="form-label">Giá người lớn (>12 tuổi)</label>
                                    <input type="number" class="form-control form-control-sm" name="adult-price[]">
                                </div>
                                <div class="col-3">
                                    <label for="child-price" class="form-label">Giá trẻ em (5-12 tuổi)</label>
                                    <input type="number" class="form-control form-control-sm" name="child-price[]">
                                </div>
                                <div class="col-3">
                                    <label for="toddler-price" class="form-label">Giá trẻ nhỏ (2-5 tuổi)</label>
                                    <input type="number" class="form-control form-control-sm" name="toddler-price[]">
                                </div>
                                <div class="col-3">
                                    <label for="infant-price" class="form-label">Giá em bé (dưới 2 tuổi)</label>
                                    <input type="number" class="form-control form-control-sm" name="infant-price[]">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button id="add-departure" class="btn btn-outline-primary">+ thêm ngày giờ khởi hành</button>
                </section>
                <!-- JS CHO CHỨC NĂNG THÊM NGÀY ĐI -->
                <script>
                    // Thêm sự kiện cho nút thêm ngày giờ khởi hành
                    document.getElementById('add-departure').addEventListener('click', function() {
                        // Clone the first departure block
                        var firstBlock = document.querySelector('.departure-block');
                        var newBlock = firstBlock.cloneNode(true);

                        // Clear input values in the new block
                        var inputs = newBlock.querySelectorAll('input');
                        inputs.forEach(input => input.value = '');

                        // Append the new block to the container
                        document.getElementById('departure-container').appendChild(newBlock);

                        // Gán lại sự kiện xóa cho nút xóa trong khối mới
                        newBlock.querySelector('.remove-departure').addEventListener('click', function() {
                            newBlock.remove(); // Xóa khối
                        });
                    });

                    // Gán sự kiện cho nút xóa trong khối đầu tiên
                    document.querySelector('.remove-departure').addEventListener('click', function() {
                        this.closest('.departure-block').remove(); // Xóa khối
                    });
                </script>

                <!-- show biểu đồ khi có nội dung  -->
                <section class="bg-body rounded p-2 mb-3">
                    <h5>Thống kê lượt đặt tour theo THÁNG</h5>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <script>
                        const ctx = document.getElementById('myChart');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                                datasets: [{
                                        label: 'Số đơn đặt tour',
                                        data: [12, 19, 3, 5, 2, 3, 15, 23, 18, 12, 9, 6], // Dữ liệu cho dây 1
                                        borderColor: 'rgba(75, 192, 192, 1)', // Màu dây 1
                                        borderWidth: 2, // Độ dày của dây 1
                                        fill: false // Không tô màu dưới đường
                                    },
                                    {
                                        label: 'Số người tham gia',
                                        data: [12, 32, 13, 22, 31, 18, 29, 33, 41, 26, 35, 23], // Dữ liệu cho dây 2
                                        borderColor: 'rgba(255, 99, 132, 1)', // Màu dây 2
                                        borderWidth: 1, // Độ dày của dây 2
                                        fill: false // Không tô màu dưới đường
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
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
                        <img id="mainImage" src="../../assets/image/img_phaceholder.jpg" alt="ảnh nè" width="100%" class="img-thumbnail object-fit-contain mb-3">
                    </label>
                    <input type="file" class="form-control mb-3" accept="image/*" id="fileUpload">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed p-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Thêm ảnh phụ
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse pt-2" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body p-1">
                                    <img id="image1" src="../../assets/image/img_phaceholder.jpg" height="80px" alt="" class="object-fit-cover">
                                    <input type="file" class="form-control mb-1" name="fileUpload1" accept="image/*" id="fileUpload1">
                                </div>
                                <div class="accordion-body p-1">
                                    <img id="image2" src="../../assets/image/img_phaceholder.jpg" height="80px" alt="" class="object-fit-cover">
                                    <input type="file" class="form-control mb-1" name="fileUpload2" accept="image/*" id="fileUpload2">
                                </div>
                                <div class="accordion-body p-1">
                                    <img id="image3" src="../../assets/image/img_phaceholder.jpg" height="80px" alt="" class="object-fit-cover">
                                    <input type="file" class="form-control mb-1" name="fileUpload3" accept="image/*" id="fileUpload3">
                                </div>
                                <div class="accordion-body p-1">
                                    <img id="image4" src="../../assets/image/img_phaceholder.jpg" height="80px" alt="" class="object-fit-cover">
                                    <input type="file" class="form-control mb-1" name="fileUpload4" accept="image/*" id="fileUpload4">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- js kiểm tra định dạng file và show ảnh demo khi người dùng upfile -->
                <script>
                    // Hàm để kiểm tra định dạng file hợp lệ
                    function validateFileType(file, allowedTypes) {
                        const fileType = file.type;
                        return allowedTypes.includes(fileType);
                    }

                    // Hàm cập nhật ảnh và kiểm tra định dạng
                    function updateImage(inputElement, imgElementId, allowedTypes) {
                        const file = inputElement.files[0];

                        if (file) {
                            if (validateFileType(file, allowedTypes)) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById(imgElementId).src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            } else {
                                alert("File không hợp lệ! Vui lòng chọn file có định dạng ảnh như PNG, JPG, GIF, WEBP hoặc SVG.");
                                inputElement.value = ""; // Reset input file
                            }
                        }
                    }

                    // Các loại file ảnh hợp lệ
                    const allowedImageTypes = ["image/png", "image/jpeg", "image/jpg", "image/gif", "image/webp", "image/svg+xml"];

                    // Lắng nghe sự kiện thay đổi file và kiểm tra định dạng
                    document.getElementById('fileUpload').addEventListener('change', function() {
                        updateImage(this, 'mainImage', allowedImageTypes);
                    });

                    document.getElementById('fileUpload1').addEventListener('change', function() {
                        updateImage(this, 'image1', allowedImageTypes);
                    });

                    document.getElementById('fileUpload2').addEventListener('change', function() {
                        updateImage(this, 'image2', allowedImageTypes);
                    });

                    document.getElementById('fileUpload3').addEventListener('change', function() {
                        updateImage(this, 'image3', allowedImageTypes);
                    });

                    document.getElementById('fileUpload4').addEventListener('change', function() {
                        updateImage(this, 'image4', allowedImageTypes);
                    });
                </script>



                <section class="bg-body rounded mb-3 p-2">
                    <div class=" mb-3">
                        <h6>Phương tiện di chuyển</h6>
                        <input type="text" class="form-control" id="transport" placeholder="xe hơi" value="">
                    </div>
                    <div class="">
                        <h6>Thời gian diễn ra tour</h6>
                        <input type="text" class="form-control" id="duration" placeholder="2n1d, 4n5d, 7n7d" value="">
                    </div>
                </section>


                <section class="bg-body rounded mb-3 p-2">
                    <label for="">Số lượng đặt tour</label>
                    <input type="number" class="form-control" disabled id="" value="0">
                    <hr>
                    <label for="">Đã đánh giá</label>
                    <input type="number" class="form-control" disabled id="" value="0">
                    <p class="text-primary mb-0">
                        <strong>4.5</strong>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <i class="bi bi-star"></i>
                    </p>
                    <hr>
                    <label for="">Đã Thích</label>
                    <input type="number" class="form-control" disabled id="" value="0">
                    <hr>
                    <a href="">Bình luận</a>
                    <input type="number" class="form-control" disabled id="" value="0">
                </section>
            </div>
        </div>
    </form>
@endsection

@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {

        };
    </script>
@endsection
