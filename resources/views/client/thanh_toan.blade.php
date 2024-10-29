@extends('client.layout.index')
@section('title')
    Thanh toán
@endsection
@section('main')
<div class="container mt-5">
        <div class="row">
            <div class="text-success">
                <strong><h1>Tour đã đặt sẽ hiện thị ở đây</h1></strong>
            </div>
            <div class="col-md-7">
                <div class="alert alert-info" role="alert">
                    <div class="text-success">
                        <p><strong>KHỞI HÀNH</strong></p>
                        <span>Ngày khởi hành: 23/10/2024</span>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="text-success">
                        <strong>THÔNG TIN HÀNH KHÁCH</strong><hr>
                    </div>
                    <div class="alert alert-info" role="alert">
                        <div class="row mb-3">
                            <div class="col-md-6">
                              <div class="d-flex align-items-center">
                                <label for="adult-count" class="me-2">Người lớn(> 12 tuổi):</label>
                                <div class="btn-group">
                                  <button class="btn btn-outline-secondary" onclick="updateAdultCount(-1)">-</button>
                                  <span class="btn btn-light" id="adult-count">0</span>
                                  <button class="btn btn-outline-secondary" onclick="updateAdultCount(1)">+</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="passenger-forms"></div>
                          <div class="row mb-3">
                            <div class="col-md-6">
                              <div class="d-flex align-items-center">
                                <label for="adult-count1" class="me-2">Trẻ em   (5-12 tuổi):</label>
                                <div class="btn-group">
                                  <button class="btn btn-outline-secondary" onclick="updateAdultCount1(-1)">-</button>
                                  <span class="btn btn-light" id="adult-count1">0</span>
                                  <button class="btn btn-outline-secondary" onclick="updateAdultCount1(1)">+</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- <div class="row mb-3">
                            <div class="col-md-6">
                              <div class="d-flex align-items-center">
                                <label for="adult-count" class="me-2">Người lớn (> 12 tuổi):</label>
                                <div class="btn-group">
                                  <button class="btn btn-outline-secondary" onclick="updateAdultCount2(-1)">-</button>
                                  <span class="btn btn-light" id="adult-count">0</span>
                                  <button class="btn btn-outline-secondary" onclick="updateAdultCount2(1)">+</button>
                                </div>
                              </div>
                            </div>
                          </div> -->
                        <div id="passenger-forms1"></div>
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <div class="d-flex align-items-center">
                              <label for="adult-count2" class="me-2">Trẻ nhỏ (2-5 tuổi):</label>
                              <div class="btn-group ">
                                <button class="btn btn-outline-secondary" onclick="updateAdultCount2(-1)">-</button>
                                <span class="btn btn-light" id="adult-count2">0</span>
                                <button class="btn btn-outline-secondary" onclick="updateAdultCount2(1)">+</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="passenger-forms2"></div>
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <div class="d-flex align-items-center">
                              <label for="adult-count3" class="me-2">Em bé   (< 2 tuổi):</label>
                              <div class="btn-group">
                                <button class="btn btn-outline-secondary" onclick="updateAdultCount3(-1)">-</button>
                                <span class="btn btn-light" id="adult-count3">0</span>
                                <button class="btn btn-outline-secondary" onclick="updateAdultCount3(1)">+</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="passenger-forms3"></div>
                    </div>
                    
                      <script>
                        let adultCount = 0;
                        let adultCount1 = 0;
                        let adultCount2 = 0;
                        let adultCount3 = 0;
                        function updateAdultCount(delta) {
                          adultCount = Math.max(0, adultCount + delta);
                          document.getElementById('adult-count').textContent = adultCount;
                          updatePassengerForms();
                        }
                        function updateAdultCount1(delta) {
                          adultCount1 = Math.max(0, adultCount1 + delta);
                          document.getElementById('adult-count1').textContent = adultCount1;
                          updatePassengerForms1();
                        }
                        function updateAdultCount2(delta) {
                          adultCount2 = Math.max(0, adultCount2 + delta);
                          document.getElementById('adult-count2').textContent = adultCount2;
                          updatePassengerForms2();
                        }
                        function updateAdultCount3(delta) {
                          adultCount3 = Math.max(0, adultCount3 + delta);
                          document.getElementById('adult-count3').textContent = adultCount3;
                          updatePassengerForms3();
                        }
                    
                        function updatePassengerForms() {
                          const passengerForms = document.getElementById('passenger-forms');
                          passengerForms.innerHTML = '';
                    
                          for (let i = 1; i <= adultCount; i++) {
                            const newForm = document.createElement('div');
                            newForm.className = 'row mb-3';
                            newForm.innerHTML = `
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-name-${i}">Họ và tên:</label>
                                  <input type="text" class="form-control" id="passenger-name-${i}">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-dob-${i}">Ngày sinh:</label>
                                  <input type="date" class="form-control" id="passenger-dob-${i}">
                                </div>
                              </div>
                            `;
                            passengerForms.appendChild(newForm);
                          }
                        }
                        function updatePassengerForms1() {
                          const passengerForms1 = document.getElementById('passenger-forms1');
                          passengerForms1.innerHTML = '';
                    
                          for (let i = 1; i <= adultCount1; i++) {
                            const newForm1 = document.createElement('div');
                            newForm1.className = 'row mb-3';
                            newForm1.innerHTML = `
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-name-${i}">Họ và tên:</label>
                                  <input type="text" class="form-control" id="passenger-name-${i}">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-dob-${i}">Ngày sinh:</label>
                                  <input type="date" class="form-control" id="passenger-dob-${i}">
                                </div>
                              </div>
                              
                            `;
                            passengerForms1.appendChild(newForm1);
                          }
                        }
                        function updatePassengerForms2() {
                          const passengerForms2 = document.getElementById('passenger-forms2');
                          passengerForms2.innerHTML = '';
                    
                          for (let i = 1; i <= adultCount2; i++) {
                            const newForm2 = document.createElement('div');
                            newForm2.className = 'row mb-3';
                            newForm2.innerHTML = `
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-name-${i}">Họ và tên:</label>
                                  <input type="text" class="form-control" id="passenger-name-${i}">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-dob-${i}">Ngày sinh:</label>
                                  <input type="date" class="form-control" id="passenger-dob-${i}">
                                </div>
                              </div>
                              
                            `;
                            passengerForms2.appendChild(newForm2);
                          }
                        }
                        function updatePassengerForms3() {
                          const passengerForms3 = document.getElementById('passenger-forms3');
                          passengerForms3.innerHTML = '';
                    
                          for (let i = 1; i <= adultCount3; i++) {
                            const newForm3 = document.createElement('div');
                            newForm3.className = 'row mb-3';
                            newForm3.innerHTML = `
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-name-${i}">Họ và tên:</label>
                                  <input type="text" class="form-control" id="passenger-name-${i}">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="passenger-dob-${i}">Ngày sinh:</label>
                                  <input type="date" class="form-control" id="passenger-dob-${i}">
                                </div>
                              </div>
                              
                            `;
                            passengerForms3.appendChild(newForm3);
                          }
                        }
                    
                        
                        function savePassengerInfo() {
                          // Lưu trữ thông tin hành khách
                          console.log('Thông tin hành khách đã được lưu.');
                        }
                    
                        updatePassengerForms();
                      </script>
                    
                </div>

                <div class="card p-4 mt-3">
                    <div class="text-success">
                        <strong>THÔNG TIN LIÊN HỆ</strong><hr>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="name">Họ và tên *</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại (bắt buộc)</label>
                            <input type="tel" class="form-control" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ (tùy chọn)</label>
                            <input type="text" class="form-control" id="address">
                        </div>
                        
                        <!-- <div class="form-group">
                            <label for="country">Quốc gia cư trú *</label>
                            <select class="form-control" id="country" required>
                                <option>Việt Nam</option>
                                <option>Thái Lan</option>
                                <option>Mỹ</option>
                                <option>Nhật Bản</option>
                            </select>
                        </div> -->
                        <div class="payment-option">
                            <input type="checkbox">
                            <label>Nếu quý khách nhập địa chỉ thư điện tử và không hoàn thành việc đặt phòng thì chúng tôi có thể nhắc nhở để giúp quý khách tiếp tục đặt phòng.</label>
                        </div>
                    </form>
                </div>
                <div class="card p-4">
                    <h5 class="highlight">CÁC HÌNH THỨC THANH TOÁN</h5>
                    <div class="payment-option">
                        <input type="checkbox" id="cash">
                        <label for="cash">Tiền mặt</label>
                    </div>
                    <div class="payment-option">
                        <input type="checkbox" id="transfer">
                        <label for="transfer">Chuyển Khoản</label>
                    </div>
                    <div class="payment-option">
                        <input type="checkbox" id="zalopay">
                        <label for="zalopay">Tiền ZaloPay</label>
                    </div>
                    <div class="payment-option">
                        <input type="checkbox" id="momo">
                        <label for="momo">Tiền Momo</label>
                    </div>
                    
                </div>
                
            </div>

            <div class="col-md-5">
                <div class="hotel-card">
                    <div class="text-success">
                        <strong>CHI TIẾT ĐẶT CHỖ</strong><hr>
                    </div>
                    <!-- <div class="hotel-img" style="width: 100%; height: 150px; background-color: #ccc;"></div>
                    <div class="p-3">
                        <h5 class="hotel-title">Khách sạn & Căn hộ Taian</h5>
                        <p>Toàn bộ căn hộ ⭐⭐⭐⭐⭐</p>
                        <p class="hotel-location">Vị trí: Phước Mỹ, Đà Nẵng, Việt Nam</p>
                    </div> -->
                </div>

                <div class="room-card mt-3">
                    <h5>Hành Trình</h5>
                    <p>Địa điểm đi thay vào tên tour ở đây</p>
                    <h5>Loại Tour</h5>
                    <p>3 ngày 2 đêm</p>
                    <h5>Ngày Khởi Hành</h5>
                    <p>23/10/2024</p>

                    <!-- <div class="review-info">
                        <h2 class="rating">9.3</h2>
                        <p class="review-title">Vô Cùng Sạch Sẽ</p>
                        <p>Từ 134 bài đánh giá</p>
                    </div> -->
                    <hr>
                    <!-- <div class="amenities-container">
                        <ul class="amenities">
                            <li><i class="fas fa-check-circle"></i> Bãi đậu xe</li>
                            <li><i class="fas fa-check-circle"></i> Nước uống chào đón</li>
                            <li><i class="fas fa-check-circle"></i> Nhận phòng nhanh</li>
                            <li><i class="fas fa-check-circle"></i> Wifi cao cấp miễn phí</li>
                            <li><i class="fas fa-check-circle"></i> Wifi miễn phí</li>
                            <li><i class="fas fa-check-circle"></i> Nước uống</li>
                        </ul>
                    </div> -->
                    <!-- <p><strong>Tối đa:</strong> 2 người lớn, 1 Trẻ em (0-5 tuổi)</p>
                    <small class="text-muted">Chính sách hủy</small> -->
                </div>
                <div class="price-card">
                    <div class="text-success">
                        <strong>CHI TIẾT GIÁ TOUR</strong><hr>
                    </div>
                    <br>
                    <div class="form-group d-flex justify-content-between">
                        <label>Người lớn </label>
                        <p>1 x 1.000.000 VND</p>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label>Trẻ em</label>
                        <p>1 x 0</p>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label>Trẻ nhỏ</label>
                        <p>1 x 0 VND</p>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label>Em bé</label>
                        <p>1 x 0 VND</p>
                    </div>
                    <div class="text-success">
                        <strong>Voucher Khách Hàng (nếu có)</strong><hr>
                    </div>
                    <div class="form-group">
                        <label>Giảm giá</label>
                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                    </div>
                    <div class="text-success">
                        <strong>Tổng Tiền </strong><hr>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label class="total-price"><strong>Tổng tiền</strong></label>
                        <p class="total-price text-warning fs-3">0 VND</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-primary">Thanh Toán</a>
                </div>
            </div>
        </div>

        <!-- <div class="row"> -->
            <!-- <div class="col-md-7">
                <div class="card p-4">
                    <h5 class="highlight">CÁC HÌNH THỨC THANH TOÁN</h5>
                    <div class="payment-option">
                        <input type="checkbox" id="cash">
                        <label for="cash">Tiền mặt</label>
                    </div>
                    <div class="payment-option">
                        <input type="checkbox" id="transfer">
                        <label for="transfer">Chuyển Khoản</label>
                    </div>
                    <div class="payment-option">
                        <input type="checkbox" id="zalopay">
                        <label for="zalopay">Tiền ZaloPay</label>
                    </div>
                    <div class="payment-option">
                        <input type="checkbox" id="momo">
                        <label for="momo">Tiền Momo</label>
                    </div>
                    
                </div>
                <div>
                    <div class="alert alert-info" role="alert">
                        Thực hiện bước tiếp theo đồng nghĩa với việc quý khách chấp nhận điều khoản sử dụng và <span class="highlight">chính sách quyền riêng tư</span> của Agoda.
                    </div>
                    <p class="text-danger">Nhanh lên! Phòng cuối cùng của chúng tôi cho mức giá này bạn chọn</p>
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-primary">KẾ TIẾP: BƯỚC CUỐI CÙNG</a>
                        <p class="mt-2" style="color: green;">Có liên xác nhận đặt phòng</p>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-4"> -->
                <!-- <div class="price-card">
                    <div class="discount-banner">Giảm Giá 75% Hôm Nay</div>
                    <br>
                    <div class="form-group d-flex justify-content-between">
                        <label>Giá gốc (1 phòng x 1 đêm)</label>
                        <p>1.000.000 VND</p>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label>Giá phòng (1 phòng x 1 đêm)</label>
                        <p>250.000 VND</p>
                    </div>
                    <div class="form-group">
                        <label>Mã giảm giá</label>
                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label>Số tiền giảm</label>
                        <p>0 VND</p>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label>Phí đặt trước</label>
                        <p>0 VND</p>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <label class="total-price">Tổng tiền</label>
                        <p class="total-price">250.000 VND</p>
                    </div>
                </div> -->
            <!-- </div>
        </div> -->
    </div>
@endsection
