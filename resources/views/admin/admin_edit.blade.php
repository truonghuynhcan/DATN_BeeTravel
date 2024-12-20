@extends('admin.layout.index')
@section('title')
    Thay đổi thông tin admin
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
    <form action="{{ route('admin.adminEdit_update', $adminusers->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top z-1">
            <h2 class="">Thay đổi thông tin admin: {{$adminusers->id}}
            </h2>
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
                    <input name="name" value="{{ old('name') ?? $adminusers->name}}" id="name" class="form-control form-control-lg" type="text" placeholder="Tên admin (không vượt quá 255 ký tự) " aria-label=".form-control-lg example">
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
                        <label for="email" class="h5">Email</label>
                    </div>
                    <input type="email" name="email" value="{{ old('email') ?? $adminusers->email }}" id="email" class="form-control mb-3">
                    <div class="d-flex gap-3 justify-content-between">
                        <label for="password" class="h5">Mật khẩu</label>
                    </div>
                    <input type="password" name="password" value="{{ old('password') ?? $adminusers->password}}" id="password" class="form-control mb-3">
                    <div class="d-flex gap-3 justify-content-between">
                        <label for="phone" class="h5">Số điện thoại</label>
                    </div>
                    <input type="phone" name="phone" value="{{ old('phone') ?? $adminusers->phone}}" id="phone" class="form-control mb-3">
                    <!-- <div class="d-flex gap-3 justify-content-between">
                        <label for="role" class="h5">Quyền hạng người dùng</label>
                    </div>
                    <input type="role" name="role" value="{{ old('role') }}" id="role" class="form-control mb-3"> -->
                    <div class="d-flex gap-3 justify-content-between">
                    <label for="role" class="h5">Phân Quyền</label>
                    </div>

                    <!-- Hiển thị giá trị -->
                    <span class="form-control mb-3" id="role-display">{{ old('role', 'admin') ?? $adminusers->role}}
                    </span>

                    <!-- Lưu giá trị trong trường ẩn -->
                    <input type="hidden" name="role" value="{{ old('role', 'admin') ?? $adminusers->role}}" id="role">
                </section>

                {{-- JS auto slug --}}
                <script>
                    const titleInput = document.getElementById('title');
                    // const slugInput = document.getElementById('slug');
                    // const autoSlugCheck = document.getElementById('autoSlugCheck');

                    titleInput.addEventListener('input', function() {
                        if (autoSlugCheck.checked) { // Chỉ tạo slug nếu checkbox được chọn
                            const title = this.value;
                            // const slug = title
                            //     .toLowerCase()
                            //     .replace(/đ/g, 'd') // Chuyển "đ" thành "d"
                            //     .normalize('NFD') // Chuẩn hóa để tách dấu ra khỏi chữ cái
                            //     .replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu
                            //     .replace(/[^a-z0-9\s-]/g, '') // Xóa ký tự đặc biệt
                            //     .replace(/\s+/g, '-') // Thay khoảng trắng bằng dấu gạch ngang
                            //     .replace(/-+/g, '-'); // Xóa các dấu gạch ngang liên tiếp
                            // slugInput.value = slug;
                        }
                    });

                    // Cho phép người dùng chỉnh sửa slug thủ công nếu checkbox không được chọn
                    // autoSlugCheck.addEventListener('change', function() {
                    //     if (!this.checked) {
                    //         slugInput.removeAttribute('readonly');
                    //     } else {
                    //         slugInput.setAttribute('readonly', true);
                    //     }
                    // });

                    // Đặt slug là readonly khi checkbox được chọn
                    // if (autoSlugCheck.checked) {
                    //     slugInput.setAttribute('readonly', true);
                    // }
                </script>


                <!-- <section class="bg-body rounded p-2 mb-3">
                <label for="content" class="h5">Chi Tiết Tin Tức (cụ thể) <span class="text-danger">*</span></label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea> -->
                    <!-- <label for="content" class="h5">Chi Tiết Tin Tức (cụ thể) <span class="text-danger">*</span></label>
                    <textarea name="content" id="content">{{ old('content') }}</textarea> -->
                <!-- </section> -->
                
            </div>


            <!-- NỘI DUNG NAV RIGHT THÊM, Cate, IMG, 2n1d, phương tiện -->
            <div class="col-3">
                <!-- <section class="bg-body rounded mb-3 p-2">
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
                    <select name="category_id" class="form-select form-select-sm" aria-label="Small select example" ng-model="selectedCategory">
                        <option value="" selected>Chọn danh mục tin tức</option>
                        <optgroup label="Tin tức tổng hợp">
                            <option ng-repeat="catenew in news_categories" value="@{{ catenew.id }}">
                                @{{ catenew.title }}
                            </option>
                        </optgroup>
                    </select>
                </section> -->
                <!-- <section class="bg-body rounded mb-3 p-2">
                    <p class="mb-2">
                    <h5>Ảnh đại diện <span class="text-danger">*</span></h5>
                    </p>
                    <label for="fileUpload" class="form-label">
                        <img id="mainImage" src="{{ asset('') }}assets/image/img_phaceholder.jpg" alt="ảnh nè" width="100%" class="img-thumbnail object-fit-contain mb-3">
                    </label>
                    <input name="image_url" type="file" class="form-control mb-3" accept="image/*" id="fileUpload">
                </section> -->

                <!-- js kiểm tra định dạng file và show ảnh demo khi người dùng upfile -->
                <!-- <script> -->
                    
                <!-- </script> -->
            </div>
        </div>
    </form>
@endsection


@section('viewFunction')
<script>
        viewFunction = function($scope, $http) {
            // Gửi vai trò là 'admin' hoặc 'provider'
        const role = 'admin'; // hoặc 'provider', tùy vào logic của bạn
        $http.get(`/admin/api/danh-sach-adminusers?role=${role}`).then(
                function(res) { // success
                    $scope.adminusers = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi khi lấy danh sách provides:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
