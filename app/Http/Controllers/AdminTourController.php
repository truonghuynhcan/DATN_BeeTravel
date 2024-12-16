<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
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
use Carbon\Carbon; // Đảm bảo import Carbon

class AdminTourController extends Controller
{
<<<<<<<<< Temporary merge branch 1
//     public function showOption()
// {
    
//     $usedFeaturedValues = Tour::pluck('featured')->toArray();

//     return view('admin.tour_insert', compact('usedFeaturedValues'));
// }
    public function tourEdit($tour_id){
=========
    public function filterTours(Request $request)
    {
        // Lấy danh mục
        $categories = Category::all();

        // Lấy các tham số lọc từ request
        $priceRange = $request->price_range;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $location = $request->location;

        // Query cơ bản
        $tours = Tour::query();

        // Lọc theo giá
        if ($priceRange) {
            $prices = explode('-', $priceRange);
            if (isset($prices[1]) && $prices[1] === '') {
                $tours->where('price', '>=', $prices[0]);
            } else {
                $tours->whereBetween('price', [$prices[0], $prices[1]]);
            }
        }

        // Lọc theo ngày
        if ($startDate && $endDate) {
            $tours->whereBetween('featured_start', [$startDate, $endDate]);
        } elseif ($startDate) {
            $tours->where('featured_start', '>=', $startDate);
        } elseif ($endDate) {
            $tours->where('featured_start', '<=', $endDate);
        }

        // Lọc theo danh mục
        if ($location) {
            $tours->where('category_id', $location);
        }

        // Phân trang
        $tours = $tours->paginate(10);
        
        // Trả về view với dữ liệu
        return view('admin.tour', compact('tours', 'categories'));
    }

    public function tourEdit($tour_id)
    {
        $tour = Tour::with(['category', 'ngayDi', 'images', 'admin'])->withCount('wishlist')->find($tour_id);

        if (!$tour) {
            return redirect()->back()->withErrors('Tour not found!');
        }

        return view('admin.tour_edit', compact('tour'));
    }

    public function tourEdit_update(Request $request, $tour_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'admin_id' => 'required|exists:admins,id',
            // * Ngày đi & giá
            'departure-date' => 'required|sometimes|array',  // ngày khởi hành
            'adult-price' => 'required|sometimes|array',
            'child-price' => 'required|sometimes|array',
            'toddler-price' => 'required|sometimes|array',
            'infant-price' => 'required|sometimes|array',

            // 'departure-date.*' => 'required|date|after_or_equal:today', // Không bắt buộc, nhưng nếu có thì phải đúng định dạng ngày
            // Các trường dưới đây sẽ chỉ bắt buộc nếu có departure-date
            'adult-price.*' => 'required_with:departure-date.*| numeric| min:0',
            'child-price.*' => 'required_with:departure-date.*| numeric| min:0',
            'toddler-price.*' => 'required_with:departure-date.*| numeric| min:0',
            'infant-price.*' => 'required_with:departure-date.*| numeric| min:0',

            // * Ảnh chính và ảnh phụ
            'image_url' => ' image| mimes:jpg,png,jpeg,gif,svg| max:2048',  // Max file size 2MB
            'sub_image_url' => 'array',
            'sub_image_url.*' => 'image| mimes:jpg,png,jpeg,gif,svg| max:2048',  // Max file size 2MB for each image
            // 'featured' => 'required|string|max:100',
            // 'features_start' => 'required|date| after_or_equal:today',
            // 'features_end' => 'required|date| after_or_equal:start_date',
        ]);

        $tour = Tour::find($tour_id);
        if (!$tour) {
            return redirect()->back()->withErrors('Tour không tồn tại!');
        }
<<<<<<<<< Temporary merge branch 1
    
        // $tour->title = $request->title;
        // $tour->slug = $request->slug;
=========

        $tour->title = $request->title;
        $tour->slug = $request->slug;
        $tour->category_id = $request->category_id;
        $tour->admin_id = $request->admin_id;

