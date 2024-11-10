<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Image;
use App\Models\NgayDi;
use App\Models\News;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Number;


class AdminTourController extends Controller
{
    public function tourEdit($tour_id){
        $tour = Tour::with(['category', 'ngayDi', 'images', 'admin'])->withCount('wishlist')->find($tour_id);
        if (!$tour) {
            return redirect()->back()->withErrors('Tour not found!');
        }
        return view('admin.tour_edit', compact('tour'));
    }
    
    public function tourEdit_update(Request $request,$tour_id){
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string',
            'category_id' => 'required|exists:news_categories,id',
            'admin_id' => 'required|exists:admins,id',
        ]);
    
        $tour = Tour::find($tour_id);
        if (!$tour) {
            return redirect()->back()->withErrors('Tour không tồn tại!');
        }
    
        $tour->title = $request->title;
        $tour->slug = $request->slug;
        $tour->category_id = $request->category_id;
        $tour->admin_id = $request->admin_id;
        $tour->save();
        return redirect()->route('admin.tourManagement')->with('success', 'Cập nhật tour thành công!');
    }
    public function category_tour()
{
    
    // Lấy tất cả news
    // $category_new = NewsCategory::select('id', 'image_url', 'title', 'slug')
    //     ->get();
    //     $return = [
    //         'status' => true,
    //         'message' => 'Lấy dữ liệu tours thành công!',
    //         'data' => $category_new,
    //     ];
        // Lấy tất cả danh mục tin tức
        $category_tour = Category::all(); // Hoặc bạn có thể thêm điều kiện nếu cần
    
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách danh mục thành công!',
            'data' => $category_tour,
        ], 200);
    
}

    // ! Tạo api lấy danh sách tour
    // ! Tạo api lấy danh sách tour
    // ! Tạo api lấy danh sách tour
    public function tours($admin_id)
    {
        // Lấy role của admin (chỉ lấy trường cần thiết để tiết kiệm tài nguyên)
        $role = Admin::where('id', $admin_id)->value('role');

        // Kiểm tra role để trả về tours tương ứng
        if ($role == 'admin') {
            // Lấy tất cả tours
            $tours = Tour::select('id', 'image_url', 'title', 'slug', 'is_hidden', 'admin_id', 'category_id')
                ->with(['admin:id,name', 'category:id,ten_danh_muc', 'ngayDi']) // khi sử dụng with ->luôn có cuột id
                ->get();
        } else {
            // Lấy tour thuộc về đối tác (admin_id)
            $tours = Tour::select('id', 'image_url', 'title', 'slug',  'is_hidden', 'category_id')
                ->with(['category', 'ngayDi'])
                ->where('admin_id', $admin_id)->get();
        }
        // trả kết quả
        $return = [
            'status' => true,
            'message' => 'Lấy dữ liệu tours thành công!',
            'data' => $tours,
        ];
        return response()->json($return, 200);
        // 200 - thành công
        // 404 - not found
        // 403 - forbidden thiếu quyền
    }
    public function news($admin_id)
    {
        // Lấy role của admin (chỉ lấy trường cần thiết để tiết kiệm tài nguyên)
        $role = Admin::where('id', $admin_id)->value('role');

        // Kiểm tra role để trả về tours tương ứng
        if ($role == 'admin') {
            // Lấy tất cả news
            $news = News::select('id', 'image_url', 'title', 'slug','description','content', 'is_hidden', 'admin_id', 'category_id')
                ->with(['Admin:id,name', 'NewsCategory:id,title']) // khi sử dụng with ->luôn có cột id
                ->get();
        } else {
            // Lấy tour thuộc về đối tác (admin_id)
            $news = News::select('id', 'image_url', 'title', 'slug','description','content',  'is_hidden', 'category_id')
                ->with(['NewsCategory',])
                ->where('admin_id', $admin_id)->get();
        }
        // trả kết quả
        $return = [
            'status' => true,
            'message' => 'Lấy dữ liệu tours thành công!',
            'data' => $news,
        ];
        return response()->json($return, 200);
        // 200 - thành công
        // 404 - not found
        // 403 - forbidden thiếu quyền
    }

    // ! Thêm tour
    // ! Thêm tour
    // ! Thêm tour
    public function tourInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                'admin_id' => ['required', 'integer', 'exists:admins,id'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                //  * Tour information
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['nullable', 'string', 'max:255'],
                'sub_title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'transport' => ['nullable', 'string', 'max:100'],
                'duration' => ['nullable', 'string', 'max:50'],


                // * Ngày đi & giá
                'departure-date' => ['sometimes', 'array'],  // ngày khởi hành
                'adult-price' => ['sometimes', 'array'],
                'child-price' => ['sometimes', 'array'],
                'toddler-price' => ['sometimes', 'array'],
                'infant-price' => ['sometimes', 'array'],

                'departure-date.*' => ['nullable', 'date', 'after_or_equal:today'], // Không bắt buộc, nhưng nếu có thì phải đúng định dạng ngày
                // Các trường dưới đây sẽ chỉ bắt buộc nếu có departure-date
                'adult-price.*' => ['required_with:departure-date.*', 'nullable', 'numeric', 'min:0'],
                'child-price.*' => ['required_with:departure-date.*', 'nullable', 'numeric', 'min:0'],
                'toddler-price.*' => ['required_with:departure-date.*', 'nullable', 'numeric', 'min:0'],
                'infant-price.*' => ['required_with:departure-date.*', 'nullable', 'numeric', 'min:0'],

                // * Ảnh chính và ảnh phụ
                'image_url' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],  // Max file size 2MB
                'sub_image_url' => ['nullable', 'array'],
                'sub_image_url.*' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],  // Max file size 2MB for each image

                // * Nổi bật
                'featured' => ['nullable', 'string', 'max:100'],
                'features_start' => ['nullable', 'date', 'after_or_equal:today'],   // Ensure the start date is today or later
                'features_end' => ['nullable', 'date', 'after_or_equal:start_date'],// Ensure the end date is after or equal to the start date
            ],
            [
                'admin_id.required' => 'Bạn chưa chọn đối tác.',
                'admin_id.integer' => 'ID của admin phải là số nguyên.',
                'admin_id.exists' => 'Admin không tồn tại trong hệ thống.',

                'category_id.required' => 'Bạn chưa chọn Danh mục cho tour.',
                'category_id.integer' => 'ID của danh mục phải là số nguyên.',
                'category_id.exists' => 'Danh mục không tồn tại trong hệ thống.',

                // * Tour Information
                'title.required' => 'Tiêu đề tour là bắt buộc.',
                'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',

                'sub_title.required' => 'Tiêu đề phụ là bắt buộc.',
                'sub_title.max' => 'Tiêu đề phụ không được vượt quá :max ký tự.',

                'description.required' => 'Mô tả là bắt buộc.',
                'transport.max' => 'Tên phương tiện không được vượt quá :max ký tự.',
                'duration.max' => 'Thời gian đi không được vượt quá :max ký tự.',

                // * Ngày đi & giá
                'departure-date.array' => 'Ngày đi phải là một mảng.',
                'departure-date.*.date' => 'Mỗi ngày đi phải là một ngày hợp lệ.',
                'departure-date.*.after_or_equal' => 'Ngày đi phải sau hoặc bằng ngày hôm nay.',

                'adult-price.*.required_with' => 'Giá cho người lớn là bắt buộc nếu có ngày khởi hành.',
                'adult-price.*.numeric' => 'Giá người lớn phải là số.',
                'adult-price.*.min' => 'Giá người lớn không thể nhỏ hơn :min.',

                'child-price.*.required_with' => 'Giá cho trẻ em là bắt buộc nếu có ngày khởi hành.',
                'child-price.*.numeric' => 'Giá trẻ em phải là số.',
                'child-price.*.min' => 'Giá trẻ em không thể nhỏ hơn :min.',

                'toddler-price.*.required_with' => 'Giá cho trẻ nhỏ là bắt buộc nếu có ngày khởi hành.',
                'toddler-price.*.numeric' => 'Giá trẻ nhỏ phải là số.',
                'toddler-price.*.min' => 'Giá trẻ nhỏ không thể nhỏ hơn :min.',

                'infant-price.*.required_with' => 'Giá cho trẻ sơ sinh là bắt buộc nếu có ngày khởi hành.',
                'infant-price.*.numeric' => 'Giá trẻ nhỏ phải là số.',
                'infant-price.*.min' => 'Giá trẻ nhỏ không thể nhỏ hơn :min.',


                // * Ảnh
                'image_url.required' => 'Cần thêm ảnh đại diện',
                'image_url.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
                'image_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, png, jpeg, gif, svg.',
                'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',

                'sub_image_url.*.image' => 'Ảnh phụ phải là định dạng hình ảnh.',
                'sub_image_url.*.mimes' => 'Ảnh phụ phải có định dạng: jpg, png, jpeg, gif, svg.',
                'sub_image_url.*.max' => 'Kích thước mỗi ảnh không được vượt quá 2MB.',

                // * Ngày nổi bật

                'features_start.date' => 'Ngày bắt đầu nổi bật phải là ngày hợp lệ.',
                'features_start.after_or_equal' => 'Ngày bắt đầu nổi bật phải sau hoặc bằng hôm nay.',

                'features_end.date' => 'Ngày kết thúc nổi bật phải là ngày hợp lệ.',
                'features_end.after_or_equal' => 'Ngày kết thúc nổi bật phải sau hoặc bằng ngày bắt đầu.',
            ]
        );

        $tour = new Tour();
        $tour->category_id = $validated['category_id'];
        $tour->admin_id = $validated['admin_id'];
        // * tạo tour
        // lấy tên ảnh - tạo tên ảnh mới - lưu vào file public - lưu vào db
        $filename = time() . '_' . $validated['image_url']->getClientOriginalName();
        $validated['image_url']->move('assets/image_tour', $filename); // Di chuyển file vào thư mục public/assets/images
        $tour->image_url = $filename;

        $tour->title = $validated['title'];

        if (!empty($validated['slug'])) {
            $tour->slug = $validated['slug'];
        } else {
            $tour->slug = Str::slug($validated['title']);
        }

        $tour->sub_title = $validated['sub_title'];
        $tour->description = $validated['description'];
        $tour->duration = $validated['duration'] ?? null;
        $tour->transport = $validated['transport'] ?? null;
        //  tạo ẩn hiện dựa trên btn submit
        if ($request->input('action') === 'publish') {
            $tour->is_hidden = 0;
        } elseif ($request->input('action') === 'draft') {
            $tour->is_hidden = 1;
        }
        // nổi bật
        $tour->featured = $validated['featured'] ?? null;
        $tour->featured_start = $validated['featured_start'] ?? null;
        $tour->featured_end = $validated['featured_end'] ?? null;
        $tour->save();


        // * tạo ngày đi (nếu có)
        foreach ($validated['departure-date'] as $key => $date) {
            if ($date!==null) {
                $ngay_di = new NgayDi();
                $ngay_di->tour_id = $tour->id; // id tự động lấy sau khi save()
                $ngay_di->start_date = $date; // dạng datetime
                $ngay_di->price =$validated['adult-price'][$key]; // Giá người lớn
                $ngay_di->price_tre_em =$validated['child-price'][$key]; // Giá người lớn
                $ngay_di->price_tre_nho =$validated['toddler-price'][$key]; // Giá người lớn
                $ngay_di->price_em_be =$validated['infant-price'][$key]; // Giá người lớn
                $ngay_di->save();
            } else {
                continue;
            }
            
        }
        // if (isset($validated['departure-date']) && !empty($validated['departure-date']) && !$validated['departure-date'][0]===null) {
        // }

        // * tạo ảnh (nếu có)
        if (isset($validated['sub_image_url']) && !empty($validated['sub_image_url']) && count($validated['sub_image_url']) > 0) {
            foreach ($validated['sub_image_url'] as $file) {
                if ($file) { // Kiểm tra xem file có tồn tại không
                    // Tạo một tên file duy nhất
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Di chuyển file vào thư mục public/assets/images
                    $file->move('assets/image_tour', $filename);

                    // Tạo bản ghi cho ảnh
                    $image = new Image();
                    $image->tour_id = $tour->id; // ID tour đã lưu
                    $image->name = $filename; // Hoặc bất kỳ tên nào bạn muốn lưu
                    $image->url = $filename; // Lưu đường dẫn của ảnh

                    $image->save(); // Lưu vào cơ sở dữ liệu
                }
            }
        }

        return redirect()->route('admin.tourManagement')->with('success', 'Tour added successfully!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
