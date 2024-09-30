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
            <div class="col-8">
                <!-- images -->
                <div class="row mb-4">
                    <div class="col-2 d-flex flex-column">
                        @foreach ($images as $key => $image)
                            <img id="img{{ $key }}" src="{{ asset($image) }}" alt="" class="mb-2" style="cursor: pointer;">
                        @endforeach
                    </div>
                    <div class="col-10">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                                @foreach ($images as $key => $image)
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($images as $key => $image)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image) }}" class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
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
                    <script>
                        document.querySelectorAll('img[id^="img"]').forEach(function(image, index) {
                            image.addEventListener('click', function() {
                                var carousel = new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'));
                                carousel.to(index); // chuyển đến slide tương ứng với index
                            });
                        });
                    </script>
                </div>


                <!-- Lịch khởi hành -->
                <div class="row mb-4">
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
                <div class="mb-4 bg-primary-subtle p-3 rounded text-body">
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


                <!-- THÔNG TIN CHI TIẾT TOUR -->
                <div class="mb-3 bg-body p-3 rounded text-body">
                    <h3>Thông tin chi tiết về tour</h3>

                    <div id="the-timeline">

                        <!-- STORY ROW-1-->
                        <div class="row story-row">

                            <div class="story-image col-sm-12 col-md-5 text-center">
                                <!--PHOTO-ITEM-->
                                <div class="photo-item animation delay1 fadeInLeft detail-tour-image-2" id="detail-tour-image-2-137">
                                    <!--PHOTO-->
                                    <img src="https://www.startravel.vn/upload/images/phuquoc3.jpg" alt="Ngày 01: TP.HCM – PHÚ QUỐC (ăn chiều)" class="hover-animation image-zoom-in">
                                    <!--PHOTO OVERLAY-->
                                </div>
                                <!--END of PHOTO-ITEM-->
                            </div>

                            <!-- Date -->
                            <div class="col-sm-12 col-md-2 text-center story-date-wrapper animation fadeIn">
                                <div class="arrow-left"></div>
                                <div class="story-date">
                                    <div class="month-year">Ngày</div>
                                    <div class="date-only">1</div>

                                </div>
                                <div class="arrow-right"></div>
                                <div class="clearboth"></div>
                            </div>

                            <!-- Text -->
                            <div class="story-desc col-sm-12 col-md-5 animation delay1 fadeInRight description-tour-new">
                                <h5><span class="theme-color">Thứ hai, 30/09/2024</span><br>
                                    Ngày 01: TP.HCM – PHÚ QUỐC (ăn chiều)</h5>
                                <div class="content-chi-tiet-tour detail-tour-description-2" id="detail-tour-description-2-137">





                                    <div style="text-align: justify;"><strong>Sáng:</strong>&nbsp;Quý khách có mặt tại ga quốc nội, sân bay Tân Sơn Nhất trước giờ bay ít nhất 02&nbsp;tiếng.<strong>&nbsp;</strong>Đại diện&nbsp;<strong>công ty</strong>&nbsp;đón và hỗ trợ Quý khách làm thủ tục đón chuyến
                                        bay đi<strong>&nbsp;Phú Quốc.</strong></div>
                                    <p style="text-align: justify;">Đến&nbsp;<strong>sân bay Phú Quốc</strong>, hướng dẫn viên đón Quý khách, đưa đoàn:</p>
                                    <ul style="text-align: justify;">
                                        <li>Tham quan <strong>Chùa Sư Muôn (Hùng Long Tự)</strong> - để cầu nguyện sự an lành và hạnh phúc đến với gia đình.</li>
                                        <li>Đoàn tiếp tục tham quan <strong>Làng Chài Hàm Ninh, Cơ Sở Nuôi Cấy Ngọc Trai, Vườn Tiêu, Nhà Thùng</strong> làm nước mắm, Dinh Cậu: biểu tượng văn hoá và tín ngưỡng của đảo Phú Quốc, là nơi cầu may mắn, cầu an lành và là nơi ngư dân địa phương gởi gắm niềm tin
                                            cho một chuyến ra khơi đánh bắt đầy ắp cá khi trở về.</li>
                                        <li>Sau đó, đoàn viếng <strong>Dinh Bà Thủy Long Thánh Mẫu</strong> là nơi thờ Thần Nữ Kim Giao, người phụ nữ được người dân Phú Quốc rất mực tôn kính vì có công khai phá huyện đảo này.</li>
                                    </ul>
                                    <p><em>(Trong trường hợp bay trước 11h, Star Travel sẽ hỗ trợ bữa ăn trưa)</em></p>
                                    <p style="text-align: justify;"><strong>Tối:&nbsp;</strong>Dùng cơm tối, quý khách tự do khám phá Phú Quốc về đêm.</p>
                                    <p style="text-align: justify;"><strong>Nghỉ đêm tại Phú Quốc.</strong></p>


                                </div>
                            </div>

                            <div class="vertical-line"></div>

                        </div>
                        <!-- END of STORY ROW-1 -->


                        <!-- STORY ROW-2-->
                        <div class="row story-row">

                            <div class="story-image col-sm-12 col-md-5 col-md-push-7 text-center">
                                <!--PHOTO-ITEM-->
                                <div class="photo-item animation delay1 fadeInLeft detail-tour-image-2" id="detail-tour-image-2-138">

                                    <!--PHOTO-->
                                    <img src="https://www.startravel.vn/upload/images/phuquoc5.jpg" alt="Ngày 02: PHÚ QUỐC – VINPEARL LAND – SAFARI (Ăn sáng, ăn trưa) (Ăn tối tự túc)" class="hover-animation image-zoom-in">
                                </div>
                                <!--END of PHOTO-ITEM-->
                            </div>

                            <!-- Date -->
                            <div class="col-sm-12 col-md-2 text-center story-date-wrapper animation fadeIn">
                                <div class="arrow-left"></div>
                                <div class="story-date">
                                    <div class="month-year">Ngày</div>
                                    <div class="date-only">2</div>

                                </div>
                                <div class="arrow-right"></div>
                                <div class="clearboth"></div>
                            </div>

                            <!-- Text -->
                            <div class="story-desc col-sm-12 col-md-5 col-md-pull-7 animation delay1 fadeInRight">
                                <h5><span class="theme-color">Thứ ba, 01/10/2024</span>
                                    <br>
                                    Ngày 02: PHÚ QUỐC – VINPEARL LAND – SAFARI (Ăn sáng, ăn trưa) (Ăn tối tự túc)
                                </h5>
                                <div class="content-chi-tiet-tour detail-tour-description-2" id="detail-tour-description-2-138">





                                    <div style="text-align: justify;"><strong>Sáng:&nbsp;</strong>Dùng bữa sáng.&nbsp;Xe đưa đoàn trải nghiệm <strong>Cáp treo xác lập kỷ lục thế giới mới “Cáp treo 3 dây vượt biển dài nhất thế giới – 7.899.9m”</strong> với góc nhìn 360 độ ngang qua Hòn Rơi, Hòn Dừa và
                                        dừng chân tại Hòn Thơm. Hành trình trải nghiệm trên cao cho du khách trải nghiệm thú vị bức tranh biển trời phía Nam Phú Quốc bằng những mảng màu thiên nhiên sống động (thời gian cáp treo 15’).</div>
                                    <p style="text-align: justify;"><strong>Trưa:</strong>&nbsp;Dùng cơm trưa. Quý khách có thể tự do tắm biển, nghỉ ngơi tại khách sạn hoặc Quý khách có thể chọn các điểm tham quan tham khảo như sau:</p>
                                    <p style="text-align: justify;"><strong>*<u>Lựa chọn 1</u></strong>: Khám phá<strong>&nbsp;VINPEARLAND&nbsp;</strong><strong>(Chi phí tự túc; không bao gồm: phương tiện vận chuyển, vé tham quan Vinpearl + 1 bữa ăn tối).&nbsp;</strong><strong>Vinpearl Land Phú
                                            Quốc</strong>&nbsp;với quy mô 170.000m2 tại Bãi Dài của đảo Ngọc Phú Quốc, hấp dẫn du khách với một khuôn viên hoành tráng bao gồm:&nbsp;<strong>Công viên nước, Thủy cung, Khu vui chơi ngoài trời, Khu vui chơi trong nhà, Rạp chiếu phim, Lâu đài cổ
                                            tích</strong>,&nbsp;<strong><em>Rạp chiếu phim 5D,&nbsp;</em></strong><strong><em>Chương trình biểu diễn nghệ thuật,...</em></strong></p>
                                    <p style="text-align: justify;"><strong>*<u>Lựa chọn 2</u></strong>: Khám phá<strong>&nbsp;VINPEARL SAFARI&nbsp;</strong><strong>(Chi phí tự túc; không bao gồm: phương tiện vận chuyển, vé tham quan Safari&nbsp; + 1 bữa ăn tối).&nbsp;</strong>Công viên chăm sóc và bảo
                                        tồn động vật Vinpearl Safari – vườn thú mở lớn nhất Việt Nam hiện nay, chính thức mở cửa đón khách tham quan vào ngày 24/12/2015 tại đảo ngọc Phú Quốc, với quy mô 180ha, hơn 130 loài động vật quý hiếm và các chương trình Biểu diễn động vật, Chụp ảnh với động vật,
                                        Khám phá và trải nghiệm Vườn thú mở trong rừng tự nhiên, gần gũi và thân thiện với con người.&nbsp;</p>
                                    <p style="text-align: justify;"><strong>*<u>Lựa chọn 3</u>:&nbsp;</strong>Thư giãn với dịch vụ tại<strong>&nbsp;GALINA PHÚ QUỐC MUD BATH &amp; SPA&nbsp;</strong>với những công dụng tuyệt vời đối với sức khỏe và sắc đẹp.<strong>&nbsp;(Chi phí tự túc; không bao gồm:
                                            phương tiện vận chuyển, vé tắm bùn + 1 bữa ăn tối).&nbsp;</strong>Galina Phú Quốc là khu nghỉ dưỡng tắm bùn khoáng và spa đầu tiên có mặt tại “Đảo Ngọc”, tọa lạc ngay trên bờ biển xanh cát trắng thanh bình của thị xã Dương Tơ. Quý khách có thể tận hưởng các
                                        dịch vụ: tắm bùn khoáng nóng, xông hơi, massage toàn thân, chăm sóc chân, chăm soóc da mặt, tẩy tế bào chết và đắp toàn thân, … hứa hẹn mang đến những trải nghiệm thăng hoa ấn tượng, giúp kỳ nghỉ của quý khách trở nên thú vị hơn với những phút giây
                                        đáng nhớ.</p>
                                    <div style="text-align: justify;">Buổi tối, tự do dạo chợ Đêm Phú Quốc thưởng thức hải sản (chi phí tự túc).</div>
                                    <p style="text-align: justify;"><strong>Nghỉ đêm tại Phú Quốc</strong></p>


                                </div>
                            </div>

                            <div class="vertical-line"></div>

                        </div>
                        <!-- END of STORY ROW-2 -->


                        <!-- STORY ROW-1-->
                        <div class="row story-row">

                            <div class="story-image col-sm-12 col-md-5 text-center">
                                <!--PHOTO-ITEM-->
                                <div class="photo-item animation delay1 fadeInLeft detail-tour-image-2" id="detail-tour-image-2-139">
                                    <!--PHOTO-->
                                    <img src="https://www.startravel.vn/upload/images/phuquoc4.jpg" alt="Ngày 03: PHÚ QUỐC – TP.HCM (Ăn sáng)" class="hover-animation image-zoom-in">
                                    <!--PHOTO OVERLAY-->
                                </div>
                                <!--END of PHOTO-ITEM-->
                            </div>

                            <!-- Date -->
                            <div class="col-sm-12 col-md-2 text-center story-date-wrapper animation fadeIn">
                                <div class="arrow-left"></div>
                                <div class="story-date">
                                    <div class="month-year">Ngày</div>
                                    <div class="date-only">3</div>

                                </div>
                                <div class="arrow-right"></div>
                                <div class="clearboth"></div>
                            </div>

                            <!-- Text -->
                            <div class="story-desc col-sm-12 col-md-5 animation delay1 fadeInRight description-tour-new">
                                <h5><span class="theme-color">Thứ tư, 02/10/2024</span><br>
                                    Ngày 03: PHÚ QUỐC – TP.HCM (Ăn sáng)</h5>
                                <div class="content-chi-tiet-tour detail-tour-description-2" id="detail-tour-description-2-139">
                                    <p><strong>Sáng:&nbsp;</strong>Dùng bữa sáng.&nbsp;Quý khách dùng bữa sáng. Tự do tắm biển nghỉ ngơi. Đến giờ trả phòng khách sạn. Sau đó, xe đưa đoàn ra sân bay Phú Quốc đáp chuyến bay trở về TP. HCM.</p>
                                    <p><em>(Trong trường hợp bay sau 13h, Star Travel sẽ hỗ trợ bữa ăn trưa)</em></p>
                                    <p>Chia tay Quý khách và kết thúc chương trình du lịch tại sân bay Tân Sơn Nhất.</p>
                                </div>
                            </div>
                            <div class="vertical-line"></div>
                        </div>
                        <!-- END of STORY ROW-1 -->
                    </div>
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
