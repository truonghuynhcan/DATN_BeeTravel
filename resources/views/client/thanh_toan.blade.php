@extends('client.layout.index')
@section('title')
    Thanh toán
@endsection
@section('main')
    <div class="container">
        <div class="alert alert-danger">
            <h1>Task</h1>
            <ol>
                <li><strong>thanh toán xong thì hiện bill</strong></li>
                <li>Xử lý lại thêm người đi 2 mà bị mất text đã nhập của người đi 1</li>
                <li>Xử lý tự động điền lại dữ liệu cũ sau khi bắt lỗi</li>
                <li>Thống nhất thêm với thầy là giá của cá nhân sẽ để đâu?</li>
                <li>dùng js tính tổng >0 mới cho click thanh toán</li>
                <li> thêm trường auto điền giá trị cũ vào các form đã nhập</li>
                <li>Xử lý lấy ngày đi tương lai gần nhất</li>
            </ol>
            
        </div>
        <div class="alert alert-success">
            <h1>Done</h1>
            <ol>
                <li>chèn zô được db customer</li>
                <li>chèn zô được db order</li>
                <li>bắt lỗi sau khi post</li>
                <li>post form</li>
                <li>kiểm tra input[name] - đã xong</li>
                <li>sửa thực thể id user có thể bỏ trống(xem như nhập đủ các trường)</li>
                <li>đổ dữ liệu</li>
                <li>dùng api lấy giá tiền theo ngày - đã hỏi gpt, lên đọc lại</li>
                <li>dùng js tính tổng tiền -> truyền vào input hidden</li>
                <li>js hiện form khi thêm người đi</li>
                <li>dùng js lấy số lượng người dùng</li>
                <li>Dựng layout</li>
            </ol>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Vui lòng sửa các lỗi sau:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('thanhtoan_', $tour->id) }}" method="post" class="row">
            @csrf
            <!-- cột trái -->
            <div class="col-md-8">

                <!-- Thông tin khởi hành -->
                <section class="bg-body py-2 mb-3">
                    <div class="p-2 border-bottom border-light-subtle">
                        <strong class="text-primary">KHỞI HÀNH</strong>
                    </div>
                    <div class="px-2 pt-2">
                        <table class="table table-borderless mb-1" style="width: fit-content;">
                            <tr>
                                <td>Ngày khởi hành</td>
                                <td class="d-flex gap-2">
                                    <select class="form-select form-select-sm form-select-date" name="ngaykhoihanh" style="width: fit-content;" onchange="fetchPrice()">
                                        @if (old('ngaykhoihanh'))
                                            <option value="{{ old('ngaykhoihanh') }}" selected>làm js tìm</option>
                                        @endif
                                        @foreach ($tour->ngaydi as $item)
                                            <option value="{{ $item->id }}">{{ $item->start_date }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Thời gian</td>
                                <th class="text-uppercase">{{ $tour->duration }}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="px-2 pt-2 text-body-secondary d-flex justify-content-around border-light-subtle" style="border-top-style: dashed;">
                        <small>Tiết kiệm chi phí</small>
                        <small>Không phí đặt chỗ</small>
                        <small>Không phí thanh toán</small>
                    </div>
                    <div class="">
                        <div class="text-success">
                        </div>
                    </div>
                </section>

                <!-- Thông tin hành khách -->
                <section class="bg-body py-2 mb-3">
                    <div class="p-2 border-bottom border-light-subtle d-flex justify-content-between">
                        <strong class="text-primary">THÔNG TIN HÀNH KHÁCH</strong>
                        <small class="text-body opacity-50">(Chưa bao gồm khách đăng ký)</small>
                    </div>
                    <div class="px-2 pt-2 d-flex flex-column gap-2">
                        <div class="d-flex align-items-center">
                            <label for="adult-count" class="me-2 fw-bold">Người lớn (> 12 tuổi):</label>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('adult', -1)">-</button>
                                <span class="btn btn-outline-secondary" id="adult-count">0</span>
                                <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('adult', 1)">+</button>
                            </div>
                        </div>
                        <div id="passenger-forms"></div>

                        <div class="d-flex align-items-center">
                            <label for="child-count" class="me-2 fw-bold">Trẻ em (5-12 tuổi):</label>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('child', -1)">-</button>
                                <span class="btn btn-outline-secondary" id="child-count">0</span>
                                <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('child', 1)">+</button>
                            </div>
                        </div>
                        <div id="passenger-forms1"></div>

                        <div class="d-flex align-items-center">
                            <label for="toddler-count" class="me-2 fw-bold">Trẻ nhỏ (2-5 tuổi):</label>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('toddler', -1)">-</button>
                                <span class="btn btn-outline-secondary" id="toddler-count">0</span>
                                <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('toddler', 1)">+</button>
                            </div>
                        </div>
                        <div id="passenger-forms2"></div>

                        <div class="d-flex align-items-center">
                            <label for="infant-count" class="me-2 fw-bold">Em bé (< 2 tuổi):</label>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('infant', -1)">-</button>
                                        <span class="btn btn-outline-secondary" id="infant-count">0</span>
                                        <button type="button" class="btn btn-outline-secondary" onclick="updatePassengerCount('infant', 1)">+</button>
                                    </div>
                        </div>
                        <div id="passenger-forms3"></div>


                        <!-- js xử lý thêm khách hàng -->
                        <script>
                            // Object to store age-based date restrictions
                            const ageLimits = {
                                adult: {
                                    min: 12,
                                    max: 200
                                }, // >12 years old (min 12, max unrestricted)
                                child: {
                                    min: 5,
                                    max: 12
                                }, // 5-12 years
                                toddler: {
                                    min: 2,
                                    max: 5
                                }, // 2-5 years
                                infant: {
                                    min: 0,
                                    max: 2
                                } // <2 years
                            };

                            // Function to calculate max date based on minimum age requirement
                            // Calculate max date based on the minimum age requirement
                            function calculateMaxDate(minAge) {
                                const date = new Date();
                                date.setFullYear(date.getFullYear() - minAge);
                                return date.toISOString().split('T')[0];
                            }

                            // Calculate min date based on the maximum age requirement
                            function calculateMinDate(maxAge) {
                                const date = new Date();
                                date.setFullYear(date.getFullYear() - maxAge);
                                return date.toISOString().split('T')[0];
                            }

                            // Set min and max dates for each passenger type based on age range
                            function setDateRangeForPassengers(type) {
                                const maxDate = calculateMaxDate(ageLimits[type].min);
                                const minDate = calculateMinDate(ageLimits[type].max);
                                const count = passengerTypes[type].count;

                                for (let i = 1; i <= count; i++) {
                                    const dobInput = document.getElementById(`${type}-dob-${i}`);
                                    dobInput.setAttribute("max", maxDate);
                                    dobInput.setAttribute("min", minDate);
                                }
                            }

                            // Đối tượng lưu số lượng mỗi loại hành khách và ID tương ứng
                            const passengerTypes = {
                                adult: {
                                    count: 0,
                                    label: "Người lớn (>12 tuổi)",
                                    formId: "passenger-forms"
                                },
                                child: {
                                    count: 0,
                                    label: "Trẻ em (5-12 tuổi)",
                                    formId: "passenger-forms1"
                                },
                                toddler: {
                                    count: 0,
                                    label: "Trẻ nhỏ (2-5 tuổi)",
                                    formId: "passenger-forms2"
                                },
                                infant: {
                                    count: 0,
                                    label: "Em bé (<2 tuổi)",
                                    formId: "passenger-forms3"
                                }
                            };

                            // Hàm cập nhật số lượng hành khách cho từng loại
                            function updatePassengerCount(type, delta) {
                                passengerTypes[type].count = Math.max(0, passengerTypes[type].count + delta);
                                document.getElementById(`${type}-count`).textContent = passengerTypes[type].count;
                                updatePassengerForms(type);
                            }

                            // Hàm cập nhật form hành khách theo loại
                            function updatePassengerForms(type) {
                                const container = document.getElementById(passengerTypes[type].formId);
                                container.innerHTML = '';

                                for (let i = 1; i <= passengerTypes[type].count; i++) {
                                    const newForm = document.createElement('div');
                                    newForm.className = 'row mb-3';
                                    newForm.innerHTML = `
                                        <div class="col-md-4">
                                          <select name="${type}-quydanh[]" class="form-select" id="${type}-quydanh-${i}" aria-label="Floating label select example">
                                            <option value="" selected>Quý danh</option>
                                            <option value="mr">Quý Ông</option>
                                            <option value="mrs">Quý Bà</option>
                                          </select>
                                        </div>
                                        <div class="col-md-4">
                                          <input type="text" name="${type}-name[]" placeholder="Họ và tên (${passengerTypes[type].label} ${i}):" class="form-control" id="${type}-name-${i}">
                                        </div>
                                        <div class="col-md-4">
                                          <input type="date" name="${type}-birthday[]" class="form-control" id="${type}-dob-${i}">
                                        </div>
                                    `;
                                    container.appendChild(newForm);
                                }
                                setDateRangeForPassengers(type);
                                updateTourCost();
                                totalCost()
                            }

                            // Khởi tạo các form mặc định cho mỗi loại hành khách
                            Object.keys(passengerTypes).forEach(type => updatePassengerForms(type));
                        </script>
                    </div>
                </section>

                <!-- Thông tin liên hệ -->
                <section class="bg-body py-2 mb-3">
                    <div class="p-2 border-bottom border-light-subtle">
                        <strong class="text-primary">THÔNG TIN LIÊN HỆ</strong>
                    </div>
                    <div class="px-2 pt-2">
                        <div class="form-group mb-2">
                            <label for="name">Họ và tên <span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <select name="user-quydanh" class="form-select w-auto fw-bold" id="user-quydanh">
                                    <option value="" selected >Chọn quý danh</option>
                                    <option value="mr">Quý Ông</option>
                                    <option value="mrs">Quý Bà</option>
                                </select>
                                <input name="user-fullname" type="text" class="form-control" value="{{ old('user-fullname')??( auth()->check() ? auth()->user()->name : '') }}" placeholder="Họ và tên: " id="name">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input name="user-email" type="email" value="{{ old('user-email')??( auth()->check() ? auth()->user()->email : '' )}}" class="form-control" id="email">
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input name="user-phone" type="tel" value="{{ old('user-phone')??( auth()->check() ? auth()->user()->phone : '' )}}" class="form-control" id="phone">
                        </div>
                        <div class="form-group mb-2">
                            <label for="address">Địa chỉ <span class="text-danger">*</span></label>
                            <input name="user-address" type="text" value="{{ old('user-address')??( auth()->check() ? auth()->user()->address : '') }}" class="form-control" id="address">
                        </div>
                    </div>
                </section>


                <!-- Voucher giảm giá -->
                <section class="bg-body py-2 mb-3">
                    <div class="p-2 border-bottom border-light-subtle">
                        <strong class="text-primary">VOUCHER</strong>
                    </div>
                    <div class="px-2 pt-2">
                        <p class="mb-2">Nhập mã voucher để được hưởng thêm ưu đãi</p>
                        <p class="mb-2">Lưu ý: Khách hàng vui lòng nhập đúng Mã Voucher hoặc để trốn</p>
                        <div class="d-flex gap-2">
                            <img src="{{ asset('') }}assets/image/thanh-toan-ic-gift-card.png" alt="" height="30px">
                            <input name="voucher_code" type="text" class="form-control form-control-sm w-auto" id="voucher">
                            <button type="button" class="btn btn-primary">Áp dụng</button>
                        </div>
                    </div>
                </section>


                <!-- Chọn hình thức thanh toán -->
                <div class="card p-4">
                    <h5 class="highlight">CÁC HÌNH THỨC THANH TOÁN</h5>
                    <div class="payment-option">
                        {{-- Trạng thái chưa thanh toán --}}
                        <input type="radio" name="user-payment" value="0" id="cash" checked>
                        <label for="cash">Thanh toán khi tham gia</label>
                    </div>
                    {{-- <div class="payment-option">
                        <input type="radio" name="payment" id="transfer">
                        <label for="transfer">Ngân hàng</label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="zalopay">
                        <label for="zalopay">ZaloPay</label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="momo">
                        <label for="momo">Momo</label>
                    </div> --}}
                </div>

            </div>

            <!-- Xem đơn / cột phải -->
            <div class="col-md-4">
                <section class="bg-body py-2 mb-3">
                    <div class="p-2 border-bottom border-light-subtle">
                        <strong class="text-primary">CHI TIẾT ĐẶT CHỖ</strong>
                    </div>
                    <div class="p-2">
                        <h6 class="text-body-secondary">Hành trình</h6>
                        <p>{{ $tour->title }}</p>
                        <h6 class="text-body-secondary">Code đoàn</h6>
                        <p class="mb-0">{{ $tour->id }}</p>
                    </div>
                    <hr>
                    <div class="p-2">
                        <strong class="text-primary">CHI TIẾT GIÁ TOUR</strong>
                        <br>
                        <strong class="text-body-secondary">Giá cơ bản</strong>

                        <div class="d-flex justify-content-between">
                            <div>Người lớn</div>
                            <div><span id="adult-total">0</span> x <span id="adult-cost">0</span> VND</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>Trẻ em</div>
                            <div><span id="child-total">0</span> x <span id="child-cost">0</span> VND</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>Trẻ nhỏ</div>
                            <div><span id="toddler-total">0</span> x <span id="toddler-cost">0</span> VND</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>Em bé</div>
                            <div><span id="infant-total">0</span> x <span id="infant-cost">0</span> VND</div>
                        </div>
                        <!-- js xử lý cập nhật ngày khởi hành và giá tiền -->
                        <script>
                            // hàm cập nhật giá tiền theo ngày đi
                            function fetchPrice() {
                                const ngaykhoihanh_id = document.querySelector('.form-select-date').value;
                                const tour_id = {{ $tour->id }} // lẩy id của tour

                                fetch(`/api/get-price/${ngaykhoihanh_id}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Cập nhật giá dựa trên dữ liệu trả về
                                        document.getElementById('adult-cost').textContent = formatCurrency(data.adultCost);
                                        document.getElementById('child-cost').textContent = formatCurrency(data.childCost);
                                        document.getElementById('toddler-cost').textContent = formatCurrency(data.toddlerCost);
                                        document.getElementById('infant-cost').textContent = formatCurrency(data.infantCost);

                                        // Cập nhật tổng nếu cần
                                        totalCost();
                                    })
                                    .catch(error => {
                                        console.error('Error fetching price:', error);
                                    });
                            }

                            // Gọi hàm khi trang load lần đầu
                            document.addEventListener('DOMContentLoaded', fetchPrice);
                        </script>
                    </div>

                    <div class="p-2 border-light-subtle d-flex justify-content-between" style="border-top-style: dashed;">
                        <h5>Tổng tiền</h5>
                        <div>
                            <span class="text-end" id="total-cost">0</span> VND
                        </div>
                        <input type="number" name="tongtien" value="0" hidden>
                    </div>
                    <!-- js truyền số lượng khách vào bảng hiển thị -->
                    <script>
                        // hàm định dạng cho số dạng 1.123 vnd
                        function formatCurrency(number) {
                            const parts = number.toString().split("."); // Tách phần nguyên và phần thập phân (nếu có)
                            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Thêm dấu chấm vào phần nguyên
                            return parts.join(","); // Ghép lại với dấu phẩy cho phần thập phân
                        }
                        // Xóa dấu chấm và chuyển đổi thành số
                        function parseFormattedNumber(formattedNumber) {
                            return parseInt(formattedNumber.replace(/\./g, ''), 10) || 0;
                        }


                        // Hàm tính tổng chi phí cho từng loại hành khách
                        function updateTourCost() {
                            // Lấy số lượng từng loại hành khách từ các ID
                            const adultCount = parseInt(document.getElementById('adult-count').textContent) || 0;
                            const childCount = parseInt(document.getElementById('child-count').textContent) || 0;
                            const toddlerCount = parseInt(document.getElementById('toddler-count').textContent) || 0;
                            const infantCount = parseInt(document.getElementById('infant-count').textContent) || 0;


                            // hiển thị số lượng
                            document.getElementById('adult-total').textContent = formatCurrency(adultCount);
                            document.getElementById('child-total').textContent = formatCurrency(childCount);
                            document.getElementById('toddler-total').textContent = formatCurrency(toddlerCount);
                            document.getElementById('infant-total').textContent = formatCurrency(infantCount);


                        }

                        function totalCost() {
                            // Lấy số lượng từ HTML và chuyển đổi về định dạng số nguyên
                            const adultCount = parseFormattedNumber(document.getElementById('adult-count').textContent);
                            const childCount = parseFormattedNumber(document.getElementById('child-count').textContent);
                            const toddlerCount = parseFormattedNumber(document.getElementById('toddler-count').textContent);
                            const infantCount = parseFormattedNumber(document.getElementById('infant-count').textContent);

                            // Lấy chi phí từng loại từ HTML và chuyển đổi về định dạng số nguyên
                            const adultCost = parseFormattedNumber(document.getElementById('adult-cost').textContent);
                            const childCost = parseFormattedNumber(document.getElementById('child-cost').textContent);
                            const toddlerCost = parseFormattedNumber(document.getElementById('toddler-cost').textContent);
                            const infantCost = parseFormattedNumber(document.getElementById('infant-cost').textContent);


                            const total_adultCost = adultCount * adultCost;
                            const total_childCost = childCount * childCost;
                            const total_toddlerCost = toddlerCount * toddlerCost;
                            const total_infantCost = infantCount * infantCost;

                            // Tính tổng tiền và cập nhật hiển thị
                            const totalCost = total_adultCost + total_childCost + total_toddlerCost + total_infantCost;
                            document.getElementById('total-cost').textContent = formatCurrency(totalCost);
                            document.querySelector('input[name="tongtien"]').value = totalCost;
                        }

                        // Gọi hàm này mỗi khi số lượng thay đổi để cập nhật chi phí
                        updateTourCost();
                        totalCost()
                    </script>
                </section>
                <div class="text-center mt-4">
                    <button type="submit" class="container-fluid btn btn-primary">Thanh Toán</button>
                </div>
            </div>
    </div>
@endsection
