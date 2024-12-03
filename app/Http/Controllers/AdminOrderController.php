<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\NgayDi;
use App\Models\Order;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function order($admin_id)
    {
        // bắt lỗi bảo mật dữ liệu các admin khác
        if ($admin_id!=auth()->user()->id) {
            return redirect()->back();
        }
        // Lấy role của admin (chỉ lấy trường cần thiết để tiết kiệm tài nguyên)
        $role = Admin::where('id', $admin_id)->value('role');

        // Kiểm tra role để trả về tours tương ứng
        if ($role == 'admin') {
            // Lấy tất cả tours
            $order_list =  DB::table('orders')
            ->join('ngay_di', 'orders.ngaydi_id', '=', 'ngay_di.id')   // Join với bảng ngay_di
            ->join('tours', 'ngay_di.tour_id', '=', 'tours.id')         // Join với bảng tours
            ->join('admins', 'tours.admin_id', '=', 'admins.id')        // Join với bảng admins
            ->select('orders.*', 'admins.id as admin_id', 'admins.name as admin_name') // Chỉ chọn cột cần thiết
            ->get();
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
            ->whereIn('orders.id',$ngaydis)
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
}
