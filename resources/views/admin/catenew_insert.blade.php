@extends('admin.layout.index')
@section('title')
    Thêm danh mục tin tức
@endsection
@section('main')
    <form action="{{ route('admin.catenewInsert_') }}" method="post" enctype="multipart/form-data">
        @csrf
        <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top z-1">
            <h2 class="">Thêm danh mục tin tức mới</h2>
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
                    <input name="title" value="{{ old('title') }}" id="title" class="form-control form-control-lg" type="text" placeholder="Tên danh mục tin tức (không vượt quá 255 ký tự) " aria-label=".form-control-lg example">
                </section>

                {{-- Nổi bật --}}
                @if (Auth::guard('admin')->user()->role == 'admin')
                    <section class="bg-body rounded p-2 mb-3"> <!-- ẩn khi là đối tác -->
                        <!-- <h5>Nổi bật</h5>
                        <div class="d-flex">
                            <div class="me-3">
                                <label for="area" class="form-label">Chọn vị trí</label>
                                <select name="featured" class="form-select form-select-sm" id="area" aria-label="Small select example">
                                    <option selected>Mã vị trí</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                </select>
                            </div>
                            
                        </div> -->
                    </section>
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
                    <!-- <label for="sub_title" class="h5">Mô tả ngắn <span class="text-danger">*</span></label>
                    <textarea name="sub_title" id="sub_title" class="form-control">{{ old('sub_title') }}</textarea> -->
                </section>

                {{-- JS auto slug --}}
                <script>
                    const cateInput = document.getElementById('title');
                    const slugInput = document.getElementById('slug');
                    const autoSlugCheck = document.getElementById('autoSlugCheck');

                    cateInput.addEventListener('input', function() {
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
                <!-- <section class="bg-body rounded p-2 mb-3">
                    <div class="d-flex gap-3 justify-content-between">
                        <label for="number" class="h5">Loại tour</label>
                    </div>   
                </section> -->
                <!-- <section class="bg-body rounded p-2 mb-3">
    <div class="d-flex gap-3 justify-content-between">
        <label for="tourType" class="h5">Loại tour</label>
    </div>
    <div class="d-flex gap-3">
        <div>
            <input type="radio" id="domestic" name="tour_nuoc_ngoai" value="0" {{ old('tour_nuoc_ngoai') == '0' ? 'checked' : '' }}>
            <label for="domestic">Tour trong nước</label>
        </div>
        <div>
            <input type="radio" id="international" name="tour_nuoc_ngoai" value="1" {{ old('tour_nuoc_ngoai') == '1' ? 'checked' : '' }}>
            <label for="international">Tour nước ngoài</label>
        </div>
    </div>
</section> -->



                <!-- <section class="bg-body rounded p-2 mb-3">
                <label for="content" class="h5">Chi Tiết Tin Tức (cụ thể) <span class="text-danger">*</span></label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea> -->
                    <!-- <label for="content" class="h5">Chi Tiết Tin Tức (cụ thể) <span class="text-danger">*</span></label>
                    <textarea name="content" id="content">{{ old('content') }}</textarea> -->
                <!-- </section> -->
                
            </div>


            <!-- NỘI DUNG NAV RIGHT THÊM, Cate, IMG, 2n1d, phương tiện -->
            <div class="col-3">
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
            $http.get('/admin/api/danh-sach-category-new').then(
                function(res) { // success
                    $scope.category_new = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách news:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
