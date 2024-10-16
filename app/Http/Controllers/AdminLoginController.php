<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // ! ĐĂNG NHẬP
    function login_dl(Request $req)
    {
        $req->validate([
            'name' => 'required|name',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|phone',
        ], [
            'name.required' => 'Vui lòng nhập tên đại lý doanh nghiệp',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập password',
            'phone.required' => 'Vui lòng nhập số điện thoại'
        ]);
        if (Auth::attempt(['name' => $req->name, 'email' => $req->email, 'password' => $req->password, 'phone' => $req->phone])) {
            return redirect('admin');
        } else
            return redirect()->back()->witherrors('Sai email hoặc password đại lý');
    }
    
    // ! ĐĂNG KÝ
    function register_dl(Request $req)
    {
        $req->validate([
            'name' => 'required|name',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|phone',
        ], [
            'name.required' => 'Vui lòng nhập tên đại lý doanh nghiệp',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập password',
            'phone.required' => 'Vui lòng nhập số điện thoại'
        ]);
        if (Auth::attempt(['name' => $req->name, 'email' => $req->email, 'password' => $req->password, 'phone' => $req->phone])) {
            return redirect('admin');
        } else
            return redirect()->back()->witherrors('Sai email hoặc password đại lý');
    }

    // ! LOGOUT
    function logout()
    {
        Auth::logout();
        return redirect()->route('login_dl');
    }
}