        // * tạo tour
        // lấy tên ảnh - tạo tên ảnh mới - lưu vào file public - lưu vào db
        // $filename = time() . '_' . $request['image_url']->getClientOriginalName();
        // $request['image_url']->move('assets/image_tour', $filename); // Di chuyển file vào thư mục public/assets/images
        // $tour->image_url = $filename;

        $tour->title = $request->title;

        if (!empty($request['slug'])) {
            $tour->slug = $request->slug;
        } else {
            $tour->slug = Str::slug($request->title);
        }

        $tour->sub_title = $request->sub_title;
        $tour->description = $request->description;
        $tour->duration = $request->duration ?? null;
        $tour->transport = $request->transport ?? null;
        //  tạo ẩn hiện dựa trên btn submit
        if ($request->input('action') === 'publish') {
            $tour->is_hidden = 0;
        } elseif ($request->input('action') === 'draft') {
            $tour->is_hidden = 1;
        }
        // nổi bật
        // $tour->featured = $request['featured'] ?? null;
        // $tour->featured_start = $request['featured_start'] ?? null;
        // $tour->featured_end = $request['featured_end'] ?? null;
        $tour->save();


        foreach ($request['departure-date'] as $key => $date) {
            if ($date !== null) {
                // Kiểm tra xem có ID ngày đi hay không
                if (isset($request['ngayDi_id'][$key]) && $request['ngayDi_id'][$key] !== null) {
                    // Sửa bản ghi đã tồn tại
                    $ngay_di = NgayDi::find($request['ngayDi_id'][$key]);
                    if ($ngay_di) { // Nếu tìm thấy bản ghi
                        $ngay_di->start_date = $date; // Cập nhật ngày đi
                        $ngay_di->price = $request['adult-price'][$key]; // Cập nhật giá người lớn
                        $ngay_di->price_tre_em = $request['child-price'][$key]; // Cập nhật giá trẻ em
                        $ngay_di->price_tre_nho = $request['toddler-price'][$key]; // Cập nhật giá trẻ nhỏ
                        $ngay_di->price_em_be = $request['infant-price'][$key]; // Cập nhật giá em bé
                        $ngay_di->save(); // Lưu thay đổi
                    }
                } else {
                    // Thêm mới bản ghi nếu không có ID
                    $ngay_di = new NgayDi();
                    $ngay_di->tour_id = $tour->id; // Lấy ID tour
                    $ngay_di->start_date = $date; // Ngày đi mới
                    $ngay_di->price = $request['adult-price'][$key]; // Giá người lớn
                    $ngay_di->price_tre_em = $request['child-price'][$key]; // Giá trẻ em
                    $ngay_di->price_tre_nho = $request['toddler-price'][$key]; // Giá trẻ nhỏ
                    $ngay_di->price_em_be = $request['infant-price'][$key]; // Giá em bé
                    $ngay_di->save(); // Lưu bản ghi mới
                }
            } else {
                continue; // Bỏ qua nếu ngày đi là null
            }
        }
        // if (isset($request['departure-date']) && !empty($request['departure-date']) && !$request['departure-date'][0]===null) {
        // }

