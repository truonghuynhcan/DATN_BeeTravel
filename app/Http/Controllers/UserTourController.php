<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Tour;
use App\Models\NgayDi;
use Illuminate\Http\Request;

class UserTourController extends Controller
{
    public function tour()
    {
        $categories = Category::all(); 
        $tours = Tour::select('id','category_id', 'image_url', 'title', 'sub_title', 'slug', 'description','duration','transport','featured','featured_start')->limit(9)->get();
        return view('client.tour', compact('categories','tours'));
    }
    
    public function chitiet($slug)
    {
        $categories = Category::all();
        $tour = Tour::select('id','category_id', 'image_url', 'title', 'sub_title', 'slug', 'description','duration','transport','featured','featured_start')->where('slug', '=', $slug)->first();

        $images = [
            'assets/image_tour/'.$tour->image_url,
            'assets/image_tour/tour02.webp',
            'assets/image_tour/tour03.webp',
            'assets/image_tour/tour03.webp',
            // Thêm các ảnh khác nếu có
        ];
        
        return view('client.tour_chi_tiet', compact('images','categories','tour'));
    }
    public function show($id)
    {
        $tour = Tour::with('ngayDi')->find($id);
        return view('client.tour_chi_tiet', compact('images','categories','tour'));
    }
    public function getPrice(Request $request)
    {
        $date = $request->input('date');
        $tourId = $request->input('tour_id');

        $priceInfo = NgayDi::where('tour_id', $tourId)
            ->where('start_date', $date)
            ->first();

        if ($priceInfo) {
            return response()->json([
                'price' => number_format($priceInfo->price, 0, ',', '.')
            ]);
        }

        return response()->json(['price' => 'Không có sẵn']);
    }
    // public function bookTour(Request $request)
    // {
    //     // Lấy dữ liệu từ request
    //     $tourId = $request->input('tour_id');
    //     $selectedDate = $request->input('selected_date');

    //     // Tìm tour và ngày đi
    //     $tour = Tour::find($tourId);
    //     $ngayDi = NgayDi::where('tour_id', $tourId)->where('start_date', $selectedDate)->first();

    //     // Kiểm tra nếu tour và ngày đi tồn tại
    //     if ($tour && $ngayDi) {
    //         // Chuyển hướng đến trang thanh toán với dữ liệu cần thiết
    //         return view('client.thanh_toan', [
    //             'tour' => $tour,
    //             'ngayDi' => $ngayDi
    //         ]);
    //     }

    //     return redirect()->back()->withErrors('Tour hoặc ngày không hợp lệ.');
    // }
}