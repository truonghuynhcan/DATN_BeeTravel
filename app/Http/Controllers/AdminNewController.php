<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Image;

use App\Models\NgayDi;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Number;


class AdminNewController extends Controller
{
    public function newEdit($new_id){
        $news = News::with(['Admin', 'NewsCategory'])->find($new_id);
        if (!$news) {
            return redirect()->back()->withErrors('New not found!');
        }
        return view('admin.new_edit', compact('news'));
    }
    
    public function newEdit_update(Request $request,$new_id){
        // return redirect()->back();
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:news_categories,id',
            'admin_id' => 'required|exists:admins,id',
            // * Ảnh chính và ảnh phụ
            'image_url' => ' image| mimes:jpg,png,jpeg,gif,svg| max:2048',  // Max file size 2MB
            'sub_image_url' => 'array',
            'sub_image_url.*' => 'image| mimes:jpg,png,jpeg,gif,svg| max:2048',  // Max file size 2MB for each image
        ]);
    
        $news = News::find($new_id);
        if (!$news) {
            return redirect()->back()->withErrors('Tin tức không tồn tại!');
        }
        // Kiểm tra nếu có hình ảnh mới
    if ($request->hasFile('image_url')) {
        // Xóa hình ảnh cũ nếu có
        if ($news->image_url) {
            $oldImagePath = public_path('assets/image_new/' . $news->image_url);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Xóa tệp hình ảnh cũ
            }
        }

        // Tạo tên file mới và di chuyển
        $filename = time() . '_' . $request['image_url']->getClientOriginalName();
        $request['image_url']->move('assets/image_new', $filename);
        
        // Cập nhật đường dẫn hình ảnh vào cơ sở dữ liệu
        $news->image_url = $filename;
    } else {
        // Nếu không có hình ảnh mới, giữ nguyên hình ảnh cũ
        $news->image_url = $news->image_url; // Không cần thay đổi gì
    }
    
        $news->title = $request->title;
        $news->content = $request->content;
        $news->category_id = $request->category_id;
        $news->admin_id = $request->admin_id;
        $news->save();
        return redirect()->route('admin.newsManagement')->with('success', 'Cập nhật tin tức thành công!');
    }

    // ! Tạo api lấy danh sách tour
    // ! Tạo api lấy danh sách tour
    // ! Tạo api lấy danh sách tour
    
    public function news($admin_id)
    {
        // Lấy role của admin (chỉ lấy trường cần thiết để tiết kiệm tài nguyên)
        $role = Admin::where('id', $admin_id)->value('role');

        // Kiểm tra role để trả về tours tương ứng
        if ($role == 'admin') {
            // Lấy tất cả news
            $news = News::select('id', 'image_url', 'title', 'slug','description','content', 'is_hidden', 'admin_id', 'category_id')
                ->with(['Admin:id,name', 'NewsCategory:id,title']) // khi sử dụng with ->luôn có cột id
                ->orderBy('created_at', 'desc') // Sắp xếp theo ngày đăng mới nhất
                ->get();
        } else {
            // Lấy tour thuộc về đối tác (admin_id)
            $news = News::select('id', 'image_url', 'title', 'slug','description','content',  'is_hidden', 'category_id')
                ->with(['NewsCategory',])
                ->orderBy('created_at', 'desc') // Sắp xếp theo ngày đăng mới nhất
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

    public function category_new()
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
        $category_new = NewsCategory::all(); // Hoặc bạn có thể thêm điều kiện nếu cần
        // $category_new = NewsCategory::withCount('news')->get();
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách danh mục thành công!',
            'data' => $category_new,
        ], 200);
    
}

public function catenewEdit($catenew_id){
    $category_new = NewsCategory::with(['news'])->find($catenew_id);
    if (!$category_new) {
        return redirect()->back()->withErrors('Category new not found!');
    }
    return view('admin.catenew_edit', compact('category_new'));
}

public function catenewEdit_update(Request $request,$catenew_id){
    $request->validate([
        'title' => ['required', 'string', 'max:255'],
                'slug' => ['nullable', 'string', 'max:255'],
                // * Ảnh chính và ảnh phụ
            'image_url' => ' image| mimes:jpg,png,jpeg,gif,svg| max:2048',  // Max file size 2MB
    ]);

    $catenew_id = NewsCategory::find($catenew_id);
    if (!$catenew_id) {
        return redirect()->back()->withErrors('Category new không tồn tại!');
    }
    // Kiểm tra nếu có hình ảnh mới
    if ($request->hasFile('image_url')) {
        // Xóa hình ảnh cũ nếu có
        if ($catenew_id->image_url) {
            $oldImagePath = public_path('assets/image_new/' . $catenew_id->image_url);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Xóa tệp hình ảnh cũ
            }
        }

        // Tạo tên file mới và di chuyển
        $filename = time() . '_' . $request['image_url']->getClientOriginalName();
        $request['image_url']->move('assets/image_new', $filename);
        
        // Cập nhật đường dẫn hình ảnh vào cơ sở dữ liệu
        $catenew_id->image_url = $filename;
    } else {
        // Nếu không có hình ảnh mới, giữ nguyên hình ảnh cũ
        $catenew_id->image_url = $catenew_id->image_url; // Không cần thay đổi gì
    }

    $catenew_id->title = $request->title;
    $catenew_id->slug = $request->slug;
    $catenew_id->save();
    return redirect()->route('admin.CateNewsManagement')->with('success', 'Cập nhật category new thành công!');
}

