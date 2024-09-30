@extends('client.layout.index')
@section('title')
    Thanh toán
@endsection
@section('main')
    <!-- Title -->
    <h2 class="container fs-3">Hà Nội - Lào Cai - Quảng Ninh - Ninh Bình: Sapa - Bản Cát Cát - Fansipan Hạ Long - Động Thiên Cung - Yên Tử - Kdl Tràng An - Bái Đính</h2>
    <!-- Detail -->
    <div class="container">
        <div class="row">
            <!-- img, detail -->
            <div class="col-8">a
                <!-- images -->
                <div class="row mb-3">
                    <div class="col-3">img phuj</div>
                    <div class="col-9">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{asset('')}}assets/image/tour01.webp" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{asset('')}}assets/image/tour02.webp" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{asset('')}}assets/image/tour03.webp" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Lịch khởi hành -->
                <div class="row mb-3">
                    <h3 class="fs-4 text-center mb-3">Lịch khởi hành</h3>
                    <div class="col-3">
                        <div class="shadow-sm bg-body rounded p-3 d-flex flex-column justify-content-between">
                            <p class="text-center fw-bold">Chọn tháng</p>
                            <a href="#" class="btn btn-primary fw-bold mb-2">8/2024</a>
                            <a href="#" class="btn btn-primary fw-bold mb-2">8/2024</a>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="shadow-sm bg-body rounded p-3 d-flex flex-column justify-content-between">
                            lịch ở đây
                        </div>
                    </div>
                </div>
                <!-- Điểm nhấn của chương trình -->
                <div class="mb-3 bg-primary-subtle p-3 rounded text-primary">
                    <h3>Điểm nhấn của chương trình</h3>
                    <ul>
                        <li>Phá đảo bãi biển Trà Cổ, chiêm ngưỡng vẻ đẹp của vùng đất “Địa Đầu Tổ Quốc” – Mũi Sa Vĩ, nơi có câu thơ nổi tiếng “Từ Trà Cổ rừng dương đến Cà Mau rừng đước” khẳng định chiều dài đất nước của nhà thơ Tố Hữu.</li>
                        <li>Khám phá thành phố Đông Hưng ven biên giới Việt - Trung, cùng ngắm nhìn vẻ đẹp khác lạ của thành phố này, thưởng thức các món ăn đặc sản của người dân nơi đây.</li>
                        <li>Giải nhiệt và tận hưởng mùa hè tại huyện đảo Vân Đồn xinh đẹp với những cảnh đẹp thú vị</li>
                        <li>Cảnh đẹp cổ kính của Chùa Cái Bầu địa điểm tâm linh hàng đầu đáng để trải nghiệm nhất tại vùng đất mỏ Quảng Ninh</li>
                        <li>Cao nguyên Bình Liêu có khí hậu quanh năm ôn hòa, cấu trúc địa hình đa dạng cùng cảnh sắc thiên nhiên tươi đẹp, chinh phục những nấc thang "sống lưng khủng long", phóng tầm mắt ngắm nhìn cảnh sắc thiên nhiên tuyệt diệu và cảm nhận mình thật nhỏ bé giữa đất trời bao la</li>
                        <li>Chiêm ngưỡng vẻ đẹp huyền bí của hệ thống 5 hang động tại khu du lịch Vũng Đục, các hang động được phân bổ từ thấp lên cao, có hang ta phải leo đến hàng trăm bậc đá mới đến cửa hang. Quý khách có thể hành hương chiêm bái tại các ngôi đền tự lưng bên núi nhìn ra vịnh Bái Tử
                            Long xinh đẹp</li>
                        <li>Wyndham Garden Sonasea Vân Đồn là khu nghỉ dưỡng cao cấp chuẩn 5 sao quốc tế. Đây là một trong những dự án có quy mô “khủng” nhất tại huyện đảo Vân Đồn, trải dài trên 2.2km đường bờ biển Bãi Dài, ngay bên cạnh Vịnh Bái Tử Long với diện tích lên tới 358.3ha</li>
                    </ul>
                </div>
                <!-- Thông tin thêm về chuyến đi -->
                <div class="row mb-3">
                    <h3 class="fs-4 text-center mb-3">Thông tin thêm về chuyến đi</h3>
                    <div class="col-4 d-flex flex-column mb-3">
                        <i style="text-shadow: 0px 0px 3px #000;;" class="fa-regular fa-map text-light"></i>
                        <strong>Điểm tham quan</strong>
                        <span>Hà Nội, Trà Cổ, Mũi Sa Vĩ, Đông Hưng, Bình Liêu, Vân Đồn, Chùa Cái Bầu</span>
                    </div>
                    <div class="col-4 d-flex flex-column mb-3">
                        <i style="text-shadow: 0px 0px 3px #000;;" class="fa-solid fa-champagne-glasses text-light"></i>
                        <strong>Ẩm thực</strong>
                        <span>Buffet sáng, Bữa sáng theo thực đơn, Theo thực đơn, Đặc sản địa phương</span>
                    </div>
                    <div class="col-4 d-flex flex-column mb-3">
                        <i style="text-shadow: 0px 0px 3px #000;;" class="fa-solid fa-user-check text-light"></i>
                        <strong>Đối tượng thích hợp</strong>
                        <span>Người lớn tuổi, Cặp đôi, Gia đình nhiều thế hệ, Thanh niên, Trẻ em</span>
                    </div>
                    <div class="col-4 d-flex flex-column mb-3">
                        <i style="text-shadow: 0px 0px 3px #000;;" class="fa-solid fa-stopwatch text-light"></i>
                        <strong>Thời gian lý tưởng</strong>
                        <span>--</span>
                    </div>
                    <div class="col-4 d-flex flex-column mb-3">
                        <i style="text-shadow: 0px 0px 3px #000;;" class="fa-solid fa-car text-light"></i>
                        <strong>Phương tiện</strong>
                        <span>Máy bay, Xe du lịch</span>
                    </div>
                    <div class="col-4 d-flex flex-column mb-3">
                        <i style="text-shadow: 0px 0px 3px #000;;" class="fa-solid fa-gifts text-light"></i>
                        <strong>Ưu đãi</strong>
                        <span>--</span>
                    </div>
                </div>
                <!-- Lịch trình -->
                <div class="row mb-3">
                    <h3 class="fs-4 text-center mb-3">Lịch trình</h3>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space
                                    to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Những thông tin cần lưu ý -->
                <div class="row mb-3">
                    <h3 class="fs-4 text-center mb-3">Những thông tin cần lưu ý</h3>
                    <div class="col-6">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Accordion Item #1
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Accordion Item #2
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the
                                        space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Accordion Item #1
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Accordion Item #2
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the
                                        space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bảng giá -->
            <div class="col-4">
                <div class="bg-body shadow-sm border rounded p-3">
                    <div class="h6">Giá từ:</div>
                    <div><span class="text-primary fs-5 fw-bolder">12.790.000 VNĐ</span>/khách</div>
                    <table>
                        <tr>
                            <td scope="col"><i class="fa-solid fa-qrcode"></i></td>
                            <td scope="col">Mã tour:</td>
                            <td scope="col" class="text-info fw-bold">PS36499</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-map-location-dot"></i></td>
                            <td>Khởi hành: </td>
                            <td class="text-info fw-bold">TP. HCM</td>
                        </tr>
                        <tr>
                            <td><i class="fa-regular fa-calendar-days"></i></td>
                            <td>Ngày đi: </td>
                            <td class="text-info fw-bold">01-08-2004</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-hourglass-half"></i></td>
                            <td>Thời gian:</td>
                            <td class="text-info fw-bold">6 ngày 5 đêm</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-check-to-slot"></i></td>
                            <td> Số chỗ còn: </td>
                            <td class="text-info fw-bold">4 chỗ</td>
                        </tr>
                    </table>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">Ngày khác</button>
                        <button class="btn btn-primary">Đặt tour</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Các tour khác -->
    <div class="container">
        <div class="row">
            <div class="col-4">1</div>
            <div class="col-4">2</div>
            <div class="col-4">3</div>
        </div>
    </div>
@endsection
