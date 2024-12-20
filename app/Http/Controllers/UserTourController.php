<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Tour;
use App\Models\NgayDi;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserTourController extends Controller
{
    public function tour(Request $request)
    {
        // Lấy danh mục
        $categories = Category::all();

        // Lấy giá trị lọc "Nơi khởi hành"
        $locationFilter = $request->input('location');

        // Gọi API để lấy danh sách tỉnh thành
        $response = Http::get('https://provinces.open-api.vn/api/?depth=1');
        $provinces = $response->successful() ? $response->json() : [];

        // Loại bỏ tiền tố "Tỉnh" hoặc "Thành phố" ngay từ đầu
        $provinces = array_map(function ($province) {
            $province['name'] = preg_replace('/^(Tỉnh|Thành phố)\s/', '', $province['name']);
            return $province;
        }, $provinces);

        // Lấy danh sách tour với ngày đi và giá nhỏ nhất từ bảng ngay_di
        $tours = Tour::with([
            'ngayDi' => function ($query) {
                $query->select('tour_id', 'price', 'start_date')->orderBy('start_date', 'asc');
            },
            'category' => function ($query) {
                $query->select('id', 'ten_danh_muc');
            }
        ])
            ->select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'noi_khoi_hanh', 'duration', 'transport', 'featured_start')
            ->when($locationFilter, function ($query) use ($locationFilter) {
                // Áp dụng bộ lọc nơi khởi hành
                $query->where('noi_khoi_hanh', $locationFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Lấy danh sách tin tức
        $news = News::select('id', 'title', 'image_url', 'created_at') // Thêm các cột bạn muốn lấy
            ->latest()
            ->take(4)
            ->get();

        // Trả dữ liệu về view
        return view('client.tour', compact('tours', 'categories', 'news', 'provinces', 'locationFilter'));
    }

    public function fullsearch(Request $request)
    {
        $searchCategory = Category::all();
        // Lấy giá trị lọc "Nơi khởi hành"
        $locationFilter = $request->input('location');

        // Gọi API để lấy danh sách tỉnh thành
        $response = Http::get('https://provinces.open-api.vn/api/?depth=1');
        $provinces = $response->successful() ? $response->json() : [];

        // Loại bỏ tiền tố "Tỉnh" hoặc "Thành phố" ngay từ đầu
        $provinces = array_map(function ($province) {
            $province['name'] = preg_replace('/^(Tỉnh|Thành phố)\s/', '', $province['name']);
            return $province;
        }, $provinces);
        $news = News::all();
        $search = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start');
        $search = Tour::paginate(6);
        return view('client.search_tong_quat', compact('search', 'searchCategory', 'news', 'provinces', 'locationFilter'));
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
        // Lấy giá trị lọc "Nơi khởi hành"
        $locationFilter = $request->input('location');

        // Gọi API để lấy danh sách tỉnh thành
        $response = Http::get('https://provinces.open-api.vn/api/?depth=1');
        $provinces = $response->successful() ? $response->json() : [];

        // Loại bỏ tiền tố "Tỉnh" hoặc "Thành phố" ngay từ đầu
        $provinces = array_map(function ($province) {
            $province['name'] = preg_replace('/^(Tỉnh|Thành phố)\s/', '', $province['name']);
            return $province;
        }, $provinces);
        return view('client.search_tong_quat', compact('search', 'searchCategory', 'news', 'provinces', 'locationFilter'));
    }


    public function showToursByCategory($id, Request $request)
    {
        $category = Category::findOrFail($id);

        // Lấy giá trị lọc "Nơi khởi hành"
        $locationFilter = $request->input('location');

        // Gọi API để lấy danh sách tỉnh thành
        $response = Http::get('https://provinces.open-api.vn/api/?depth=1');
        $provinces = $response->successful() ? $response->json() : [];

        // Loại bỏ tiền tố "Tỉnh" hoặc "Thành phố" ngay từ đầu
        $provinces = array_map(function ($province) {
            $province['name'] = preg_replace('/^(Tỉnh|Thành phố)\s/', '', $province['name']);
            return $province;
        }, $provinces);

        $tours = Tour::where('category_id', $id)->paginate(10);

        $categories = Category::all();
        $news = News::all();

        return view('client.tour', compact('tours', 'categories', 'category', 'news', 'provinces', 'locationFilter'));
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

        // Lấy giá trị lọc "Nơi khởi hành"
        $locationFilter = $request->input('location');

        // Gọi API để lấy danh sách tỉnh thành
        $response = Http::get('https://provinces.open-api.vn/api/?depth=1');
        $provinces = $response->successful() ? $response->json() : [];

        // Loại bỏ tiền tố "Tỉnh" hoặc "Thành phố" ngay từ đầu
        $provinces = array_map(function ($province) {
            $province['name'] = preg_replace('/^(Tỉnh|Thành phố)\s/', '', $province['name']);
            return $province;
        }, $provinces);

        // $news = News::latest()->take(4)->get();

        // $tours = Tour::where('title', 'like', "%$keyword%")
        //     ->orWhere('description', 'like', "%$keyword%")
        //     ->orderby('id', 'desc')
        //     ->paginate(10);
        return view('client.tour', compact('tours', 'categories', 'news', 'provinces', 'locationFilter'));
    }

    public function chitiet($id)
    {
        $now = Carbon::now();

        $categories = Category::all();

        $tour = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'noi_khoi_hanh', 'duration', 'transport', 'featured', 'featured_start')
            ->where('id', '=', $id)
            ->with([
                'ngayDi' => function ($query) use ($now) {
                    $query->where('start_date', '>', $now) // Filter for future dates
                        ->orderBy('start_date'); // Order by date ascending
                }
            ])
            ->first();

        if (!$tour) {
            abort(404);
        }

        // tôi có một table image có thực thể là id, tour_id, name, url
        // hãy lấy dựa trên idtour và thêm nó vào trong mảng phía dưới

        $additionalImages = Image::where('tour_id', $tour->id)->pluck('url')->toArray();
        $images = array_merge([$tour->image_url], $additionalImages);
        // dd($images);

        // tour phụ phần chân trang
        $tours_moinhat = Tour::select('tours.id', 'tours.category_id', 'tours.admin_id', 'tours.image_url', 'tours.title', 'tours.slug', 'tours.duration', 'tours.noi_khoi_hanh', 'tours.transport', 'tours.featured', 'tours.is_hidden')
            ->join('admins', 'tours.admin_id', '=', 'admins.id')
            ->leftJoin('ngay_di', 'tours.id', '=', 'ngay_di.tour_id') // Kết nối với bảng ngày đi
            ->where('tours.is_hidden', 0) // Tour không bị ẩn
            ->where('admins.is_block', 0) // Admin không bị khóa
            ->where(function ($query) {
                // Kiểm tra nếu có ngày đi trong tương lai hoặc không có ngày đi
                $query->where('ngay_di.start_date', '>=', now())
                    ->orWhereNull('ngay_di.start_date'); // Nếu không có ngày đi
            })
            ->orderBy('tours.created_at', 'desc') // Sắp xếp theo ngày tạo
            ->limit(4)
            ->get();

        return view('client.tour_chi_tiet', compact('images', 'categories', 'tour', 'tours_moinhat'));
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
            ->orwhere('slug', 'like', "%$keyword%")
            ->orwhere('content', 'like', "%$keyword%")
            
            ->orderby('id', 'desc')
            ->paginate(4);
        $tours = Tour::where('title', 'like', "%$keyword%")
            ->orwhere('featured', 'like', "%$keyword%")
            ->orwhere('sub_title', 'like', "%$keyword%")
            ->orwhere('description', 'like', "%$keyword%")
            ->orwhere('noi_khoi_hanh', 'like', "%$keyword%")
            ->orwhere('duration', 'like', "%$keyword%")
            ->orwhere('transport', 'like', "%$keyword%")
            ->orderby('id', 'desc')
            ->paginate(6);

        $tours_moinhat = Tour::where('title', 'like', "%$keyword%")
        ->orwhere('featured', 'like', "%$keyword%")
        ->orwhere('sub_title', 'like', "%$keyword%")
        ->orwhere('description', 'like', "%$keyword%")
        ->orwhere('noi_khoi_hanh', 'like', "%$keyword%")
        ->orwhere('duration', 'like', "%$keyword%")
        ->orwhere('transport', 'like', "%$keyword%")
            ->orderby('id', 'desc')
            ->paginate(6);
        return view('client.home', compact('tours', 'categories', 'latestNews', 'tours_moinhat'));
    }

    public function filterTours(Request $request)
    {
        // Gọi API lấy danh sách tỉnh thành
        $response = Http::get('https://provinces.open-api.vn/api/?depth=1');
        $provinces = $response->successful() ? $response->json() : [];

        // Loại bỏ tiền tố "Tỉnh" hoặc "Thành phố" ngay từ đầu
        $provinces = array_map(function ($province) {
            $province['name'] = preg_replace('/^(Tỉnh|Thành phố)\s/', '', $province['name']);
            return $province;
        }, $provinces);

        // Khởi tạo query cơ bản
        $query = Tour::with(['ngayDi' => function ($q) {
            $q->select('tour_id', 'price', 'start_date');
        }]);

        // Áp dụng các bộ lọc
        $this->filterLocation($query, $request);
        $this->filterPrice($query, $request);
        $this->filterStartDate($query, $request);

        // Lấy danh sách các tour
        $tours = $query->paginate(12);

        // Lấy danh mục
        $categories = Category::all();

        // Lấy danh sách tin tức
        $news = News::select('id', 'title', 'image_url', 'created_at')
            ->latest()
            ->take(4)
            ->get();

        return view('client.tour', compact('tours', 'categories', 'news', 'provinces'));
    }

    private function filterLocation($query, $request)
    {
        if ($request->filled('noi_khoi_hanh')) {
            $query->where('noi_khoi_hanh', $request->noi_khoi_hanh);
        }
    }

    private function filterPrice($query, $request)
    {
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
    }

    private function filterStartDate($query, $request)
    {
        if ($request->filled('start_date')) {
            $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->start_date)->toDateString();

            $query->whereHas('ngayDi', function ($q) use ($startDate) {
                $q->whereDate('start_date', '>=', $startDate);
            });
        }
    }
}
