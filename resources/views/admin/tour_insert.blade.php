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
            'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code'
        ],
        toolbar: 'undo redo | insert | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code',
        powerpaste_allow_local_images: true,
        powerpaste_word_import: 'prompt',
        powerpaste_html_import: 'prompt',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>
<form action="{{ route('admin.tourInsert_') }}" method="post" enctype="multipart/form-data">
    @csrf
    <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top z-1">
        <h2 class="">Thêm tour mới</h2>
        <div>
            <button type="submit" name="post" id="post-btn" class="btn btn-primary" style="height: fit-content;">Đăng / Cập nhật</button>
            <button type="submit" name="draft" id="draft-btn" class="btn btn-outline-primary" style="height: fit-content;">Lưu nháp / Ẩn</button> <!-- lưu với trạng thái ẩn -->
        </div>
    </header>
    <!-- <div class="accordion mb-3" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Todo list
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show bg-body-secondary border border-1 border-black" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="alert alert-danger">
                        <h4>Todo</h4>
                        <ul>
                            <li>Xử lý bài toán ngày khởi hành tour</li>
                            <li>Xử lý phương tiện di chuyển</li>
                            <li>Xử lý nhập nổi bật</li>
                        </ul>
                    </div>
                    <div class="alert alert-success">
                        <h4>Done</h4>
                        <ul>
                            <li>Bắt lỗi form</li>
                            <li>Auto slug - tiện lợi người dùng</li>
                            <li>Xử dụng trình soạn thảo cho phần chi tiết tour - dễ trình bày</li>
                            <li>Chọn ngày giờ khởi hành thủ công - có btn thêm ngày giờ khởi hành</li>
                            <li>Chọn đối tác (đối với admin khi nhập tour)</li>
                            <li>Chọn danh mục - có lọc trong nước và ngoài nước theo select</li>
                            <li>Auto load ảnh mẫu trước khi choose file</li>
                            <li>Thời gian diễn ra tour - thân thiện, thống nhất cho người dùng</li>
                            <li>...</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
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
                <input name="title" value="{{ old('title') }}" id="title" class="form-control form-control-lg" type="text" placeholder="Tên tour (không quá 255 ký tự) *" aria-label=".form-control-lg example">
            </section>

            {{-- Nổi bật --}}
            @if (Auth::guard('admin')->user()->role == 'admin')
            

            <!-- <section class="bg-body rounded p-2 mb-3"> 
            <h5>Nổi bật</h5>
<div class="d-flex">
    <div class="me-3">
        <label for="area" class="form-label">Chọn vị trí</label>
        <select name="featured" class="form-select form-select-sm" id="area" aria-label="Small select example">
            <option selected disabled>Chọn mã vị trí</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>
    <div class="me-3">
        <label for="date" class="form-label">Chọn ngày bắt đầu, kết thúc</label>
        <div class="d-flex">
            <input name="featured_start" type="date" class="form-control form-control-sm" id="date1" value="">
            <span class="mx-2">đến</span>
            <input name="featured_end" type="date" class="form-control form-control-sm" id="date2" value="">
        </div>
    </div>
