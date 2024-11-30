<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserLoginController extends Controller
{
    //
    function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập password'
        ]);
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect('');
        } else
            return redirect()->back()->witherrors('Sai email hoặc password');
    }

    function register(Request $req)
    {
        $req->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|unique:users',
        ], [
            'name.required' => 'Vui lòng nhập tên tài khoản',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email đã được đăng kí',
            'password.required' => 'Vui lòng nhập password',
            'phone.required' => 'Vui lòng nhập số điện thoại',
        ]);
        $user = User::Create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'phone' => $req->phone,
        ]);
        Auth::login($user);
        return redirect()->route('home');
        // Auth::login_dl($user);
        // return redirect('admin');
    }
    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
