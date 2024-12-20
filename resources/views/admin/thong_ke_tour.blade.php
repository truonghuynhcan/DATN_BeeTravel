@extends('admin.layout.index')
@section('title')
   Thống kê
@endsection

@section('main')
<style>
        .table th, .table td {
            vertical-align: middle;
        }
        .table img {
            max-width: 100%;
            height: auto;
        }
        .table td {
            text-align: center;
        }
    </style>
 <!-- Header -->
 <div class="container-fluid my-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="header">Thống kê Tour</h1>
        </div>
    </div>

    <!-- Cards -->
    <div class="container">
        <div class="row g-4">
            <!-- Earnings (Monthly) -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-primary">TỔNG SỐ TOUR HIỆN CÓ </h6>
                    <h3 class="fw-bold">
                        @if(isset($toursCountById))
                            {{ $toursCountById->sum('count') }}
                        @else
                            0
                        @endif</h3>
                </div>
            </div>
            <!-- Earnings (Annual) -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-success">TỔNG LOẠI TOUR TRONG NƯỚC</h6>
                    <h3 class="fw-bold"> 
                    @if(isset($tourCountsByCategory))
                        @php
                            $tourInCountry = $tourCountsByCategory->firstWhere('tour_type', 'Tour trong nước');
                        @endphp
                        {{ $tourInCountry ? $tourInCountry->total_categories : 0 }}
                    @else
                        0
                    @endif</h3>
                </div>
            </div>
            <!-- Tasks -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-info">TỔNG LOẠI TOUR NƯỚC NGOÀI</h6>
                    <h3 class="fw-bold">
                    @if(isset($tourCountsByCategory))
                        @php
                            $tourAbroad = $tourCountsByCategory->firstWhere('tour_type', 'Tour nước ngoài');
                        @endphp
                        {{ $tourAbroad ? $tourAbroad->total_categories : 0 }}
                    @else
                        0
                    @endif
                    </h3>
                </div>
            </div>
            <!-- Pending Requests -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-warning">TỔNG SỐ TIN TỨC</h6>
                    <h3 class="fw-bold">
                        @if(isset($totalNews))
                            {{ $totalNews->sum('count') }}
                        @else
                            0
                        @endif</h3>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <!-- <h1 class="header">Các tour được đặt nhiều nhất</h1> -->
    </div>
    <hr>
    <h2 class="">Các loại tour được đặt nhiều nhất</h2>
    <!-- Bảng hiển thị các tour -->
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th class="text-uppercase">Ảnh</th>
                <th class="text-uppercase text-start">Tên Tour</th>
                <th class="text-uppercase">Danh Mục</th>
                <th class="text-uppercase">Giá</th>
                <th class="text-uppercase">Ngày Đi</th>
                <th class="text-uppercase">Số Lượng Đặt</th>
                
                
                
            </tr>
        </thead>
        <tbody>
            @foreach($mostBookedTours as $tour)
                <tr>
                    <td>
                        <img src="{{ asset('assets/image_tour/'. $tour->image_url) }}"alt="ảnh" class="object-fit-cover" height="60px" width="60px">
                    </td>
                    <td class="fw-bold text-start">{{ $tour->tour_name }}</td>
                    <td>{{$tour-> category_name}}</td>
                    <td>{{ number_format($tour->total_price ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $tour->booking_date }}</td>
                    <td>{{ $tour->total_bookings }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
    .container-fluid + .container-fluid {
        margin-top: 20px; /* Tạo khoảng cách giữa các bảng */
    }
</style>

 <!-- Sơ đồ thống kê -->
 <div class="container mt-5">
        <div class="row g-4">
            <!-- Revenue Overview (Bar Chart) -->
            <div class="col-md-8">
                <div class="card p-3">
                    <h5 class="text-primary">Tỉ lệ Tour Theo Khu Vực</h5>
                    <!-- Biểu đồ -->
                    <canvas id="tourChart"></canvas>
                </div>
            </div>
            <!-- Revenue Sources -->
            
        </div>
</div>
   
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Dữ liệu từ controller
    const tourStats = @json($tourStats);

    // Chuẩn bị dữ liệu cho biểu đồ cột
    const labels = tourStats.map(data => data.region); // Miền
    const data = tourStats.map(data => data.total_tours); // Số lượng tour

    rendertourChart(labels, data);

    // Hàm render biểu đồ cột
    function rendertourChart(labels, data) {
        const ctx = document.getElementById('tourChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Số lượng tour',
                    data: data,
                    backgroundColor: ['#4e73df'],
borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Số lượng tour' }
                    },
                    x: {
                        title: { display: true, text: 'Khu vực' }
                    }
                }
            }
        });
    }
</script>

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