<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    // ! ĐĂNG NHẬP
    function login_admin_(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập password'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password])) {
            $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng từ bảng admins

            // Kiểm tra role của admin
            if ($user->role == 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role == 'provider') {
                return redirect(''); // Ví dụ trang dashboard của provider
            } elseif ($user->role == 'pending') {
                Auth::guard('admin')->logout(); // Đăng xuất admin vì đang chờ xác nhận
                return redirect()->back()->withErrors('Tài khoản của bạn đang chờ xác nhận');
            }
        } else {
            return redirect()->back()->withErrors('Email hoặc password chưa đúng');
        }
    }


    // ! ĐĂNG KÝ
    function register_admin_(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
            'name' => 'required',
            'phone' => 'required|digits:10',
        ], [
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'name.required' => 'Tên là bắt buộc',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'phone.digits' => 'Số điện thoại phải có 10 chữ số',
        ]);

        // Tạo admin mới
        $admin = new Admin();
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->role = 'pending'; // Tài khoản mới sẽ là pending để chờ xác nhận
        $admin->save();

        return redirect()->route('register_admin')->with('success', 'Đăng ký thành công, tài khoản đang chờ xác nhận.');
    }

    // ! LOGOUT
    function logout()
    {
        Auth::logout();
        return redirect()->route('login_dl');
    }
}
