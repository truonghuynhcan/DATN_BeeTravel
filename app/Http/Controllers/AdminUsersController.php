<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\NgayDi;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Number;


class AdminUsersController extends Controller
{
    public function getAdmins(Request $request) {
        $roles = $request->query('roles'); // Lấy vai trò từ tham số truy vấn
        $rolesArray = explode(',', $roles); // Chuyển đổi chuỗi thành mảng
    
        // Lấy danh sách người dùng theo các vai trò được chỉ định
        $admins = Admin::whereIn('role', $rolesArray)->get();
    
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách người dùng thành công!',
            'data' => $admins,
        ], 200);
    }
    public function getAdminEdit($getAdmin_id){
        $getAdmin = Admin::with(['news','tours','voucher'])->find($getAdmin_id);
        if (!$getAdmin) {
            return redirect()->back()->withErrors('Pending new not found!');
        }
        return view('admin.user_pending_edit', compact('getAdmin'));
    }
    
    public function getAdminEdit_update(Request $request,$getAdmin_id){
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            //         'email' => ['required', 'string', 'max:255'],
            //         'password' => ['required', 'string', 'max:255'],
            //         'phone' => ['required', 'string', 'max:255'],
                    'role' => ['required', 'string','max:255'],
        ]);
    
        $getAdmin = Admin::find($getAdmin_id);
        if (!$getAdmin) {
            return redirect()->back()->withErrors('Pending không tồn tại!');
        }
        $getAdmin->name = $request->name;
            $getAdmin->phone = $request->phone;
            $getAdmin->password = Hash::make($request->password);
            $getAdmin->email = $request->email;
            $getAdmin->role = $request->role;
        $getAdmin->save();
        return redirect()->route('admin.usersManagement')->with('success', 'Cập nhật trạng thái thành công!');
    }
    // public function getAdmins(Request $request) {
    //     // Chỉ lấy danh sách người dùng có vai trò 'pending'
    //     $admins = Admin::where('role', 'pending')->get();
    
    //     // Trả về kết quả
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Lấy danh sách người dùng thành công!',
    //         'data' => $admins,
    //     ], 200);
    // }
    public function getAllUsers() {
        // Lấy tất cả người dùng từ bảng users
        $users = User::all(); // Hoặc bạn có thể thêm điều kiện nếu cần
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách người dùng thành công!',
            'data' => $users,
        ], 200);
    }
    public function getAllPersons() {
        // Lấy tất cả người dùng từ bảng users
        $persons = User::all();
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách người dùng thành công!',
            'data' => $persons,
        ], 200);
    }
    public function getProviders(Request $request) {
        $role = $request->query('role'); // Lấy vai trò từ tham số truy vấn
    
        // Kiểm tra vai trò và lấy danh sách người dùng tương ứng
        if ($role === 'admin') {
            $admins = Admin::where('role', 'admin')->get();
        } elseif ($role === 'provider') {
            $admins = Admin::where('role', 'provider')->get();
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Vai trò không hợp lệ!',
            ], 400); // 400 Bad Request
        }
    
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách người dùng thành công!',
            'data' => $admins,
        ], 200);
    }

    public function getAdminUsers(Request $request) {
        $role = $request->query('role'); // Lấy vai trò từ tham số truy vấn
    
        // Kiểm tra vai trò và lấy danh sách người dùng tương ứng
        if ($role === 'admin') {
            $adminusers = Admin::where('role', 'admin')->get();
        } elseif ($role === 'provider') {
            $adminusers = Admin::where('role', 'provider')->get();
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Vai trò không hợp lệ!',
            ], 400); // 400 Bad Request
        }
    
        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách người dùng thành công!',
            'data' => $adminusers,
        ], 200);
    }

    public function providerInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                //  * Provider information
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'role' => ['required', 'string','max:255'],
            ],
            [
                // 'admin_id.required' => 'Bạn chưa chọn đối tác.',
                // 'admin_id.integer' => 'ID của admin phải là số nguyên.',
                // 'admin_id.exists' => 'Admin không tồn tại trong hệ thống.',

                // 'category_id.required' => 'Bạn chưa chọn Danh mục cho tin tức .',
                // 'category_id.integer' => 'ID của danh mục phải là số nguyên.',
                // 'category_id.exists' => 'Danh mục không tồn tại trong hệ thống.',

                // * Provider Information
                'name.required' => 'Tên đối tác là bắt buộc.',
                'name.max' => 'Tên đối tác không được vượt quá :max ký tự.',

                'role.required' => 'Quyền đối tác là bắt buộc.',
                'role.max' => 'Quyền đối tác không được vượt quá :max ký tự.',

                'email.required' => 'Email chi tiết là bắt buộc phải điền.',
                'phone.required' => 'Số điện thoại là bắt buộc phải điền.',
                'password.required' => 'Mật khẩu là bắt buộc phải điền.',


                // * Ảnh
                // 'image_url.required' => 'Cần thêm ảnh đại diện',
                // 'image_url.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
                // 'image_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, png, jpeg, gif, svg.',
                // 'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',

            ]
        );

        $providers = new Admin();
        $providers->name = $validated['name'];
        $providers->phone = $validated['phone'];
        $providers->password = Hash::make($request->password);
        $providers->email = $validated['email'];
        $providers->role = 'provider';
        $providers->save();


        
        // if (isset($validated['departure-date']) && !empty($validated['departure-date']) && !$validated['departure-date'][0]===null) {
        // }

        return redirect()->route('admin.providesManagement')->with('success', 'Provider added successfully!');
    }

