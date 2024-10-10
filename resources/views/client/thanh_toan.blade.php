@extends('client.layout.index')
@section('title')
    Thanh toán
@endsection
@section('main')
    <div class="container mt-5">
        <div class="row">
        
            <div class="col-md-7">
                <div class="alert alert-info" role="alert">
                    <div class="text-success">
                        <strong>Không yêu cầu thẻ tín dụng</strong>
                    </div>
                    Tin vui! Bạn có thể đặt phòng ngay mà không cần cung cấp chi tiết thanh toán.
                </div>

                <div class="card p-4 mt-3">
                    <h5>Vui lòng điền thông tin của bạn</h5>
                    <form>
                        <div class="form-group">
                            <label for="name">Họ và tên như trong hộ chiếu *</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="email-confirm">Nhập lại email *</label>
                            <input type="email" class="form-control" id="email-confirm" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ (tùy chọn)</label>
                            <input type="text" class="form-control" id="address">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại (bắt buộc)</label>
                            <input type="tel" class="form-control" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Quốc gia cư trú *</label>
                            <select class="form-control" id="country" required>
                                <option>Việt Nam</option>
                                <option>Thái Lan</option>
                                <option>Mỹ</option>
                                <option>Nhật Bản</option>
                            </select>
                        </div>
                        <div class="payment-option">
                            <input type="checkbox">
                            <label>Nếu quý khách nhập địa chỉ thư điện tử và không hoàn thành việc đặt phòng thì chúng tôi có thể nhắc nhở để giúp quý khách tiếp tục đặt phòng.</label>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="hotel-card">
                    <div class="discount-badge">75% Giảm giá</div>
                    <div class="wifi-badge">Wi-Fi miễn phí</div>
                    <div class="hotel-img" style="width: 100%; height: 150px; background-color: #ccc;"></div>
                    <div class="p-3">
                        <h5 class="hotel-title">Khách sạn & Căn hộ Taian</h5>
                        <p>Toàn bộ căn hộ ⭐⭐⭐⭐⭐</p>
                        <p class="hotel-location">Vị trí: Phước Mỹ, Đà Nẵng, Việt Nam</p>
                    </div>
                </div>

                <div class="room-card mt-3">
                    <h5 class="highlight">Phòng Rẻ Nhất</h5>
                    <p>1 tháng 8 2024 - 2 tháng 8 2024 | 1 đêm | 1 x Căn hộ hướng biển (Sea View Apartment)</p>
                    <div class="review-info">
                        <h2 class="rating">9.3</h2>
                        <p class="review-title">Vô Cùng Sạch Sẽ</p>
                        <p>Từ 134 bài đánh giá</p>
                    </div>
                    <hr>
                    <div class="amenities-container">
                        <ul class="amenities">
                            <li><i class="fas fa-check-circle"></i> Bãi đậu xe</li>
                            <li><i class="fas fa-check-circle"></i> Nước uống chào đón</li>
                            <li><i class="fas fa-check-circle"></i> Nhận phòng nhanh</li>
                            <li><i class="fas fa-check-circle"></i> Wifi cao cấp miễn phí</li>
                            <li><i class="fas fa-check-circle"></i> Wifi miễn phí</li>
                            <li><i class="fas fa-check-circle"></i> Nước uống</li>
                        </ul>
                    </div>
                    <p><strong>Tối đa:</strong> 2 người lớn, 1 Trẻ em (0-5 tuổi)</p>
                    <small class="text-muted">Chính sách hủy</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
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
                    <p class="instructions">Thực hiện bước tiếp theo đồng nghĩa với việc quý khách chấp nhận điều khoản sử dụng và chính sách quyền riêng tư của Agoda.</p>
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
            </div>

            <div class="col-md-4">
                <div class="price-card">
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
                </div>
            </div>
        </div>
    </div>
@endsection
