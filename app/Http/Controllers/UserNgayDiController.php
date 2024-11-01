<?php

namespace App\Http\Controllers;

use App\Models\NgayDi;
use App\Models\Tour;
use Illuminate\Http\Request;

class UserNgayDiController extends Controller
{
    public function getPrice($date_id)
    {
        // Logic để lấy giá dựa trên tour_id và date
        // Ví dụ: tìm tour dựa trên tour_id và tìm giá dựa trên date
    
        // Lấy giá cho ngày đã chọn (date)
        $price = NgayDi::find($date_id);
    
        if (!$price) {
            return response()->json(['message' => 'Price not found for this date'], 404);
        }
    
        return response()->json([
            'adultCost' => $price->price, // Thay đổi theo tên trường của bạn
            'childCost' => $price->price_tre_em, // Thay đổi theo tên trường của bạn
            'toddlerCost' => $price->price_tre_nho, // Thay đổi theo tên trường của bạn
            'infantCost' => $price->price_em_be // Thay đổi theo tên trường của bạn
        ]);
    }
    
}
