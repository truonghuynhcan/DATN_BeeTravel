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
    <form action="{{ route('admin.newEdit_update',$news->id )}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Để xác định đây là yêu cầu cập nhật -->
        <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top z-1">
            <h2 class="">Sửa tin tức: {{ $news->id }}</h2>
            <div>
                <button type="submit" name="post" id="post-btn" class="btn btn-primary" style="height: fit-content;">Đăng / Cập nhật</button>
                <button type="submit" name="draft" id="draft-btn" class="btn btn-outline-primary" style="height: fit-content;">Lưu nháp / Ẩn</button> <!-- lưu với trạng thái ẩn -->
            </div>
        </header>
        
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
                    <input name="title" value="{{ old('title') ?? $news->title}}" id="title" class="form-control form-control-lg" type="text" placeholder="Tên tin tức tour (không vượt quá 255 ký tự) " aria-label=".form-control-lg example">
                </section>

                {{-- Nổi bật --}}
                @if (Auth::guard('admin')->user()->role == 'admin')
                    <!-- <section class="bg-body rounded p-2 mb-3"> 
                        <h5>Nổi bật</h5>
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
                            
                        </div>
                    </section> -->
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
                    <input type="text" name="slug" value="{{ old('slug') ?? $news->slug}}" id="slug" class="form-control mb-3">
                    <label for="description" class="h5">Mô tả ngắn (tin tức) <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') ?? $news->description }}</textarea>
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
                <textarea name="content" id="content" class="form-control">{{ old('content') ?? $news->content  }}</textarea>
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
                        <option value="{{ $news->admin->id }}" selected>{{ $news->admin->name }}</option>
                            <option ng-repeat="provider in providers" value="@{{ provider.id }}">@{{ provider.name }}</option>
                        </select>
                    @else
                        <input name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" hidden></input>
                    @endif
                    <label for="news_categories" class="form-label">
                        <h5>Chọn danh mục <span class="text-danger">*</span></h5>
                    </label>

                    <select name="category_id" class="form-select form-select-sm" id="news_categories" aria-label="Small select example">
                        <option value="{{ $news->NewsCategory->id }}" selected>{{ $news->NewsCategory->title }}</option>
                        <option ng-repeat="catenew in news_categories" value="@{{ catenew.id }}">@{{ catenew.title }}</option>
                    </select>
                </section>
                <section class="bg-body rounded mb-3 p-2">
                    <p class="mb-2">
                    <h5>Ảnh đại diện <span class="text-danger">*</span></h5>
                    </p>
                    <label for="fileUpload" class="form-label">
                        <img id="mainImage" src="{{ asset('assets/image_new/' . $news->image_url ?? 'img_phaceholder.jpg') }}" alt="ảnh nè" width="100%" class="img-thumbnail object-fit-contain mb-3">
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
