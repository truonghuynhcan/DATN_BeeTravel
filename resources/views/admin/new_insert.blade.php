@extends('admin.layout.index')
@section('title')
    Thêm tin tức
@endsection
@section('main')
    <!-- TRÌNH SOẠN THẢO -->
    <script>
        tinymce.init({
            selector: 'textarea#2',
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
    <form action="{{ route('admin.newInsert_') }}" method="post" enctype="multipart/form-data">
        @csrf
        <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top z-1">
            <h2 class="">Thêm tin tức mới</h2>
            <div>
                <button type="submit" name="post" id="post-btn" class="btn btn-primary" style="height: fit-content;">Đăng / Cập nhật</button>
                <button type="submit" name="draft" id="draft-btn" class="btn btn-outline-primary" style="height: fit-content;">Lưu nháp / Ẩn</button> <!-- lưu với trạng thái ẩn -->
            </div>
        </header>
        <div class="accordion mb-3" id="accordionExample">
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
                        <!-- <li>Xử lý bài toán ngày khởi hành tour</li>
                        <li>Xử lý phương tiện di chuyển</li>
                        <li>Xử lý nhập nổi bật</li> -->
                    </ul>
                </div>
                <div class="alert alert-success">
                    <h4>Done</h4>
                    <ul>
                        <!-- <li>Bắt lỗi form</li>
                        <li>Auto slug - tiện lợi người dùng</li>
                        <li>Xử dụng trình soạn thảo cho phần chi tiết tour - dễ trình bày</li>
                        <li>Chọn ngày giờ khởi hành thủ công - có btn thêm ngày giờ khởi hành</li>
                        <li>Chọn đối tác (đối với admin khi nhập tour)</li>
                        <li>Chọn danh mục - có lọc trong nước và ngoài nước theo select</li>
                        <li>Auto load ảnh mẫu trước khi choose file</li>
                        <li>Thời gian diễn ra tour - thân thiện, thống nhất cho người dùng</li>
                        <li>...</li> -->
                    </ul>
                </div>
                </div>
              </div>
            </div>
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
            <!-- NỘI DUNG CHI TIẾT TIN TỨC-->
            <div class="col-9">
                <section class="bg-body rounded mb-3">
                    <input name="title" value="{{ old('title') }}" id="title" class="form-control form-control-lg" type="text" placeholder="Tên tin tức tour (không vượt quá 255 ký tự) " aria-label=".form-control-lg example">
                </section>

                {{-- Nổi bật --}}
                @if (Auth::guard('admin')->user()->role == 'admin')
                <section class="bg-body rounded p-2 mb-3"> 
    <h5>Nổi bật</h5>
    <div class="d-flex">
    
    <div class="me-3">
            <label for="area" class="form-label">Chọn vị trí</label>
            <select name="reading" class="form-select form-select-sm" id="area" aria-label="Small select example" onchange="updateAvailablePositions()">
                <option selected disabled>Chọn mã vị trí</option>
                @for ($i = 1; $i <= 30; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        
        <!-- <div class="me-3">
            <label for="date" class="form-label">Chọn ngày bắt đầu, kết thúc</label>
            <div class="d-flex">
            <input name="featured_start" type="datetime-local" class="form-control form-control-sm" id="date1" onchange="updateTourVisibility()" required>
            <input name="featured_end" type="datetime-local" class="form-control form-control-sm" id="date2" onchange="updateTourVisibility()" required>
                
            </div>
        </div> -->
        
    </div>
</section>
<script>
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

        // Cập nhật danh sách tour hiển thị dựa trên vị trí đã chọn
        updateTourVisibilityByPosition(selectedPosition);
    }

    // Hàm cập nhật hiển thị các tour theo vị trí
    function updateTourVisibilityByPosition(selectedPosition) {
        const tourNews = document.querySelectorAll('.tour-new');

        tourNews.forEach(card => {
            const newPosition = card.getAttribute('data-position'); // Giá trị vị trí của tour

            // Kiểm tra xem tour có cùng vị trí với vị trí đã chọn không
            if (newPosition === selectedPosition) {
                card.style.display = 'block'; // Hiện tour có vị trí phù hợp
            } else {
                card.style.display = 'none'; // Ẩn tour không phù hợp
            }
        });
    }
</script>
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
                    <label for="description" class="h5">Mô tả ngắn (tin tức) <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
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
                <label for="content" class="h5">Chi Tiết Tin Tức (cụ thể) <span class="text-danger">*</span></label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
                    <!-- <label for="content" class="h5">Chi Tiết Tin Tức (cụ thể) <span class="text-danger">*</span></label>
                    <textarea name="content" id="content">{{ old('content') }}</textarea> -->
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
                    <label for="news_categories" class="form-label">
                        <h5>Chọn danh mục <span class="text-danger">*</span></h5>
                    </label>
                    <!-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" ng-model="tour_nuoc_ngoai" id="tour_nuoc_ngoai">
                        <label class="form-check-label opacity-75" for="tour_nuoc_ngoai">
                            Tour nước ngoài
                        </label>
                    </div> -->
                    <select name="category_id" class="form-select form-select-sm" aria-label="Small select example" ng-model="selectedCategory">
                        <option value="" selected>Chọn danh mục tin tức</option>
                        <optgroup label="Tin tức tổng hợp">
                            <option ng-repeat="catenew in news_categories" value="@{{ catenew.id }}">
                                @{{ catenew.title }}
                            </option>
                        </optgroup>
                    </select>
                </section>
                <section class="bg-body rounded mb-3 p-2">
                    <p class="mb-2">
                    <h5>Ảnh đại diện <span class="text-danger">*</span></h5>
                    </p>
                    <label for="fileUpload" class="form-label">
                        <img id="mainImage" src="{{ asset('') }}assets/image/img_phaceholder.jpg" alt="ảnh nè" width="100%" class="img-thumbnail object-fit-contain mb-3">
                    </label>
                    <input name="image_url" type="file" class="form-control mb-3" accept="image/*" id="fileUpload">
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

                    // document.getElementById('fileUpload1').addEventListener('change', function() {
                    //     updateImage(this, 'image1', allowedImageTypes);
                    // });

                    // document.getElementById('fileUpload2').addEventListener('change', function() {
                    //     updateImage(this, 'image2', allowedImageTypes);
                    // });

                    // document.getElementById('fileUpload3').addEventListener('change', function() {
                    //     updateImage(this, 'image3', allowedImageTypes);
                    // });

                    // document.getElementById('fileUpload4').addEventListener('change', function() {
                    //     updateImage(this, 'image4', allowedImageTypes);
                    // });
                </script>
            </div>
        </div>
    </form>
@endsection


@section('viewFunction')
    <script>
        viewFunction = function($scope, $http) {
            // API danh mục tour
            $http.get('/admin/api/danh-muc-new').then(
                function(res) { // success
                    $scope.news_categories = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh mục news:', error); // Ghi lỗi
                }
            );

            // API đối tác
            $http.get('/admin/api/danh-sach-admin?role=provider&is_block=0').then(
                function(res) { // success
                    $scope.providers = res.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh mục news:', error); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
