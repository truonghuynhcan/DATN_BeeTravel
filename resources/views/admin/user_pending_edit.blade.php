@extends('admin.layout.index')
@section('title')
    Xác nhận tài khoản
@endsection
@section('main')
    <form action="{{ route('admin.getAdminEdit_update',$getAdmin->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <header class="bg-body p-2 d-flex justify-content-between mb-2 sticky-top z-1">
            <h2 class="">Xác nhận tài khoản: {{$getAdmin->id}}</h2>
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
                    <input name="name" value="{{ old('name') ?? $getAdmin->name}}" id="name" class="form-control form-control-lg" type="text" placeholder="Tên đối tác (không vượt quá 255 ký tự) " aria-label=".form-control-lg example" readonly>
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
                    <input type="email" name="email" value="{{ old('email') ?? $getAdmin->email}}" id="email" class="form-control mb-3" readonly>
                    <!-- <div class="d-flex gap-3 justify-content-between">
                        <label for="password" class="h5">Mật khẩu</label>
                    </div>
                    <input type="password" name="password" value="{{ old('password') ?? $getAdmin->password}}" id="password" class="form-control mb-3"> -->
                    <div class="d-flex gap-3 justify-content-between">
                        <label for="phone" class="h5">Số điện thoại</label>
                    </div>
                    <input type="phone" name="phone" value="{{ old('phone') ?? $getAdmin->phone}}" id="phone" class="form-control mb-3" readonly>
                    <!-- <div class="d-flex gap-3 justify-content-between">
                        <label for="role" class="h5">Quyền hạng người dùng</label>
                    </div>
                    <input type="role" name="role" value="{{ old('role') }}" id="role" class="form-control mb-3"> -->
                    <!-- <div class="d-flex gap-3 justify-content-between">
                    <label for="role" class="h5">Phân Quyền</label>
                    </div>

                    
                    <span class="form-control mb-3" id="role-display">{{ old('role', 'provider') }}
                    </span> -->

                    
                    <div class="d-flex gap-3 justify-content-between">
                    <label for="role" class="h5">Phân Quyền</label>
                    </div>
    <div>
        <input type="radio" id="pending" name="role" value="pending" {{ old('role', $getAdmin->role) == 'pending' ? 'checked' : '' }} readonly>
        <label for="pending">Pending</label>
    </div>
    <div>
        <input type="radio" id="provider" name="role" value="provider" {{ old('role', $getAdmin->role) == 'provider' ? 'checked' : '' }} readonly>
        <label for="provider">Provider</label>
    </div>
                    <!-- Hiển thị giá trị
                    <span class="form-control mb-3" id="role-display">{{ old('role', 'pending') ?? $getAdmin->role}}
                    </span> -->

                    <!-- Lưu giá trị trong trường ẩn -->
                    <!-- <input type="text" name="role" value="{{ old('role', 'pending') ?? $getAdmin->role}}" id="role" class="form-control mb-3"> -->
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
        const role = 'pending'; // hoặc 'provider', tùy vào logic của bạn
        $http.get(`/admin/api/danh-sach-user-provide?role=${role}`).then(
                function(res) { // success
                    $scope.getAdmin = res.data.data;
                },
                function(res) { // error
                    console.error('Lỗi xác nhận danh sách pending:', res); // Ghi lỗi
                }
            )
        };
    </script>
@endsection
