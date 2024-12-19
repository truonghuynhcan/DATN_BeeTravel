<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Order;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function getStatistics()
    {
        try {
            // Lấy tổng số Tour hiện có
            $toursCountById = DB::table('tours')
                ->select('id', DB::raw('COUNT(*) as count'))
                ->where('is_hidden', '0') // Chỉ đếm những tour có trạng thái 'active'
                ->groupBy('id')
                ->get();

            // Lấy tổng số Đơn hàng
            $totalOrders = Order::count(); // Đếm tổng số đơn hàng trong bảng orders

            // Lấy tổng số tin tức
            $totalNews = DB::table('news')
                ->select('id', DB::raw('COUNT(*) as count'))
                ->where('is_hidden', '0') // Chỉ đếm những tin tức có trạng thái 'active'
                ->groupBy('id')
                ->get();

            // Lấy tổng số Đối tác
            $totalProvider = DB::table('admins')
                ->where('role', 'provider')  // Lọc theo role 'provider'
                ->count();


            // Lấy tổng loại tour
            $tourCountsByCategory = DB::table('categories')
            ->select(
                DB::raw("CASE 
                            WHEN categories.tour_nuoc_ngoai = 0 THEN 'Tour trong nước'
                            WHEN categories.tour_nuoc_ngoai = 1 THEN 'Tour nước ngoài'
                            ELSE 'Khác' 
                        END as tour_type"),
                DB::raw('COUNT(categories.id) as total_categories')
            )
            ->groupBy('tour_type')  // Nhóm theo loại tour
            ->get();


        // lấy tour đc đặt nhiều 
        $mostBookedTours = DB::table('tours')
            ->join('ngay_di', 'tours.id', '=', 'ngay_di.tour_id') // Kết nối bảng tours với bảng ngay_di qua tour_id
            ->join('orders', 'ngay_di.id', '=', 'orders.ngaydi_id') // Kết nối bảng ngay_di với bảng orders qua ngay_di_id
            ->select(
                'tours.title as tour_name', // Tên tour từ bảng tours
                'ngay_di.start_date as booking_date', // Ngày đi từ bảng ngay_di
                DB::raw('COUNT(orders.id) as total_bookings') // Đếm số lượt đặt từ bảng orders
            )
            ->groupBy('tours.id', 'tours.title', 'ngay_di.start_date') // Nhóm theo tour, tên tour và ngày đi
            ->orderByDesc('total_bookings') // Sắp xếp theo số lượng lượt đặt
            ->limit(10) // Lấy 10 tour có lượt đặt nhiều nhất
            ->get();

            

             // Danh sách các tỉnh thuộc từng miền
        $mienBac = [
            'Hà Nội', 'Hải Phòng', 'Quảng Ninh', 'Bắc Ninh', 'Bắc Giang',
            'Vĩnh Phúc', 'Phú Thọ', 'Thái Nguyên', 'Lạng Sơn', 'Cao Bằng',
            'Hà Giang', 'Tuyên Quang', 'Yên Bái', 'Lào Cai', 'Điện Biên',
            'Lai Châu', 'Sơn La', 'Hòa Bình', 'Nam Định', 'Hà Nam',
            'Ninh Bình', 'Thái Bình'
        ];
        $mienTrung = [
            'Thanh Hóa', 'Nghệ An', 'Hà Tĩnh', 'Quảng Bình', 'Quảng Trị',
            'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Quảng Ngãi', 'Bình Định',
            'Phú Yên', 'Khánh Hòa', 'Ninh Thuận', 'Bình Thuận', 'Kon Tum',
            'Gia Lai', 'Đắk Lắk', 'Đắk Nông', 'Lâm Đồng'
        ];
        $mienNam = [
            'Thành phố Hồ Chí Minh', 'Bình Dương', 'Đồng Nai', 'Bà Rịa - Vũng Tàu',
            'Tây Ninh', 'Bình Phước', 'Long An', 'Tiền Giang', 'Bến Tre',
            'Vĩnh Long', 'Trà Vinh', 'Đồng Tháp', 'An Giang', 'Cần Thơ',
            'Hậu Giang', 'Sóc Trăng', 'Bạc Liêu', 'Cà Mau', 'Kiên Giang'
        ];

        // Truy vấn dữ liệu số lượng tour theo miền và loại (nội địa/quốc tế)
        $tourStats = DB::table('tours')
            ->join('categories', 'tours.category_id', '=', 'categories.id')
            ->select(
                DB::raw("
                    CASE
                        WHEN categories.ten_danh_muc IN ('" . implode("','", $mienBac) . "') THEN 'Miền Bắc'
                        WHEN categories.ten_danh_muc IN ('" . implode("','", $mienTrung) . "') THEN 'Miền Trung'
                        WHEN categories.ten_danh_muc IN ('" . implode("','", $mienNam) . "') THEN 'Miền Nam'
                        ELSE 'Quốc tế'
                    END as region
                "),
                DB::raw('COUNT(tours.id) as total_tours')
            )
            ->groupBy('region')
            ->get();
            
            

            // Trả về view và truyền dữ liệu vào
            return view('admin.thong_ke_tour', [
                'toursCountById' => $toursCountById,
                'totalOrders' => $totalOrders,
                'totalNews' => $totalNews,
                'tourCountsByCategory' => $tourCountsByCategory,
                'mostBookedTours' =>$mostBookedTours,
                'totalProvider' => $totalProvider,
               
                'tourStats'=> $tourStats,
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return view('admin.thong_ke_tour')->withErrors(['error' => 'Đã xảy ra lỗi khi lấy thống kê: ' . $e->getMessage()]);
        }
    }

    public function getDashboard()
    {
        try {
            // Lấy tổng doanh thu từ đơn hàng đã hoàn thành
            $toursRevenue = DB::table('orders')
                ->where('status', 'waiting') // Lọc theo trạng thái "finished"
                ->sum('total_price');

            // Lấy tổng số Đơn hàng
            $totalOrders = Order::count(); // Đếm tổng số đơn hàng trong bảng orders

            // Lấy tổng số tin tức
            // $totalNews = DB::table('news')
            //     ->select('id', DB::raw('COUNT(*) as count'))
            //     ->where('is_hidden', '0') // Chỉ đếm những tin tức có trạng thái 'active'
            //     ->groupBy('id')
            //     ->get();

            $totalUsers = DB::table('users')->count();
            // Lấy tổng số Đối tác
            $totalProvider = DB::table('admins')
                ->where('role', 'provider')  // Lọc theo role 'provider'
                ->count();
             $monthlyData = DB::table('orders')
                ->select(DB::raw('MONTH(created_at) as month, SUM(total_price) as revenue, COUNT(*) as total_tours'))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();


                
            $tourCategories = DB::table('categories')
                ->join('tours', 'categories.id', '=', 'tours.category_id') // Kết nối với bảng tours
                ->join('ngay_di', 'tours.id', '=', 'ngay_di.tour_id') // Kết nối với bảng ngay_di
                ->select('categories.tour_nuoc_ngoai', 
                        DB::raw('COUNT(tours.id) as total_categories'),
                        DB::raw('SUM(ngay_di.price) as total_revenue')) // Tính doanh thu
                ->groupBy('categories.tour_nuoc_ngoai') // Nhóm theo loại tour
                ->get();
            

            return view('admin.thong_ke', [
                'toursRevenue' => $toursRevenue,
                'totalOrders' => $totalOrders,
                'monthlyData' => $monthlyData,
                'totalUsers' =>$totalUsers,
                'totalProvider' => $totalProvider,
                'tourCategories' => $tourCategories,
                
                
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return view('admin.thong_ke')->withErrors(['error' => 'Đã xảy ra lỗi khi lấy thông tin dashboard: ' . $e->getMessage()]);
        }
    }

}