        // * tạo ảnh (nếu có)
        // * Cập nhật ảnh chính (nếu có)
// * Cập nhật ảnh (nếu có)
        if (isset($request['sub_image_url']) && !empty($request['sub_image_url']) && count($request['sub_image_url']) > 0) {
            foreach ($request['sub_image_url'] as $key => $file) {
                // Lấy ID của ảnh hiện tại từ mảng existing_image_id
                $imageId = isset($request['existing_image_id'][$key]) ? $request['existing_image_id'][$key] : null;

                if ($imageId) {
                    // Tìm ảnh hiện tại trong cơ sở dữ liệu
                    $image = Image::find($imageId);
                    if ($image) {
                        // Xóa file cũ nếu có
                        $oldFilePath = public_path('assets/image_tour/' . $image->url);
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath); // Xóa file cũ
                        }

                        // Cập nhật ảnh mới
                        if ($file) { // Kiểm tra xem file có tồn tại không
                            // Tạo một tên file duy nhất
                            $filename = time() . '_' . $file->getClientOriginalName();

                            // Di chuyển file vào thư mục public/assets/image_tour
                            $file->move('assets/image_tour', $filename);

                            // Cập nhật thông tin ảnh
                            $image->name = $filename; // Hoặc bất kỳ tên nào bạn muốn lưu
                            $image->url = $filename; // Cập nhật đường dẫn của ảnh

                            $image->save(); // Lưu vào cơ sở dữ liệu
                        }
                    }
                }
            }
        }
        // $tour->featured = $request->features;
        // $tour->features_start = $request->features_start;
        // $tour->features_end = $request->features_end;
        // $tour->save();
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
        $category_tour = Category::withCount('tours')->get();
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách danh mục thành công!',
            'data' => $category_tour,
        ], 200);
    }

    public function catetourEdit($catetour_id)
    {
        $category_tour = Category::with(['tours'])->find($catetour_id);
        if (!$category_tour) {
            return redirect()->back()->withErrors('Category tour not found!');
        }
        return view('admin.catetour_edit', compact('category_tour'));
    }

    public function catetourEdit_update(Request $request, $catetour_id)
    {
        $request->validate([
            'ten_danh_muc' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'tour_nuoc_ngoai' => ['required', 'string', 'max:255'],
        ]);

        $catetour_id = Category::find($catetour_id);
        if (!$catetour_id) {
            return redirect()->back()->withErrors('Category tour không tồn tại!');
        }

        $catetour_id->ten_danh_muc = $request->ten_danh_muc;
        $catetour_id->slug = $request->slug;
        $catetour_id->tour_nuoc_ngoai = $request->tour_nuoc_ngoai;
        $catetour_id->save();
        return redirect()->route('admin.CateToursManagement')->with('success', 'Cập nhật category tour thành công!');
    }
    public function catetourInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                //  * Provider information
                'ten_danh_muc' => ['required', 'string', 'max:255'],
                'slug' => ['nullable', 'string', 'max:255'],
                'tour_nuoc_ngoai' => ['required', 'string', 'max:255'],
            ],
            [
                // 'admin_id.required' => 'Bạn chưa chọn đối tác.',
                // 'admin_id.integer' => 'ID của admin phải là số nguyên.',
                // 'admin_id.exists' => 'Admin không tồn tại trong hệ thống.',

                // 'category_id.required' => 'Bạn chưa chọn Danh mục cho tin tức .',
                // 'category_id.integer' => 'ID của danh mục phải là số nguyên.',
                // 'category_id.exists' => 'Danh mục không tồn tại trong hệ thống.',

                // * Provider Information
                'ten_danh_muc.required' => 'Tên danh mục tour là bắt buộc.',
                'ten_danh_muc.max' => 'Tên danh mục tour không được vượt quá :max ký tự.',

                'tour_nuoc_ngoai.required' => 'Loại tour là bắt buộc phải điền.',


                // * Ảnh
                // 'image_url.required' => 'Cần thêm ảnh đại diện',
                // 'image_url.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
                // 'image_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, png, jpeg, gif, svg.',
                // 'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',

            ]
        );

        $catetour = new Category();
        $catetour->ten_danh_muc = $validated['ten_danh_muc'];

        if (!empty($validated['slug'])) {
            $catetour->slug = $validated['slug'];
        } else {
            $catetour->slug = Str::slug($validated['ten_danh_muc']);
        }
        $catetour->tour_nuoc_ngoai = $validated['tour_nuoc_ngoai'];
        $catetour->save();



        // if (isset($validated['departure-date']) && !empty($validated['departure-date']) && !$validated['departure-date'][0]===null) {
        // }
        return redirect()->route('admin.CateToursManagement')->with('success', 'Category tours added successfully!');
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
                ->with(['admin:id,name', 'category:id,ten_danh_muc', 'ngayDi']) // khi sử dụng with ->luôn có cột id
                ->get();
        } else {
            // Lấy tour thuộc về đối tác (admin_id)
            $tours = Tour::select('id', 'image_url', 'title', 'slug', 'is_hidden', 'category_id')
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


    // ! Thêm tour
    // ! Thêm tour
    // ! Thêm tour
//     public function createOption()
// {
//     // Lấy danh sách các giá trị 'featured' đã có
//     $usedFeaturedValues = Tour::pluck('featured')->toArray();

    //     return view('admin.tour_insert', compact('usedFeaturedValues'));
// }
    public function tourInsert_(Request $request)
    {
        // Kiểm tra xem yêu cầu là GET hay POST
        // Lấy danh sách các giá trị 'featured' đã có
        // $usedFeaturedValues = Tour::pluck('featured')->toArray();

        // if ($request->isMethod('post')) {
        // $usedFeaturedValues = Tour::pluck('featured')->toArray();
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
                'featured.not_in' => 'Giá trị đã chọn cho trường nổi bật đã tồn tại.',
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
        // Chuyển đổi sang datetime với kiểm tra tồn tại
//     $tour->featured_start = array_key_exists('featured_start', $validated) && $validated['featured_start']
//     ? Carbon::createFromFormat('Y-m-d', $validated['featured_start']) : null;

        // $tour->featured_end = array_key_exists('featured_end', $validated) && $validated['featured_end']
//     ? Carbon::createFromFormat('Y-m-d', $validated['featured_end']) : null;
        // Lưu giá trị vào các trường dữ liệu
        $tour->featured_start = array_key_exists('featured_start', $validated) && $validated['featured_start'] ? Carbon::createFromFormat('Y-m-d\TH:i', $validated['featured_start']) : null;
        $tour->featured_end = array_key_exists('featured_end', $validated) && $validated['featured_end'] ? Carbon::createFromFormat('Y-m-d\TH:i', $validated['featured_end']) : null;
        // $tour->featured_start = $validated['featured_start'] ?? null;
        // $tour->featured_end = $validated['featured_end'] ?? null;
        $tour->save();


        // * tạo ngày đi (nếu có)
        foreach ($validated['departure-date'] as $key => $date) {
            if ($date !== null) {
                $ngay_di = new NgayDi();
                $ngay_di->tour_id = $tour->id; // id tự động lấy sau khi save()
                $ngay_di->start_date = $date; // dạng datetime
                $ngay_di->price = $validated['adult-price'][$key]; // Giá người lớn
                $ngay_di->price_tre_em = $validated['child-price'][$key]; // Giá người lớn
                $ngay_di->price_tre_nho = $validated['toddler-price'][$key]; // Giá người lớn
                $ngay_di->price_em_be = $validated['infant-price'][$key]; // Giá người lớn
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
    // Trả về view khi yêu cầu là GET
    // return view('admin.tour_insert', compact('usedFeaturedValues'));
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Lấy tất cả tour không có bản ghi booking liên quan
        // $tours = Tour::doesntHave('category', 'ngayDi', 'images', 'Admin')->get(); // Thay 'bookings' bằng mối quan hệ thật sự

        // return view('admin.CateToursManagement', compact('tours'));
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
    public function destroy($id)
    {
        // $tour = Tour::find($id);

        // if (!$tour) {
        //     return redirect()->back()->withErrors('Tour không tồn tại!');
        // }

        // // Kiểm tra nếu có bản ghi nào tham chiếu đến tin tức này qua Admin
        // // và Comments (hoặc bất kỳ mối quan hệ nào khác mà bạn có)
        // $hasAdmin = $tour->admin()->exists(); // Kiểm tra mối quan hệ với Admin
        // $hasCate = $tour->category()->exists(); // Kiểm tra mối quan hệ với Comments
        // $hasngayDi = $tour->ngayDi()->exists(); // Kiểm tra mối quan hệ với Comments
        // $hasimages = $tour->images()->exists(); // Kiểm tra mối quan hệ với Comments
        // if ($hasAdmin || $hasCate || $hasngayDi || $hasimages) {
        //     return redirect()->back()->withErrors('Không thể xóa tin tức có liên quan!');
        // }

        // // Xóa tour nếu không có bản ghi nào tham chiếu
        // $tour->delete();

        // return redirect()->route('admin.tourManagement')->with('success', 'Xóa tour thành công!');
    }
}