public function catenewInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                //  * Provider information
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['nullable', 'string', 'max:255'],
                // * Ảnh chính và ảnh phụ
                'image_url' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],  // Max file size 2MB
                'sub_image_url' => ['nullable', 'array'],
            ],
            [
                // 'admin_id.required' => 'Bạn chưa chọn đối tác.',
                // 'admin_id.integer' => 'ID của admin phải là số nguyên.',
                // 'admin_id.exists' => 'Admin không tồn tại trong hệ thống.',

                // 'category_id.required' => 'Bạn chưa chọn Danh mục cho tin tức .',
                // 'category_id.integer' => 'ID của danh mục phải là số nguyên.',
                // 'category_id.exists' => 'Danh mục không tồn tại trong hệ thống.',

                // * Provider Information
                'title.required' => 'Tên danh mục tin tức là bắt buộc.',
                'title.max' => 'Tên danh mục tin tức không được vượt quá :max ký tự.',

                // 'tour_nuoc_ngoai.required' => 'Loại tour là bắt buộc phải điền.',


                // * Ảnh
                'image_url.required' => 'Cần thêm ảnh đại diện',
                'image_url.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
                'image_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, png, jpeg, gif, svg.',
                'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',
            ]
        );

        $catenew = new NewsCategory();
        $catenew->title = $validated['title'];
        // lấy tên ảnh - tạo tên ảnh mới - lưu vào file public - lưu vào db
        $filename = time() . '_' . $validated['image_url']->getClientOriginalName();
        $validated['image_url']->move('assets/image_new', $filename); // Di chuyển file vào thư mục public/assets/images
        $catenew->image_url = $filename;

        if (!empty($validated['slug'])) {
            $catenew->slug = $validated['slug'];
        } else {
            $catenew->slug = Str::slug($validated['ten_danh_muc']);
        }
        // $catenew->tour_nuoc_ngoai = $validated['tour_nuoc_ngoai'];
        $catenew->save();


        
        // if (isset($validated['departure-date']) && !empty($validated['departure-date']) && !$validated['departure-date'][0]===null) {
        // }
        return redirect()->route('admin.CateNewsManagement')->with('success', 'Category news added successfully!');
    }


    // ! Thêm tour
    // ! Thêm tour
    // ! Thêm tour
    public function newInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                'admin_id' => ['required', 'integer', 'exists:admins,id'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                //  * Tour information
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['nullable', 'string', 'max:255'],
                'content' => ['required', 'string'],
                'description' => ['required', 'string','max:255'],
                'reading' => ['nullable', 'string', 'max:100'],
                // * Ảnh chính và ảnh phụ
                'image_url' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],  // Max file size 2MB
                'sub_image_url' => ['nullable', 'array'],
            ],
            [
                'admin_id.required' => 'Bạn chưa chọn đối tác.',
                'admin_id.integer' => 'ID của admin phải là số nguyên.',
                'admin_id.exists' => 'Admin không tồn tại trong hệ thống.',

                'category_id.required' => 'Bạn chưa chọn Danh mục cho tin tức .',
                'category_id.integer' => 'ID của danh mục phải là số nguyên.',
                'category_id.exists' => 'Danh mục không tồn tại trong hệ thống.',

                // * Tour Information
                'title.required' => 'Tiêu đề tin tức về tour là bắt buộc.',
                'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',

                'description.required' => 'Mô tả ngắn là bắt buộc.',
                'description.max' => 'Tiêu đề phụ không được vượt quá :max ký tự.',

                'content.required' => 'Mô tả chi tiết là bắt buộc phải điền.',
                'reading.not_in' => 'Giá trị đã chọn cho trường nổi bật đã tồn tại.',

                // * Ảnh
                'image_url.required' => 'Cần thêm ảnh đại diện',
                'image_url.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
                'image_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, png, jpeg, gif, svg.',
                'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',

            ]
        );

        $news = new News();
        $news->category_id = $validated['category_id'];
        $news->admin_id = $validated['admin_id'];
        // * tạo new
        // lấy tên ảnh - tạo tên ảnh mới - lưu vào file public - lưu vào db
        $filename = time() . '_' . $validated['image_url']->getClientOriginalName();
        $validated['image_url']->move('assets/image_new', $filename); // Di chuyển file vào thư mục public/assets/images
        $news->image_url = $filename;

        $news->title = $validated['title'];

        if (!empty($validated['slug'])) {
            $news->slug = $validated['slug'];
        } else {
            $news->slug = Str::slug($validated['title']);
        }
        $news->reading = $validated['reading'] ?? null;
        $news->description = $validated['description'];
        $news->content = $validated['content'];
        //  tạo ẩn hiện dựa trên btn submit
        if ($request->input('action') === 'publish') {
            $news->is_hidden = 0;
        } elseif ($request->input('action') === 'draft') {
            $news->is_hidden = 1;
        }
        $news->save();


        
        // if (isset($validated['departure-date']) && !empty($validated['departure-date']) && !$validated['departure-date'][0]===null) {
        // }

        // * tạo ảnh (nếu có)
        if (isset($validated['sub_image_url']) && !empty($validated['sub_image_url']) && count($validated['sub_image_url']) > 0) {
            foreach ($validated['sub_image_url'] as $file) {
                if ($file) { // Kiểm tra xem file có tồn tại không
                    // Tạo một tên file duy nhất
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Di chuyển file vào thư mục public/assets/images
                    $file->move('assets/image_new', $filename);

                    // Tạo bản ghi cho ảnh
                    $image = new Image();
                    $image->new_id = $news->id; // ID tour đã lưu
                    $image->name = $filename; // Hoặc bất kỳ tên nào bạn muốn lưu
                    $image->url = $filename; // Lưu đường dẫn của ảnh

                    $image->save(); // Lưu vào cơ sở dữ liệu
                }
            }
        }

        return redirect()->route('admin.newsManagement')->with('success', 'New added successfully!');
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
    public function destroy($id)
{
    //
}
}