</div>
            </section> -->
            <!-- <section class="bg-body rounded p-2 mb-3"> 
    <h5>Nổi bật</h5>
    <div class="d-flex">
    
    <div class="me-3">
            <label for="area" class="form-label">Chọn vị trí</label>
            <select name="featured" class="form-select form-select-sm" id="area" aria-label="Small select example" onchange="updateAvailablePositions()">
                <option selected disabled>Chọn mã vị trí</option>
                @for ($i = 1; $i <= 30; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        
        <div class="me-3">
            <label for="date" class="form-label">Chọn ngày bắt đầu, kết thúc</label>
            <div class="d-flex">
            <input name="featured_start" type="datetime-local" class="form-control form-control-sm" id="date1" onchange="updateTourVisibility()" >
            <input name="featured_end" type="datetime-local" class="form-control form-control-sm" id="date2" onchange="updateTourVisibility()" >
            </div>
        </div>
        
    </div>
</section> -->
<!-- <script>
    // Hàm cập nhật các vị trí có sẵn
    function updateAvailablePositions() {
        const selectElement = document.getElementById('area');
        const selectedPosition = selectElement.value;

        // Lặp qua tất cả các tùy chọn trong dropdown
        for (let option of selectElement.options) {
            // Kiểm tra nếu vị trí đã chọn là vị trí hiện tại
            if (option.value === selectedPosition) {
                option.style.display = 'none'; // Ẩn vị trí đã chọn
            } else {
                option.style.display = 'block'; // Hiện các vị trí khác
            }
        }

        // Cập nhật danh sách tour hiển thị
        updateTourVisibility();
    }

    // Hàm cập nhật hiển thị các tour
    function updateTourVisibility() {
        const startDate = document.getElementById('date1').value; // Lấy giá trị từ trường ngày bắt đầu
        const endDate = document.getElementById('date2').value; // Lấy giá trị từ trường ngày kết thúc
        const tourCards = document.querySelectorAll('.tour-card');

        // Chuyển đổi ngày bắt đầu và kết thúc thành đối tượng Date nếu có giá trị
        const start = startDate ? new Date(startDate) : null;
        const end = endDate ? new Date(endDate) : null;

        tourCards.forEach(card => {
            const cardStartDate = new Date(card.getAttribute('data-start-date')); // Giá trị ngày bắt đầu của tour
            const cardEndDate = new Date(card.getAttribute('data-end-date')); // Giá trị ngày kết thúc của tour

            // Kiểm tra xem tour có nằm trong khoảng thời gian đã chọn không
            const isAfterStartDate = start ? cardStartDate >= start : true;
            const isBeforeEndDate = end ? cardEndDate <= end : true;

            // Cập nhật hiển thị cho từng thẻ tour
            if (isAfterStartDate && isBeforeEndDate) {
                card.style.display = 'block'; // Hiện tour còn hiệu lực
            } else {
                card.style.display = 'none'; // Ẩn tour đã hết hạn
            }
        });
    }
</script> -->
<!-- <script>
    // Hàm cập nhật các vị trí có sẵn
    function updateAvailablePositions() {
        const selectElement = document.getElementById('area');
        const selectedPosition = selectElement.value;

        // Lặp qua tất cả các tùy chọn trong dropdown
        for (let option of selectElement.options) {
            if (option.value === selectedPosition) {
                option.style.display = 'none'; // Ẩn vị trí đã chọn
            } else {
                option.style.display = 'block'; // Hiện các vị trí khác
            }
        }

        // Cập nhật danh sách tour hiển thị
        updateTourVisibility();
    }

    // Hàm cập nhật hiển thị các tour
    function updateTourVisibility() {
        const startDate = document.getElementById('date1').value; // Lấy giá trị từ trường ngày bắt đầu
        const endDate = document.getElementById('date2').value; // Lấy giá trị từ trường ngày kết thúc
        const tourCards = document.querySelectorAll('.tour-card');

        tourCards.forEach(card => {
            const cardStartDate = card.getAttribute('data-start-date'); // Giá trị ngày bắt đầu của tour
            const cardEndDate = card.getAttribute('data-end-date'); // Giá trị ngày kết thúc của tour

            const isAfterStartDate = startDate ? new Date(cardStartDate) >= new Date(startDate) : true;
            const isBeforeEndDate = endDate ? new Date(cardEndDate) <= new Date(endDate) : true;

            // Kiểm tra xem tour có nằm trong khoảng thời gian đã chọn không
            if (isAfterStartDate && isBeforeEndDate) {
                card.style.display = 'block'; // Hiện tour còn hiệu lực
            } else {
                card.style.display = 'none'; // Ẩn tour đã hết hạn
            }
        });
    }
</script> -->
<!-- <script>
    // Hàm cập nhật các vị trí có sẵn
    function updateAvailablePositions() {
        const selectElement = document.getElementById('area');
        const selectedPosition = selectElement.value;

        // Lặp qua tất cả các tùy chọn trong dropdown
        Array.from(selectElement.options).forEach(option => {
            if (option.value === selectedPosition) {
                option.style.display = 'none'; // Ẩn vị trí đã chọn
            } else {
                option.style.display = 'block'; // Hiện các vị trí khác
            }
        });

        // Cập nhật danh sách tour hiển thị
        updateTourVisibility();
    }

    // Hàm cập nhật hiển thị các tour
    function updateTourVisibility() {
        const startDate = document.getElementById('date1').value; // Lấy giá trị từ trường featured_start
        const endDate = document.getElementById('date2').value; // Lấy giá trị từ trường featured_end
        const tourCards = document.querySelectorAll('.tour-card');

        tourCards.forEach(card => {
            const cardStartDate = card.getAttribute('data-start-date'); // Giá trị ngày bắt đầu của tour
            const cardEndDate = card.getAttribute('data-end-date'); // Giá trị ngày kết thúc của tour

            const isAfterStartDate = startDate ? new Date(cardStartDate) >= new Date(startDate) : true;
            const isBeforeEndDate = endDate ? new Date(cardEndDate) <= new Date(endDate) : true;

            // Kiểm tra xem tour có nằm trong khoảng thời gian đã chọn không
            if (isAfterStartDate && isBeforeEndDate) {
                card.style.display = 'block'; // Hiện tour còn hiệu lực
            } else {
                card.style.display = 'none'; // Ẩn tour đã hết hạn
            }
        });
    }
</script> -->
            <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.getElementById('area');
        const startDateInput = document.getElementById('date1');
        const endDateInput = document.getElementById('date2');

        // Lắng nghe sự kiện change cho dropdown
        selectElement.addEventListener('change', function() {
            const selectedValue = this.value;

            // Cập nhật giá trị cho trường 'featured'
            const featuredInput = document.createElement('input');
            featuredInput.type = 'hidden';
            featuredInput.name = 'featured';
            featuredInput.value = selectedValue;

            // Xóa input cũ nếu có
            const existingFeaturedInput = document.querySelector('input[name="featured"]');
            if (existingFeaturedInput) {
                existingFeaturedInput.remove();
            }

            // Thêm input mới vào form
            this.parentNode.appendChild(featuredInput);
        });

        // Lắng nghe sự kiện change cho các trường ngày
        startDateInput.addEventListener('change', function() {
            const startDateValue = this.value;

            // Cập nhật giá trị cho trường 'featured_start'
            const startInput = document.createElement('input');
            startInput.type = 'date';
            startInput.name = 'featured_start';
            startInput.value = startDateValue;

            // Xóa input cũ nếu có
            const existingStartInput = document.querySelector('input[name="featured_start"]');
            if (existingStartInput) {
                existingStartInput.remove();
            }

            // Thêm input mới vào form
            this.parentNode.appendChild(startInput);
        });

        endDateInput.addEventListener('change', function() {
            const endDateValue = this.value;

            // Cập nhật giá trị cho trường 'featured_end'
            const endInput = document.createElement('input');
            endInput.type = 'date';
            endInput.name = 'featured_end';
            endInput.value = endDateValue;

            // Xóa input cũ nếu có
            const existingEndInput = document.querySelector('input[name="featured_end"]');
            if (existingEndInput) {
                existingEndInput.remove();
            }

            // Thêm input mới vào form
            this.parentNode.appendChild(endInput);
        });
    });
