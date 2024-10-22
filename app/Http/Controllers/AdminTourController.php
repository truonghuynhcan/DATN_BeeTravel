<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTourController extends Controller
{

    // ! Tạo api lấy danh sách tour
    public function tours($admin_id)
    {
        // Lấy role của admin (chỉ lấy trường cần thiết để tiết kiệm tài nguyên)
        $role = Admin::where('id', $admin_id)->value('role');

        // Kiểm tra role để trả về tours tương ứng
        if ($role == 'admin') {
            // Lấy tất cả tours
            $tours = Tour::select('id', 'image_url', 'title', 'slug', 'admin_id', 'category_id')
                ->with(['admin:id,name', 'category:id,ten_danh_muc', 'ngayDi']) // khi sử dụng with ->luôn có cuột id
                ->get();
        } else {
            // Lấy tour thuộc về đối tác (admin_id)
            $tours = Tour::select('id', 'image_url', 'title', 'slug', 'category_id')
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

    public function tourInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                'admin_id' => ['required','integer', 'exists:admins,id'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                //  * Tour information
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['nullable', 'string', 'max:255'],
                'sub_title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'transport' => ['nullable', 'string', 'max:100'],
                'duration' => ['nullable', 'string', 'max:50'],

                
                // * Ngày đi & giá
                'departure-date' => ['nullable', 'array'],  // ngày khởi hành

                'adult-price' => ['nullable', 'array'], 
                'child-price' => ['nullable', 'array'], 
                'toddler-price' => ['nullable', 'array'], 
                'infant-price' => ['nullable', 'array'],
                
                'departure-date.*' => ['nullable', 'date', 'after_or_equal:today'],  // Ensure the price is a positive number
                'adult-price.*' => ['nullable', 'numeric', 'min:0'],
                'child-price.*' => ['nullable', 'numeric', 'min:0'],
                'toddler-price.*' => ['nullable', 'numeric', 'min:0'],
                'infant-price.*' => ['nullable', 'numeric', 'min:0'],
                
                // * Ảnh chính và ảnh phụ
                'image_url' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],  // Max file size 2MB
                'sub_image_url' => ['nullable', 'array'], 
                'sub_image_url.*' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],  // Max file size 2MB for each image

                // * Nổi bật
                'featured' => ['nullable', 'string','max:100'],
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
                
                'adult-price.*.numeric' => 'Giá người lớn phải là số.',
                'adult-price.*.min' => 'Giá người lớn không thể nhỏ hơn :min.',
                
                'child-price.*.numeric' => 'Giá trẻ em phải là số.',
                'child-price.*.min' => 'Giá trẻ em không thể nhỏ hơn :min.',
                
                'toddler-price.*.numeric' => 'Giá trẻ nhỏ phải là số.',
                'toddler-price.*.min' => 'Giá trẻ nhỏ không thể nhỏ hơn :min.',
                
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
        return redirect()->back()->withInput();

        // Store the validated data into the database
        // You can now safely proceed with saving the tour details into the database
        $tour = new Tour();
        $tour->name = $validated['title'];
        $tour->category_id = $validated['category_id'];
        $tour->start_date = $validated['start_date'];
        $tour->end_date = $validated['end_date'];
        $tour->price = $validated['price'];
        $tour->description = $validated['description'];
        $tour->save();

        // Handle additional features like saving departure dates, prices, images, etc.

        return redirect()->route('admin.tour')->with('success', 'Tour added successfully!');

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
