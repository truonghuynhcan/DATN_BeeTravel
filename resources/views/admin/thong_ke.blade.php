@extends('admin.layout.index')

@section('title')
   Thống kê
@endsection

@section('main')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- Header -->
    <div class="container-fluid my-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="header">Dashboard</h1>
        </div>
    </div>

    <!-- Cards -->
    <div class="container">
        <div class="row g-4">
            <!-- Earnings (Monthly) -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-primary">TỔNG DOANH THU</h6>
                    <h3 class="fw-bold">{{ number_format($toursRevenue ?? 0) }} VNĐ</h3>
                </div>
            </div>
            <!-- Earnings (Annual) -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-success">TỔNG ĐƠN HÀNG</h6>
                    <h3 class="fw-bold">{{ $totalOrders ?? 0 }}</h3>
                </div>
            </div>
            <!-- Tasks -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-info">TỔNG SỐ KHÁCH HÀNG</h6>
                    <h3 class="fw-bold">
                    {{ $totalUsers ?? 0 }}
                    </h3>
                </div>
            </div>
            <!-- Pending Requests -->
            <div class="col-md-3">
                <div class="card p-3">
                    <h6 class="text-warning">TỔNG ĐỐI TÁC</h6>
                    <h3 class="fw-bold">{{ $totalProvider ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="container mt-5">
        <div class="row g-4">
            <!-- Revenue Overview (Bar Chart) -->
            <div class="col-md-8">
                <div class="card p-3">
                    <h5 class="text-primary">BIỂU ĐỒ KẾT HỢP DOANH THU VÀ SỐ LƯỢNG TOUR ĐƯỢC ĐẶT THEO THÁNG</h5>
                    <!-- Biểu đồ -->
                    <canvas id="combinedChart"></canvas>
                </div>
            </div>
            <!-- Revenue Sources -->
            <div class="col-md-4">
                <div class="card p-3">
                    <h5 class="text-primary">Doanh thu theo danh mục</h5>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
           
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
   

    // Dữ liệu cho biểu đồ tròn (doanh thu theo loại tour)
    const tourCategories = @json($tourCategories);
    const categoryLabels = tourCategories.map(data => (data.tour_nuoc_ngoai == 0 ? 'Tour trong nước' : 'Tour nước ngoài'));
    const categoryRevenue = tourCategories.map(data => data.total_revenue);

    renderDoughnutChart(categoryLabels, categoryRevenue);

    // Hàm render biểu đồ tròn
    function renderDoughnutChart(labels, revenue) {
        const ctx = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu theo loại tour',
                    data: revenue,
                    backgroundColor: ['#f6c23e', '#e74a3b'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Lấy dữ liệu từ controller
        const monthlyData = @json($monthlyData);

        const labels = monthlyData.map(data => `Tháng ${data.month}`);
        const revenueData = monthlyData.map(data => data.revenue);
        const tourData = monthlyData.map(data => data.total_tours);
        console.log("tour ", tourData);

        renderCombinedChart(labels, revenueData, tourData);
    });

    // Hàm vẽ biểu đồ
    function renderCombinedChart(labels, revenueData, tourData) {
        const ctx = document.getElementById('combinedChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Dữ liệu trục X
                datasets: [
                    {
                        label: 'Doanh thu (VNĐ)',
                        data: revenueData,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)', // Màu cho cột
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        barThickness: 30, // Đặt độ dày của cột
                        categoryPercentage: 0.8, // Tăng chiều rộng cho cột
                        yAxisID: 'y1',
                    },
                    {
                        label:'Số lượng tour' ,
                        data: tourData,
                        type: 'line',  // Đặt kiểu biểu đồ là đường cho dataset này
                        borderColor: 'rgba(54, 162, 235, 1)', // Màu cho đường
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Màu nền cho đường
                        tension: 0.3,
                        fill: false,
                        borderWidth: 3,
                        yAxisID: 'y2',// Hiển thị dạng đường
                    }
                ]
            },
            options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            },
            tooltip: {
                mode: 'index',
                intersect: false,
            }
        },
        scales: {
            y1: {
                type: 'linear',
                position: 'left',
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Doanh thu (VNĐ)'
                }
            },
            y2: {
                type: 'linear',
                position: 'right',
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Số lượng tour'
                },
                grid: {
                    drawOnChartArea: false, // Đảm bảo chỉ có y1 có lưới
                }
            },
            x: {
                beginAtZero: true
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
        const role = 'admin'; 
        $http.get(`/admin/api/danh-sach-adminusers?role=${role}`).then(
            function(res) { // success
                $scope.adminusers = res.data.data;
            },
            function(res) { // error
                console.error('Lỗi khi lấy danh sách providers:', res);
            }
        );
    };
</script>
@endsection