</script> -->
            @endif
            <section class="bg-body rounded p-2 mb-3">
                <div class="d-flex gap-3 justify-content-between">
                    <label for="slug" class="h5">Slug</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="autoSlugCheck" checked>
                        <label class="form-check-label opacity-75" for="autoSlugCheck">
                            Tự động tạo slug
                        </label>
                    </div>
                </div>
                <input type="text" name="slug" value="{{ old('slug') }}" id="slug" class="form-control mb-3">
                <label for="sub_title" class="h5">Mô tả ngắn <span class="text-danger">*</span></label>
                <textarea name="sub_title" id="sub_title" class="form-control">{{ old('sub_title') }}</textarea>
            </section>

            {{-- JS auto slug --}}
            <script>
                const titleInput = document.getElementById('title');
                const slugInput = document.getElementById('slug');
                const autoSlugCheck = document.getElementById('autoSlugCheck');

                titleInput.addEventListener('input', function() {
                    if (autoSlugCheck.checked) { // Chỉ tạo slug nếu checkbox được chọn
                        const title = this.value;
                        const slug = title
                            .toLowerCase()
                            .replace(/đ/g, 'd') // Chuyển "đ" thành "d"
                            .normalize('NFD') // Chuẩn hóa để tách dấu ra khỏi chữ cái
                            .replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu
                            .replace(/[^a-z0-9\s-]/g, '') // Xóa ký tự đặc biệt
                            .replace(/\s+/g, '-') // Thay khoảng trắng bằng dấu gạch ngang
                            .replace(/-+/g, '-'); // Xóa các dấu gạch ngang liên tiếp
                        slugInput.value = slug;
                    }
                });

                // Cho phép người dùng chỉnh sửa slug thủ công nếu checkbox không được chọn
                autoSlugCheck.addEventListener('change', function() {
                    if (!this.checked) {
                        slugInput.removeAttribute('readonly');
                    } else {
                        slugInput.setAttribute('readonly', true);
                    }
                });

                // Đặt slug là readonly khi checkbox được chọn
                if (autoSlugCheck.checked) {
                    slugInput.setAttribute('readonly', true);
                }
            </script>


            <section class="bg-body rounded p-2 mb-3">
                <label for="content" class="h5">Chi tiết Tour <span class="text-danger">*</span></label>
                <textarea name="description" id="content">{{ old('description') }}</textarea>
            </section>

            <!-- Ngày đi / ngày khởi hành -->
            <section class="bg-body rounded p-2 mb-3">
                <h5>Ngày giờ khởi hành</h5>
                <p class="form-label text-body-tertiary">Chọn ngày giờ khởi hành</p>

                <div id="departure-container">
                    @foreach (old('departure-date', [['']]) as $key => $date)
                    <div class="mb-4 departure-block">
                        <div class="d-flex">
                            <input type="datetime-local" value="{{ old('departure-date.' . $key, null) }}" class="form-control form-control-sm fw-bold" name="departure-date[]" style="max-width: fit-content;">
                            <hr class="d-inline w-100">
                            <button type="button" class="btn btn-outline-danger btn-sm ms-2 remove-departure" onclick="removeDeparture(this)">Xóa</button> <!-- Nút xóa -->
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="adult-price" class="form-label">Giá người lớn (>12 tuổi) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" name="adult-price[]" min="0" value="{{ old('adult-price[].' . $key, null) }}">
                            </div>
                            <div class="col-3">
                                <label for="child-price" class="form-label">Giá trẻ em (5-12 tuổi) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" name="child-price[]" min="0" value="{{ old('child-price[].' . $key, null) }}">
                            </div>
                            <div class="col-3">
                                <label for="toddler-price" class="form-label">Giá trẻ nhỏ (2-5 tuổi) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" name="toddler-price[]" min="0" value="{{ old('toddler-price[].' . $key, null) }}">
                            </div>
                            <div class="col-3">
                                <label for="infant-price" class="form-label">Giá em bé (dưới 2 tuổi) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" name="infant-price[]" min="0" value="{{ old('infant-price[].' . $key, null) }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button type="button" id="add-departure" class="btn btn-outline-primary">+ Thêm ngày giờ khởi hành</button>
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
                    <option value="" selected>Chọn đối tác</option>
                    <option ng-repeat="provider in providers" value="@{{ provider.id }}">@{{ provider.name }}</option>
                </select>
                @else
                <input name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" hidden></input>
                @endif
                <label for="categories" class="form-label">
                    <h5>Chọn danh mục <span class="text-danger">*</span></h5>
                </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" ng-model="tour_nuoc_ngoai" id="tour_nuoc_ngoai">
                    <label class="form-check-label opacity-75" for="tour_nuoc_ngoai">
                        Tour nước ngoài
                    </label>
                </div>
                <select name="category_id" class="form-select form-select-sm mb-3" aria-label="Small select example" ng-model="selectedCategory">
                    <option value="" selected>Chọn danh mục tour</option>
                    <optgroup label="Tour trong nước" ng-if="!tour_nuoc_ngoai">
                        <option ng-repeat="cate in categories | filter:{ tour_nuoc_ngoai: 0 }" value="@{{ cate.id }}">
                            @{{ cate.ten_danh_muc }}
                        </option>
                    </optgroup>
                    <optgroup label="Tuor nước ngoài" ng-if="tour_nuoc_ngoai">
                        <option ng-repeat="cate in categories | filter:{ tour_nuoc_ngoai: 1 }" value="@{{ cate.id }}">
                            @{{ cate.ten_danh_muc }}
                        </option>
                    </optgroup>
                </select>
                <!-- <label for="tours" class="form-label">
                    <h5>Chọn nơi khởi hành <span class="text-danger">*</span></h5>
                </label> -->
                <label for="noi_khoi_hanh" class="form-label">
    <h5>Chọn nơi khởi hành <span class="text-danger">*</span></h5>
</label>
<select name="noi_khoi_hanh" class="form-select form-select-sm mb-3" id="noi_khoi_hanh" ng-model="selectedKhoiHanh">
    <option value="" selected>Nơi khởi hành</option>
    <option ng-repeat="khoihanh in khoihanhs" value="@{{ khoihanh.name }}">@{{ khoihanh.name }}</option>
</select>

<!-- <script>
app.controller('AdminTourController', function($scope, $http) {
    $scope.khoihanhs = [];

    // Lấy dữ liệu từ API
    $http.get('https://provinces.open-api.vn/api/')
        .then(function(response) {
            $scope.khoihanhs = response.data; // Lưu dữ liệu vào mảng khoihanhs
        })
        .catch(function(error) {
            console.error('Lỗi khi lấy dữ liệu tỉnh:', error);
        });
});
</script> -->
         </script>       
            </section>
            <section class="bg-body rounded mb-3 p-2">
                <p class="mb-2">
                <h5>Ảnh đại diện <span class="text-danger">*</span></h5>
                </p>
                <label for="fileUpload" class="form-label">
                    <img id="mainImage" src="{{ asset('') }}assets/image/img_phaceholder.jpg" alt="ảnh nè" width="100%" class="img-thumbnail object-fit-contain mb-3">
                </label>
                <input name="image_url" type="file" class="form-control mb-3" accept="image/*" id="fileUpload">

                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Thêm ảnh phụ
                            </button>
                        </h2>
                        {{-- name="fileUpload1" các ảnh phụ (nếu có) --}}
                        <div id="flush-collapseOne" class="accordion-collapse collapse pt-2" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body p-1">
                                <img id="image1" src="{{ asset('') }}assets/image/img_phaceholder.jpg" height="80px" alt="" class="object-fit-cover">
                                <input type="file" class="form-control mb-1" name="sub_image_url[]" accept="image/*" id="fileUpload1">
                            </div>
                            <div class="accordion-body p-1">
                                <img id="image2" src="{{ asset('') }}assets/image/img_phaceholder.jpg" height="80px" alt="" class="object-fit-cover">
                                <input type="file" class="form-control mb-1" name="sub_image_url[]" accept="image/*" id="fileUpload2">
                            </div>
                            <div class="accordion-body p-1">
                                <img id="image3" src="{{ asset('') }}assets/image/img_phaceholder.jpg" height="80px" alt="" class="object-fit-cover">
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
    <div class="mb-3">
        <h6>Phương tiện di chuyển</h6>
        <small class="fs-6 text-body-secondary">Dùng dấu "," giữa các phương tiện</small>
        <input name="transport" type="text" class="form-control" id="transport" placeholder="Xe hơi" value="{{ old('transport') }}">
    </div>
    <div class="mb-3">
        <h6>Thời gian diễn ra tour</h6>
        <div class="d-flex gap-2">
            <input type="number" name="ngay" id="days" class="form-control form-control-sm" min="0" placeholder="Số ngày">
            <span>Ngày</span>
            <input type="number" name="dem" id="nights" class="form-control form-control-sm" min="0" placeholder="Số đêm">
            <span>Đêm</span>
        </div>
        <input name="duration" type="text" id="duration" value="" hidden>
        <p id="error-message" style="color: red; display: none;">Ngày và đêm chỉ được chênh lệch tối đa 1.</p>
        <p id="error-message-0" style="color: red; display: none;">Số ngày và số đêm không được bằng 0.</p>
    </div>
    {{-- Function to update the duration value --}}
    <script>
        function updateDuration() {
            const days = parseInt(document.getElementById('days').value) || 0;
            const nights = parseInt(document.getElementById('nights').value) || 0;
            const errorMessage = document.getElementById('error-message');
            const errorMessage0 = document.getElementById('error-message-0');
            const postBtn = document.getElementById('post-btn');
            const draftBtn = document.getElementById('draft-btn');

            // Check for 0 days and 0 nights
            if (days === 0 && nights === 0) {
                errorMessage0.style.display = 'block';
                errorMessage.style.display = 'none';
                document.getElementById('duration').value = ''; // Clear duration if validation fails
                postBtn.disabled = true; // Disable buttons
                draftBtn.disabled = true;
                return; // Exit the function if both are zero
            } else {
                errorMessage0.style.display = 'none'; // Hide the 0 error message
            }

            // Check the difference between days and nights
            if (Math.abs(days - nights) > 1) {
                errorMessage.style.display = 'block';
                document.getElementById('duration').value = ''; // Clear duration if validation fails
                postBtn.disabled = true; // Disable buttons
                draftBtn.disabled = true;
            } else {
                errorMessage.style.display = 'none';
                document.getElementById('duration').value = `${days}N${nights}Đ`; // Update duration if validation passes
                postBtn.disabled = false; // Enable buttons
                draftBtn.disabled = false;
            }
        }

        // Attach event listeners to both inputs
        document.getElementById('days').addEventListener('input', updateDuration);
        document.getElementById('nights').addEventListener('input', updateDuration);
    </script>
</section>

            <!-- <section class="bg-body rounded mb-3 p-2">
                <div class=" mb-3">
                    <h6>Phương tiện di chuyển</h6>
                    <small class="fs-6 text-body-secondary">Dùng dấu "," giữa các phương tiện</small>
                    <input name="transport" type="text" class="form-control" id="transport" placeholder="Xe hơi" value="{{ old('transport') }}">
                </div>
                <div class="mb-3">
                    <h6>Thời gian diễn ra tour</h6>
                    <div class="d-flex gap-2">
                        <input type="number" name="ngay" id="days" class="form-control form-control-sm" min="0" placeholder="Số ngày">
                        <span>Ngày</span>
                        <input type="number" name="dem" id="nights" class="form-control form-control-sm" min="0" placeholder="Số đêm">
                        <span>Đêm</span>
                    </div>
                    <input name="duration" type="text" id="duration" value="" hidden>
                    <p id="error-message" style="color: red; display: none;">Ngày và đêm chỉ được chênh lệch tối đa 1.</p>
                </div>
                {{-- Function to update the duration value --}}
                <script>
                    function updateDuration() {
                        const days = parseInt(document.getElementById('days').value) || 0;
                        const nights = parseInt(document.getElementById('nights').value) || 0;
                        const errorMessage = document.getElementById('error-message');
                        const postBtn = document.getElementById('post-btn');
                        const draftBtn = document.getElementById('draft-btn');

                        // Check the difference between days and nights
                        if (Math.abs(days - nights) > 1) {
                            errorMessage.style.display = 'block';
                            document.getElementById('duration').value = ''; // Clear duration if validation fails
                            postBtn.disabled = true; // Disable buttons
                            draftBtn.disabled = true;
                        } else {
                            errorMessage.style.display = 'none';
                            document.getElementById('duration').value = `${days}N${nights}Đ`; // Update duration if validation passes
                            postBtn.disabled = false; // Enable buttons
                            draftBtn.disabled = false;
                        }
                    }

                    // Attach event listeners to both inputs
                    document.getElementById('days').addEventListener('input', updateDuration);
                    document.getElementById('nights').addEventListener('input', updateDuration);
                </script>
            </section> -->
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
        $scope.khoihanhs = [];
        // $scope.selectedKhoiHanh = null;
        // Lấy dữ liệu từ API
    $http.get('https://provinces.open-api.vn/api/')
        .then(function(response) {
            $scope.khoihanhs = response.data; // Lưu dữ liệu vào mảng khoihanhs
        })
        .catch(function(error) {
            console.error('Lỗi khi lấy dữ liệu tỉnh:', error);
        });
    };
</script>
@endsection