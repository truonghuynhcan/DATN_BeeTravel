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
    <form action="{{ route('admin.tourEdit_') }}" method="post" enctype="multipart/form-data">
        @csrf
        <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top z-1">
            <h2 class="">Sửa tour #{{ $tour->id }}</h2>
            <div>
                <button type="submit" name="post" class="btn btn-primary" style="height: fit-content;">Đăng / Cập nhật</button>
                <button type="submit" name="draft" href="" class="btn btn-outline-primary" style="height: fit-content;">Lưu nháp / Ẩn</button> <!-- lưu với trạng thái ẩn -->
            </div>
        </header>
        <div class="alert alert-danger">
            <h4>Todo</h4>
            <ul>
                <li>cập nhật sản phẩm</li>
                <li>thiếu dữ liệu số lượng đặt tour</li>
                <li>thiếu dữ liệu số lượng Bình luận</li>
                <li>làm xem thống kê khi đăng ký vip cho tour</li>
            </ul>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- NỘI DUNG CHI TIẾT -->
            <div class="col-9">
                <section class="bg-body rounded mb-3">
                    <input name="title" value="{{ old('title') ?? $tour->title }}" class="form-control form-control-lg" type="text" placeholder="Tên tour (không quá 255 ký tự) *" aria-label=".form-control-lg example">
                </section>

                {{-- Nổi bật --}}
                @if (Auth::guard('admin')->user()->role == 'admin')
                    <section class="bg-body rounded p-2 mb-3"> <!-- ẩn khi là đối tác -->
                        <h5>Nổi bật</h5>
                        <div class="d-flex">
                            <div class="me-3">
                                <label for="area" class="form-label">Chọn vị trí</label>
                                <select name="featured" class="form-select form-select-sm" id="area" aria-label="Small select example">
                                    <option value="{{ old('featured') ?? $tour->featured }}" selected>Mã vị trí</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                </select>
                            </div>
                            <div class="me-3">
                                <label for="date" class="form-label">Chọn ngày bắt đầu, kết thúc</label>
                                <div class="d-flex">
                                    <input name="features_start" type="date" class="form-control form-control-sm" id="date1">
                                    <span class="mx-2">đến</span>
                                    <input name="features_end" type="date" class="form-control form-control-sm" id="date2">
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

                <section class="bg-body rounded p-2 mb-3">
                    <label for="slug" class="h5">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') ?? $tour->slug }}" class="form-control mb-3" id="slug"></input>
                    <label for="sub_title" class="h5">Mô tả ngắn <span class="text-danger">*</span></label>
                    <textarea name="sub_title" id="sub_title" class="form-control">{{ old('sub_title') ?? $tour->sub_title }}</textarea>
                </section>

                <section class="bg-body rounded p-2 mb-3">
                    <label for="content" class="h5">Chi tiết Tour <span class="text-danger">*</span></label>
                    <textarea name="description" id="content">{{ old('description') ?? $tour->description }}</textarea>
                </section>

                <!-- Ngày đi / ngày khởi hành -->
                <section class="bg-body rounded p-2 mb-3">
                    <h5>Ngày giờ khởi hành</h5>
                    <p class="form-label text-body-tertiary">Chọn ngày giờ khởi hành</p>
                    <div id="departure-container">
                        @php
                            // Kiểm tra dữ liệu cũ hoặc dữ liệu từ tour
                            $departureData = old('departure-date', null) ?? $tour->ngayDi;
                        @endphp

                        @if ($departureData && count($departureData) > 0)
                            @foreach ($departureData as $key => $data)
                                <input type="hidden" name="ngayDi_id[]" value="{{ old('ngayDi_id.' . $key) ?? $data->id }}">
                                <div class="mb-4 departure-block">
                                    <div class="d-flex">
                                        <input type="datetime-local" value="{{ old('departure-date.' . $key) ?? $data->start_date }}" class="form-control form-control-sm fw-bold" name="departure-date[]" style="max-width: fit-content;">
                                        <hr class="d-inline w-100">
                                        <button type="button" class="btn btn-outline-danger btn-sm ms-2 remove-departure" onclick="removeDeparture(this)">Xóa</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="adult-price" class="form-label">Giá người lớn (>12 tuổi) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm" name="adult-price[]" min="0" value="{{ old('adult-price.' . $key) ?? $data->price }}">
                                        </div>
                                        <div class="col-3">
                                            <label for="child-price" class="form-label">Giá trẻ em (5-12 tuổi) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm" name="child-price[]" min="0" value="{{ old('child-price.' . $key) ?? $data->price_tre_em }}">
                                        </div>
                                        <div class="col-3">
                                            <label for="toddler-price" class="form-label">Giá trẻ nhỏ (2-5 tuổi) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm" name="toddler-price[]" min="0" value="{{ old('toddler-price.' . $key) ?? $data->price_tre_nho }}">
                                        </div>
                                        <div class="col-3">
                                            <label for="infant-price" class="form-label">Giá em bé (dưới 2 tuổi) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm" name="infant-price[]" min="0" value="{{ old('infant-price.' . $key) ?? $data->price_em_be }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Hiển thị một bảng trống nếu không có dữ liệu -->
                            <div class="mb-4 departure-block">
                                <div class="d-flex">
                                    <input type="datetime-local" class="form-control form-control-sm fw-bold" name="departure-date[]" style="max-width: fit-content;">
                                    <hr class="d-inline w-100">
                                    <button type="button" class="btn btn-outline-danger btn-sm ms-2 remove-departure" onclick="removeDeparture(this)">Xóa</button>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="adult-price" class="form-label">Giá người lớn (>12 tuổi) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="adult-price[]" min="0" value="">
                                    </div>
                                    <div class="col-3">
                                        <label for="child-price" class="form-label">Giá trẻ em (5-12 tuổi) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="child-price[]" min="0" value="">
                                    </div>
                                    <div class="col-3">
                                        <label for="toddler-price" class="form-label">Giá trẻ nhỏ (2-5 tuổi) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="toddler-price[]" min="0" value="">
                                    </div>
                                    <div class="col-3">
                                        <label for="infant-price" class="form-label">Giá em bé (dưới 2 tuổi) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-control-sm" name="infant-price[]" min="0" value="">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <button type="button" id="add-departure" class="btn btn-outline-primary">+ thêm ngày giờ khởi hành</button>
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
                    });

                    function removeDeparture(button) {
                        // Tìm khối cha của nút "Xóa" và xóa nó
                        button.closest('.departure-block').remove();
                    }
                </script>

                <!-- show biểu đồ khi có nội dung  -->
                <section class="bg-body rounded p-2 mb-3">
                    <h5 class="text-center">Thống kê lượt đặt tour theo THÁNG</h5>
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
                    @if (Auth::guard('admin')->user()->role == 'admin')
                        <label for="provider" class="form-label">
                            <h5>Chọn đối tác <span class="text-danger">*</span></h5>
                        </label>
                        <select name="admin_id" class="form-select form-select-sm mb-3" id="provider">
                            <option value="{{ $tour->admin->id }}" selected>{{ $tour->admin->name }}</option>
                            <option ng-repeat="provider in providers" value="@{{ provider.id }}">@{{ provider.name }}</option>
                        </select>
                    @else
                        <input name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" hidden></input>
                    @endif
                    <label for="categories" class="form-label">
                        <h5>Chọn danh mục <span class="text-danger">*</span></h5>
                    </label>
                    <select name="category_id" class="form-select form-select-sm" id="categories" aria-label="Small select example">
                        <option value="{{ $tour->category->id }}" selected>{{ $tour->category->ten_danh_muc }}</option>
                        <option ng-repeat="cate in categories" value="@{{ cate.id }}">@{{ cate.ten_danh_muc }}</option>
                    </select>
                </section>
                <section class="bg-body rounded mb-3 p-2">
                    <p class="mb-2">
                    <h5>Ảnh đại diện <span class="text-danger">*</span></h5>
                    </p>
                    <label for="fileUpload" class="form-label">
                        <img id="mainImage" src="{{ asset('assets/image/' . $tour->image_url ?? 'img_phaceholder.jpg') }}" alt="ảnh nè" width="100%" class="img-thumbnail object-fit-contain mb-3">
                    </label>
                    <input name="image_url" type="file" class="form-control mb-3" accept="image/*" id="fileUpload">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button  p-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Thêm ảnh phụ
                                </button>
                            </h2>
                            {{-- name="fileUpload1" các ảnh phụ (nếu có) --}}
                            <div id="flush-collapseOne" class="accordion-collapse collapse show pt-2" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body p-1">
                                    <img id="image1" src="{{ asset('assets/image/' . (isset($tour->image[0]) ? $tour->image[0]->url : 'img_phaceholder.jpg')) }}" height="80px" alt="" class="object-fit-cover">
                                    <input type="file" class="form-control mb-1" name="sub_image_url[]" accept="image/*" id="fileUpload1">
                                </div>
                                <div class="accordion-body p-1">
                                    <img id="image2" src="{{ asset('assets/image/' . (isset($tour->image[1]) ? $tour->image[1]->url : 'img_phaceholder.jpg')) }}" height="80px" alt="" class="object-fit-cover">
                                    <input type="file" class="form-control mb-1" name="sub_image_url[]" accept="image/*" id="fileUpload2">
                                </div>
                                <div class="accordion-body p-1">
                                    <img id="image3" src="{{ asset('assets/image/' . (isset($tour->image[2]) ? $tour->image[2]->url : 'img_phaceholder.jpg')) }}" height="80px" alt="" class="object-fit-cover">
                                    <input type="file" class="form-control mb-1" name="sub_image_url[]" accept="image/*" id="fileUpload3">
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
                        <small class="fs-6 text-body-secondary">Dùng dấu "," giữa các phương tiện</small>
                        <input name="transport" type="text" class="form-control" id="transport" placeholder="Xe hơi" value="{{ $tour->transport ?? null }}">
                    </div>
                    <div class="">
                        <h6>Thời gian diễn ra tour</h6>
                        <input name="duration" type="text" class="form-control" id="duration" placeholder="2n1d, 4n5d, 7n7d" value="{{ $tour->duration ?? null }}">
                    </div>
                </section>

                <section class="bg-body rounded mb-3 p-2">
                    <label for="">Số lượng đặt tour</label>
                    <input type="number" class="form-control" disabled id="" value="0">
                    <hr>
                    <label for="">Đã đánh giá</label>
                    <input type="number" class="form-control" disabled id="" value="{{ $tour->rating ?? 0 }}">
                    <p class="text-primary mb-0">
                        <strong id="tour-rating">{{ $tour->rating ?? 0 }}</strong>
                        <span id="stars-container">
                            <!-- Các biểu tượng ngôi sao sẽ được chèn ở đây bằng JavaScript -->
                        </span>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const rating = parseFloat(document.getElementById('tour-rating').textContent);
                                const starsContainer = document.getElementById('stars-container');
                                const maxStars = 5;
                                let starHTML = '';

                                for (let i = 1; i <= maxStars; i++) {
                                    if (i <= rating) {
                                        starHTML += '<i class="bi bi-star-fill"></i>'; // Ngôi sao đầy
                                    } else if (i - 0.5 === rating) {
                                        starHTML += '<i class="bi bi-star-half"></i>'; // Ngôi sao nửa
                                    } else {
                                        starHTML += '<i class="bi bi-star"></i>'; // Ngôi sao rỗng
                                    }
                                }

                                starsContainer.innerHTML = starHTML; // Chèn các ngôi sao vào container
                            });
                        </script>
                    </p>

                    <hr>
                    <label for="">Đã Thích</label>
                    <input type="number" class="form-control" disabled value="{{ $tour->wishlists_count ?? 0 }}">
                    <hr>
                    <a href="">Bình luận</a>
                    <input type="number" class="form-control" disabled value="0">
                </section>
            </div>
        </div>
    </form>
@endsection


@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            // API danh mục tour
            $http.get('/admin/api/danh-muc-tour').then(
                function(res) { // success
                    $scope.categories = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh mục tours:', error); // Ghi lỗi
                }
            );

            // API đối tác
            $http.get('/admin/api/danh-sach-admin?role=provider&is_block=0').then(
                function(res) { // success
                    $scope.providers = res.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh mục tours:', error); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
