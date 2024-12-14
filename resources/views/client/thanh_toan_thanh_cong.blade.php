@extends('client.layout.index')
@section('title')
    Thanh toán
@endsection
@section('main')
    <div class="container">
        <!-- note -->
        <div class="alert alert-danger">
            <h1>Task</h1>
            <ol>
                <li>
                    Bắt lỗi tra cứu đơn không thuộc về mình
                </li>
                <li>
                    Tạo phần tra cứu đơn hàng
                </li>
            </ol>
        </div>
        <div class="alert alert-success">
            <h1>Done</h1>
            <ol>
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
                        <h2 class="fw-bolder">{{$order->id}}</h2>
                    </div>
                    <p class="w-75">
                        Nhân viên của chúng tôi sẽ liên hệ với Quý khách trong thời gian sớm nhất. Nếu có thắc mắc. Quý khách vui lòng liên hệ qua số hotline <span class="text-primary">1900-13-15-17</span> Xin chân thành cảm ơn Quý khách hàng!
                    </p>
                </div>
                <div class="col-6 overflow-hidden">
                    <img src="{{asset('')}}/assets/image/imrs2.png" alt="" class="w-100">
                </div>
            </div>
        </section>


        <section class="bg-body p-2 mb-3 rounded pt-3">
            <p>Chào quý khách <strong class="text-primary">{{$order->fullname}}</strong></p>
            <p>Chuyến đi bắt đầu lúc: <strong>tại</strong> Tại: </p>
            <p>Số người tham gia: </p>

        </section>

        <section class="bg-body py-2 mb-3 rounded">
            <div class="px-2 border-bottom border-light-subtle">
                <strong class="text-primary">Hồ sơ đặt chỗ</strong>
            </div>
            <div class="px-2 pb-2">
                <table class="table table-borderless w-auto">
                    <tr>
                        <td>Mã đặt chỗ</td>
                        <th class="text-primary">{{$order->id}}</th>
                    </tr>
                    <tr>
                        <td>Trạng thái thanh toán</td>
                        <th>{{$order->is_paid==0?'Chưa thanh toán': 'Đã thanh toán'}}</th>
                    </tr>
                    <tr>
                        <td>Khởi hành</td>
                        <th>{{ date('d/m/Y H:i:s', strtotime($order->ngayDi->start_date)) }}</th>
                    </tr>
                    <tr>
                        <td>Tổng giá</td>
                        <th class="text-primary"><strong>{{number_format($order->total_price)}} VNĐ</strong></th>
                    </tr>
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
                        <img src="../assets/image_tour/1729670564_Đà Nẵng Hội An Huế2.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="{{route('chitiet',$tour->id)}}" class="h5 card-title text-primary fw-bold">{{$tour->title}}</a>
                            <table class="table table-borderless w-auto">
                                <tr>
                                    <td><i class="bi bi-flag"></i></td>
                                    <td>Mã tour: {{$tour->id}}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-clock"></i></td>
                                    <td>{{$tour->duration}}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-calendar-check"></i></td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($order->ngayDi->start_date)) }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-flag"></i></td>
                                    <td>Nhà tổ chức: {{$tour->admin->name}}</td>
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
                @foreach ($order->customer as $key=> $item)
                <tr>
                    <td>Hàng khách {{$key+1}}</td>
                    <th>Quý {{$item->gender=='mr'?'ông':'bà'}}</th>
                    <th>{{$item->name}}</th>
                    <th>{{ date('d/m/Y', strtotime($item->birth_date)) }}</th>

                </tr>
                @endforeach
            </table>
        </section>

        <div class="text-center pb-3">
            <a href="{{route('home')}}" class="btn btn-primary px-4"> <i class="bi bi-arrow-bar-left"></i> VỀ TRANG CHỦ</a>
        </div>
    </div>
@endsection
