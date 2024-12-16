<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Tour;
use App\Models\NgayDi;
use App\Models\News;
use Illuminate\Http\Request;

class UserTourController extends Controller
{
    public function tour()
    {
        // Lấy danh mục
        $categories = Category::all();

        // Lấy danh sách tour với ngày đi và giá nhỏ nhất từ bảng ngay_di
        $tours = Tour::with(['ngayDi' => function ($query) {
            $query->select('tour_id', 'price', 'start_date')->orderBy('start_date', 'asc');
        }])
            ->select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start')
            ->orderBy('created_at', 'desc') // Sắp xếp từ mới đến cũ
            ->paginate(12); // Phân trang với 12 tour mỗi trang

        // Lấy danh sách tin tức
        $news = News::select('id', 'title', 'image_url', 'created_at') // Thêm các cột bạn muốn lấy
            ->latest()
            ->take(4)
            ->get();

        // Trả dữ liệu về view
        return view('client.tour', compact('tours', 'categories', 'news'));
    }




    public function fullsearch()
    {
        $searchCategory = Category::all();
        $news = News::all();
        $search = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start');
        $search = Tour::paginate(6);
        return view('client.search_tong_quat', compact('search', 'searchCategory', 'news'));
    }


    public function Allsearch(Request $request)
    {
        $keyword = $request->input('keyword');
        if (empty($keyword)) {
            // Nếu từ khóa rỗng, chuyển hướng về trang tìm kiếm
            return redirect()->route('search_tong_quat')->with('error', 'Vui lòng nhập từ khóa để thực hiện tìm kiếm.');
        }
        $searchCategory = Category::all();
        $news = News::where('title', 'like', "%$keyword%")
            ->orwhere('description', 'like', "%$keyword%")
            ->orderby('id', 'desc')
            ->paginate(4);
        $search = Tour::where('title', 'like', "%$keyword%")
            ->orwhere('featured', 'like', "%$keyword%")
            ->orderby('id', 'desc')
            ->paginate(6);
        return view('client.search_tong_quat', compact('search', 'searchCategory', 'news'));
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

        $tours = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start')
            ->where('title', 'like', "%$keyword%")
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // $tours = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start')->limit(12)->get();
        // $tours = Tour::paginate(9);
        $news = News::select('id', 'title', 'image_url', 'created_at') // thêm các cột bạn muốn lấy
            ->latest()
            ->take(4)
            ->get();

        // $news = News::latest()->take(4)->get();

        // $tours = Tour::where('title', 'like', "%$keyword%")
        //     ->orWhere('description', 'like', "%$keyword%")
        //     ->orderby('id', 'desc')
        //     ->paginate(10);
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

        // tôi có một table image có thực thể là id, tour_id, name, url
        // hãy lấy dựa trên idtour và thêm nó vào trong mảng phía dưới

        $additionalImages = Image::where('tour_id', $tour->id)->pluck('url')->toArray();
        $images = array_merge([$tour->image_url], $additionalImages);
        // dd($images);

        return view('client.tour_chi_tiet', compact('images', 'categories', 'tour'));
    }


    public function homesearchfull(Request $request)
    {
        $keyword = $request->input('keyword');
        if (empty($keyword)) {
            // Nếu từ khóa rỗng, chuyển hướng về trang tìm kiếm
            return redirect()->route('home')->with('error', 'Vui lòng nhập từ khóa để thực hiện tìm kiếm.');
        }
        $categories = Category::all();
        $latestNews = News::where('title', 'like', "%$keyword%")
            ->orwhere('description', 'like', "%$keyword%")
            ->orderby('id', 'desc')
            ->paginate(4);
        $tours = Tour::where('title', 'like', "%$keyword%")
            ->orwhere('featured', 'like', "%$keyword%")
            ->orderby('id', 'desc')
            ->paginate(6);
        return view('client.home', compact('tours', 'categories', 'latestNews'));
    }

    public function filterTours(Request $request)
    {
        $query = Tour::with(['ngayDi' => function ($q) {
            $q->select('tour_id', 'price', 'start_date');
        }]);

        // Lọc theo giá
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            $minPrice = isset($range[0]) ? (int)$range[0] : null;
            $maxPrice = isset($range[1]) && $range[1] !== '' ? (int)$range[1] : null;

            $query->whereHas('ngayDi', function ($q) use ($minPrice, $maxPrice) {
                if (!is_null($minPrice)) {
                    $q->where('price', '>=', $minPrice);
                }
                if (!is_null($maxPrice)) {
                    $q->where('price', '<=', $maxPrice);
                }
            });
        }


        // Lọc theo ngày đi
        if ($request->filled('start_date')) {
            $query->whereHas('ngayDi', function ($q) use ($request) {
                $q->whereDate('start_date', '>=', $request->start_date);
            });
        }

        // Lọc theo địa điểm
        if ($request->filled('location')) {
            $query->where('category_id', $request->location);
        }

        // Phân trang
        $tours = $query->paginate(10);

        // Lấy danh sách danh mục
        $categories = Category::all();

        $news = News::select('id', 'title', 'image_url', 'created_at') // Thêm các cột bạn muốn lấy
            ->latest()
            ->take(4)
            ->get();

        // dd($query->toSql(), $query->getBindings());

        return view('client.tour', compact('tours', 'categories', 'news'));
    }


}
