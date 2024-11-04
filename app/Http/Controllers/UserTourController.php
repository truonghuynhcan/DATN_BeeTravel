<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tour;
use App\Models\NgayDi;
use App\Models\News;
use Illuminate\Http\Request;

class UserTourController extends Controller
{
    public function tour()
    {
        $categories = Category::all();
        $tours = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start')->limit(9)->get();
        $news = News::select('id', 'title', 'image_url', 'created_at') // thêm các cột bạn muốn lấy
            ->latest()
            ->take(4)
            ->get();
        $tours = Tour::paginate(9);
        return view('client.tour', compact('tours', 'categories', 'news'));
    }

    public function showToursByCategory($id)
    {
        $category = Category::findOrFail($id);

        $tours = Tour::where('category_id', $id)->paginate(10);

        $categories = Category::all();
        $news = News::all();

        return view('client.tour', compact('tours', 'categories', 'category', 'news'));
    }


    public function searchTours(Request $request)
    {

        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa để tìm kiếm.');
        }

        $categories = Category::all();
        $news = News::latest()->take(4)->get();

        $tours = Tour::where('title', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orderby('id', 'desc')
            ->paginate(10);
        return view('client.tour', compact('tours', 'categories', 'news'));
    }



    public function chitiet($id)
    {
        $categories = Category::all();

        $tour = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start')
            ->where('id', '=', $id)
            ->first();

        if (!$tour) {
            abort(404);
        }

        $images = array_merge([$tour->image_url], [
            'assets/image_tour/tour02.webp',
            'assets/image_tour/tour03.webp',
            // Thêm các ảnh khác nếu có
        ]);

        return view('client.tour_chi_tiet', compact('images', 'categories', 'tour'));
    }


    // public function show($id)
    // {
    //     $tour = Tour::with('ngayDi')->find($id);
    //     return view('client.tour_chi_tiet', compact('images','categories','tour'));
    // }
    // public function getPrice(Request $request)
    // {
    //     $date = $request->input('date');
    //     $tourId = $request->input('tour_id');

    //     $priceInfo = NgayDi::where('tour_id', $tourId)
    //         ->where('start_date', $date)
    //         ->first();

    //     if ($priceInfo) {
    //         return response()->json([
    //             'price' => number_format($priceInfo->price, 0, ',', '.')
    //         ]);
    //     }

    //     return response()->json(['price' => 'Không có sẵn']);
    // }
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