public function providerEdit($provider_id){
    $providers = Admin::with(['news','tours','voucher'])->find($provider_id);
    if (!$providers) {
        return redirect()->back()->withErrors('Provider new not found!');
    }
    return view('admin.provider_edit', compact('providers'));
}

public function providerEdit_update(Request $request,$provider_id){
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'role' => ['required', 'string','max:255'],
    ]);

    $providers = Admin::find($provider_id);
    if (!$providers) {
        return redirect()->back()->withErrors('Provider new không tồn tại!');
    }
    $providers->name = $request->name;
        $providers->phone = $request->phone;
        $providers->password = Hash::make($request->password);
        $providers->email = $request->email;
        $providers->role = 'provider';
    $providers->save();
    return redirect()->route('admin.providesManagement')->with('success', 'Cập nhật provider thành công!');
}
    public function adminInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                //  * Provider information
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'role' => ['required', 'string','max:255'],
            ],
            [
                // 'admin_id.required' => 'Bạn chưa chọn đối tác.',
                // 'admin_id.integer' => 'ID của admin phải là số nguyên.',
                // 'admin_id.exists' => 'Admin không tồn tại trong hệ thống.',

                // 'category_id.required' => 'Bạn chưa chọn Danh mục cho tin tức .',
                // 'category_id.integer' => 'ID của danh mục phải là số nguyên.',
                // 'category_id.exists' => 'Danh mục không tồn tại trong hệ thống.',

                // * Provider Information
                'name.required' => 'Tên đối tác là bắt buộc.',
                'name.max' => 'Tên đối tác không được vượt quá :max ký tự.',

                'role.required' => 'Quyền đối tác là bắt buộc.',
                'role.max' => 'Quyền đối tác không được vượt quá :max ký tự.',

                'email.required' => 'Email chi tiết là bắt buộc phải điền.',
                'phone.required' => 'Số điện thoại là bắt buộc phải điền.',
                'password.required' => 'Mật khẩu là bắt buộc phải điền.',


                // * Ảnh
                // 'image_url.required' => 'Cần thêm ảnh đại diện',
                // 'image_url.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
                // 'image_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, png, jpeg, gif, svg.',
                // 'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',

            ]
        );

        $adminusers = new Admin();
        $adminusers->name = $validated['name'];
        $adminusers->phone = $validated['phone'];
        $adminusers->password = Hash::make($request->password);
        $adminusers->email = $validated['email'];
        $adminusers->role = 'admin';
        $adminusers->save();


        
        // if (isset($validated['departure-date']) && !empty($validated['departure-date']) && !$validated['departure-date'][0]===null) {
        // }

        return redirect()->route('admin.adminusersManagement')->with('success', 'Admins added successfully!');
    }

    public function personInsert_(Request $request)
    {
        $validated = $request->validate(
            [
                //  * Provider information
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string','max:255'],
            ],
            [
                // 'admin_id.required' => 'Bạn chưa chọn đối tác.',
                // 'admin_id.integer' => 'ID của admin phải là số nguyên.',
                // 'admin_id.exists' => 'Admin không tồn tại trong hệ thống.',

                // 'category_id.required' => 'Bạn chưa chọn Danh mục cho tin tức .',
                // 'category_id.integer' => 'ID của danh mục phải là số nguyên.',
                // 'category_id.exists' => 'Danh mục không tồn tại trong hệ thống.',

                // * Provider Information
                'name.required' => 'Tên đối tác là bắt buộc.',
                'name.max' => 'Tên đối tác không được vượt quá :max ký tự.',

                'address.required' => 'Địa chỉ khách hàng là bắt buộc.',
                'address.max' => 'Địa chỉ khách hàng không được vượt quá :max ký tự.',

                'email.required' => 'Email chi tiết là bắt buộc phải điền.',
                'phone.required' => 'Số điện thoại là bắt buộc phải điền.',
                'password.required' => 'Mật khẩu là bắt buộc phải điền.',


                // * Ảnh
                // 'image_url.required' => 'Cần thêm ảnh đại diện',
                // 'image_url.image' => 'Ảnh đại diện phải là định dạng hình ảnh.',
                // 'image_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, png, jpeg, gif, svg.',
                // 'image_url.max' => 'Kích thước ảnh không được vượt quá 2MB.',

            ]
        );

        $persons = new User();
        $persons->name = $validated['name'];
        $persons->phone = $validated['phone'];
        $persons->address = $validated['address'];
        $persons->password = Hash::make($request->password);
        $persons->email = $validated['email'];
        $persons->save();


        
        // if (isset($validated['departure-date']) && !empty($validated['departure-date']) && !$validated['departure-date'][0]===null) {
        // }

        return redirect()->route('admin.personsManagement')->with('success', 'Person added successfully!');
    }
    public function personEdit($person_id){
        $persons = User::with(['order','wishlist','feedback','notifications'])->find($person_id);
        if (!$persons) {
            return redirect()->back()->withErrors('Person not found!');
        }
        return view('admin.person_edit', compact('persons'));
    }
    
    public function personEdit_update(Request $request,$person_id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string','max:255'],
        ]);
    
        $persons = User::find($person_id);
        if (!$persons) {
            return redirect()->back()->withErrors('Person new không tồn tại!');
        }
        $persons->name = $request->name;
            $persons->phone = $request->phone;
            $persons->password = Hash::make($request->password);
            $persons->email = $request->email;
            $persons->address = $request->address;
        $persons->save();
        return redirect()->route('admin.personsManagement')->with('success', 'Cập nhật person thành công!');
    }

    public function adminEdit($admin_id){
        $adminusers = Admin::with(['news','tours','voucher'])->find($admin_id);
        if (!$adminusers) {
            return redirect()->back()->withErrors('Admin new not found!');
        }
        return view('admin.admin_edit', compact('adminusers'));
    }
    
    public function adminEdit_update(Request $request,$admin_id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255'],
                    'role' => ['required', 'string','max:255'],
        ]);
    
        $adminusers = Admin::find($admin_id);
        if (!$adminusers) {
            return redirect()->back()->withErrors('Admin không tồn tại!');
        }
        $adminusers->name = $request->name;
            $adminusers->phone = $request->phone;
            $adminusers->password = Hash::make($request->password);
            $adminusers->email = $request->email;
            $adminusers->role = 'admin';
        $adminusers->save();
        return redirect()->route('admin.adminusersManagement')->with('success', 'Cập nhật admin thành công!');
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
