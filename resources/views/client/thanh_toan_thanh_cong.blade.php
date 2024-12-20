@extends('client.layout.index')
@section('title')
    Thanh toán
@endsection
@section('main')
    <div class="container">
        <!-- note -->
        <div class="alert alert-danger d-none">
            <h1>Task</h1>
            <ol>
                <li>null</li>
            </ol>
        </div>
        <div class="alert alert-success d-none">
            <h1>Done</h1>
            <ol>
                <li>tạo page login vào cho người dùng ẩn danh</li>
                <li>
                    Tạo phần tra cứu đơn hàng
                </li>
                <li>
                    Đánh giá tour
                </li>
                <li>Bắt lỗi tra cứu đơn không thuộc về mình</li>
                <li>Đổ nội dung</li>
                <li>Dựng layout</li>
                <li>Tạo page</li>
            </ol>
        </div>

        <!-- MAIN -->
        <section class="bg-body p-2 mb-3 rounded">
            <div class="row">
                <div class="col-6 d-flex flex-column align-items-center justify-content-center text-center">
                    <h4 class="text-primary">ĐẶT CHỖ THÀNH CÔNG</h4>
                    <p>Cảm ơn Quý khách đã quan tâm đến BeeTravel <br> Đơn hàng của Quý khách đang được xử lý</p>
                    <div class="text-bg-primary w-75 p-2">
                        <span>MÃ ĐẶT CHỖ</span>
                        <h2 class="fw-bolder">{{ $order->id }}</h2>
                    </div>
                    <p class="w-75">
                        Nhân viên của chúng tôi sẽ liên hệ với Quý khách trong thời gian sớm nhất. Nếu có thắc mắc. Quý khách vui lòng liên hệ qua số hotline <span class="text-primary">1900-13-15-17</span> Xin chân thành cảm ơn Quý khách hàng!
                    </p>
                </div>
                <div class="col-6 overflow-hidden">
                    <img src="{{ asset('') }}/assets/image/imrs2.png" alt="" class="w-100">
                </div>
            </div>
        </section>


        <section class="bg-body py-2 mb-3 rounded">
            <div class="px-2 border-bottom border-light-subtle">
                <strong class="text-primary">Hồ sơ đặt chỗ</strong>
            </div>
            <div class="px-2 pb-2">
                <table class="table table-borderless w-auto">
                    <tr>
                        <td>Chào quý khách <strong></strong></td>
                        <td class="text-primary fw-bold">{{ $order->fullname }}</td>
                    </tr>

                    <tr>
                        <td>Số người tham gia:</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Trạng thái thanh toán</td>
                        <th>
                            <div class="alert alert-{{ $order->is_paid == 0 ? 'danger' : 'success' }} py-0 m-0">{{ $order->is_paid == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</div>
                        </th>
                    </tr>
                    <tr>
                        <td>Trạng thái tour</td>
                        <th>
                            @switch($order->status)
                                @case('waiting')
                                    <div class="alert alert-light py-0 m-0">Chờ xác nhận</div>
                                @break

                                @case('confirmed')
                                    <div class="alert alert-info py-0 m-0">Đã xác nhận</div>
                                @break

                                @case('cancel')
                                    <div class="alert alert-dark py-0 m-0">Hủy tour</div>
                                @break

                                @case('finished')
                                    <div class="alert alert-success py-0 m-0">Đã hoàn thành</div>
                                @break

                                @default
                            @endswitch
                        </th>
                    </tr>
                    <tr>
                        <td>Khởi hành</td>
                        <th>{{ date('d/m/Y H:i:s', strtotime($order->ngayDi->start_date)) }}</th>
                    </tr>
                    <tr>
                        <td>Tổng giá</td>
                        <th class="text-primary"><strong>{{ number_format($order->total_price) }} VNĐ</strong></th>
                    </tr>
                    <!-- Button trigger modal -->
                    @if ($order->ngayDi->start_date < now())
                        <tfoot>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#danhgiatour">
                                        Đánh giá tour
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    @endif

                </table>
                <div class="p-2 bg-primary bg-opacity-25 border border-primary mx-2">
                    <strong>Cảm ơn Quý khách đã đặt dịch vụ trên BeeTravel. Đơn hàng của Quý khách đang được xử lý. BeeTravel sẽ liên hệ lại Quý khách trong thời gian sớm nhất</strong>
                </div>
            </div>
        </section>
        <section class="bg-body py-2 mb-3 rounded">
            <div class="px-2 border-bottom border-light-subtle">
                <strong class="text-primary">Thông tin tour</strong>
            </div>
            <div class="card mb-3 border-0 p-2">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('') }}assets/image_tour/{{ $tour->image_url }}" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="{{ route('tour_chi_tiet', $tour->id) }}" class="h5 card-title text-primary fw-bold">{{ $tour->title }}</a>
                            <table class="table table-borderless w-auto">
                                <tr>
                                    <td><i class="bi bi-clock"></i></td>
                                    <td>{{ $tour->duration }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-calendar-check"></i></td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($order->ngayDi->start_date)) }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-flag"></i></td>
                                    <td>Nhà tổ chức: {{ $tour->admin->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-body p-2 mb-3 rounded">
            <strong class="text-primary">Hàng Khách</strong>
            <table class="table table-borderless w-auto">
                @foreach ($order->customer as $key => $item)
                    <tr>
                        <td>Hàng khách {{ $key + 1 }}</td>
                        <th>Quý {{ $item->gender == 'mr' ? 'ông' : 'bà' }}</th>
                        <th>{{ $item->name }}</th>
                        <th>{{ date('d/m/Y', strtotime($item->birth_date)) }}</th>

                    </tr>
                @endforeach
            </table>
        </section>

        <div class="text-center pb-3">
            <a href="{{ route('home') }}" class="btn btn-primary px-4"> <i class="bi bi-arrow-bar-left"></i> VỀ TRANG CHỦ</a>
        </div>
    </div>


    @if ($order->ngayDi->start_date < now())
        <!-- Modal -->
        <div class="modal fade" id="danhgiatour" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="danhgiatourLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('danhgia_') }}" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="danhgiatourLabel">Đánh giá tour</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <input type="hidden" name="user_id" value="{{ $order->id }}">

                            <div>
                                <style>
                                    .star {
                                        font-size: 2rem;
                                        color: #ccc;
                                        cursor: pointer;
                                        transition: color 0.2s;
                                    }

                                    .star.selected {
                                        color: #f39c12;
                                    }
                                </style>
                                <div id="rating" class="d-flex justify-content-center">
                                    <i class="bi bi-star star" data-value="1"></i>
                                    <i class="bi bi-star star" data-value="2"></i>
                                    <i class="bi bi-star star" data-value="3"></i>
                                    <i class="bi bi-star star" data-value="4"></i>
                                    <i class="bi bi-star star" data-value="5"></i>
                                </div>
                                <p class="text-center mt-3">Bạn đã chọn: <span id="rating-value">0</span> sao</p>
                                <input type="number" min="1" max="5" step="1" id="rating-value-input" value="" hidden name="star">
                            </div>
                            <textarea name="comment" id="" cols="30" placeholder="Đánh giá..." class="w-100 form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit"  class="btn btn-primary">Bình luận</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                const stars = document.querySelectorAll('.star');
                const ratingValue = document.getElementById('rating-value');
                const ratingValueInput = document.getElementById('rating-value-input');

                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        const value = star.getAttribute('data-value');
                        ratingValue.textContent = value;
                        ratingValueInput.value = value;


                        // Reset tất cả sao về trạng thái mặc định
                        stars.forEach(s => {
                            s.classList.remove('selected');
                            s.classList.replace('bi-star-fill', 'bi-star');
                        });

                        // Tô màu và thay đổi biểu tượng cho các sao đã chọn
                        for (let i = 0; i < value; i++) {
                            stars[i].classList.add('selected');
                            stars[i].classList.replace('bi-star', 'bi-star-fill');
                        }
                    });
                });
            </script>
        </div>
    @endif
@endsection
