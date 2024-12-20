<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\NgayDi;
use App\Models\Order;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function order($admin_id)
    {
        // bắt lỗi bảo mật dữ liệu các admin khác
        if ($admin_id != auth()->user()->id) {
            return redirect()->back();
        }
        // Lấy role của admin (chỉ lấy trường cần thiết để tiết kiệm tài nguyên)
        $role = Admin::where('id', $admin_id)->value('role');

        // Kiểm tra role để trả về tours tương ứng
        if ($role == 'admin') {
            // VERSION 3
            $order_list = DB::table('orders')
                ->leftJoin('customers', 'customers.order_id', '=', 'orders.id') // Join với bảng customers
                ->join('ngay_di', 'orders.ngaydi_id', '=', 'ngay_di.id') // Join với bảng ngay_di để lấy tour_id
                ->join('tours', 'ngay_di.tour_id', '=', 'tours.id') // Join với bảng tours để lấy name
                ->select(
                    'orders.*',
                    DB::raw('COUNT(customers.id) as customer_count'), // Đếm số lượng khách hàng trong mỗi đơn hàng
                    'tours.title as tour_name', // Lấy tên tour từ bảng tours
                    'tours.noi_khoi_hanh as noi_khoi_hanh', // Lấy tên tour từ bảng tours
                    'ngay_di.start_date as ngaydi' // Lấy ngày đi từ bảng ngay_di
                )
                ->groupBy('orders.id', 'tours.title', 'ngay_di.start_date', 'tours.noi_khoi_hanh') // Thêm GROUP BY để tránh lỗi SQL khi sử dụng COUNT và các cột khác
                ->get()
                ->map(function ($order) {
                    $order->ngaydi = Carbon::parse($order->ngaydi)->format('d-m-Y (H:i)');
                    return $order;
                });
            ;

            // VERSION 2
            // $order_list = DB::table('orders')
            //     ->leftJoin('customers', 'customers.order_id', '=', 'orders.id')
            //     ->select(
            //         'orders.*',
            //         DB::raw('COUNT(customers.id) as customer_count')
            //         //dùng order.ngaydi_id để tiếp tục tìm tour_id trong bảng ngaydi
            //         // sau khi có được tour_id thì lấy name trong bảng tour dựa vào tour_id vừa tìm được
            //     )
            //     ->groupBy('orders.id')
            //     ->get();

            // VERSION 1
            // Lấy tất cả tours
            // $order_list = DB::table('orders')
            //     ->join('ngay_di', 'orders.ngaydi_id', '=', 'ngay_di.id')   // Join với bảng ngay_di
            //     ->join('tours', 'ngay_di.tour_id', '=', 'tours.id')         // Join với bảng tours
            //     ->join('admins', 'tours.admin_id', '=', 'admins.id')        // Join với bảng admins
            //     ->leftJoin('customers', 'customers.order_id', '=', 'orders.id')
            //     ->select('orders.*', 'admins.id as admin_id', 'admins.name as admin_name', DB::raw('COUNT(customers.id) as customer_count')) // Chỉ chọn cột cần thiết
            //     // COUNT CUSTOMER
            //     ->get();

            // TỔNG SỐ NGƯỜI ĐI
            $total_customers = DB::table('customers')
                ->join('orders', 'customers.order_id', '=', 'orders.id') // Join customers với orders
                ->count('customers.id'); // Đếm số khách hàng


        } else {
            // Bước 1: Tìm các Tour liên kết với admin_id đã cho và có role là 'provider'
            $tours = Tour::where('admin_id', $admin_id)
                ->pluck('id');
            // ? Phương thức pluck('id') sẽ trả về một mảng chỉ chứa các giá trị của cột id từ các bản ghi phù hợp với điều kiện truy vấn.
            // ? trả về dạng mảng [1,2,4]

            // Bước 2: Lấy các bản ghi NgayDi cho các tour lấy được
            $ngaydis = NgayDi::whereIn('tour_id', $tours)->pluck('id');

            // Bước 3: Lấy các bản ghi từ bảng mục tiêu sử dụng ngaydi_id
            $order_list = DB::table('orders')
                ->join('ngay_di', 'orders.ngaydi_id', '=', 'ngay_di.id')
                ->join('tours', 'ngay_di.tour_id', '=', 'tours.id')
                ->join('admins', 'tours.admin_id', '=', 'admins.id')
                ->whereIn('orders.id', $ngaydis)
                ->select('orders.*')
                ->get();
        }
        // dd($order_list);
        // trả kết quả
        $return = [
            'status' => true,
            'message' => 'Lấy dữ liệu đơn hàng thành công!',
            'data' => $order_list,
        ];
        return response()->json($return, 200);
        // 200 - thành công
        // 404 - not found
        // 403 - forbidden thiếu quyền
    }
    //

    public function updateOrderPaid(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'order_is_paid' => 'required|in:0,1',
        ]);
        // Tìm và cập nhật trạng thái đơn hàng
        $order = Order::find($request->order_id);
        $order->is_paid = $request->order_is_paid;
        $order->save();

        return response()->json(['status' => true, 'message' => 'Cập nhật thanh toán thành công!']);
    }
    public function updateOrderStatus(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:waiting,confirmed,cancel,finished',
        ]);
        // Tìm và cập nhật trạng thái đơn hàng
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['status' => true, 'message' => 'Cập nhật trạng thái thành công!']);
    }
}
