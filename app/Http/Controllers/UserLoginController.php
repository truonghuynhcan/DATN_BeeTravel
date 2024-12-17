<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuiEmail;
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
        request()->session()->invalidate(); // Huỷ session hiện tại
        request()->session()->regenerateToken(); // Tạo token mới cho bảo mật
        return redirect()->route('login');
    }
    //quên Mật Khẩu
public function viewforgotpassword(){
      
                 
    return view('client.forgotpassword');
}
public function forgotpassword(Request $request){
    $user = User::where('email', $request->email)->first();
    $userId = $user->id;//lấy id
   
    $currentTime = time(); // Lấy thời gian hiện tại theo giây
   
    $currentSecond = $currentTime % 60; // Tính giây hiện tại
    $resetCode = $userId . $currentSecond .Str::random(6);

$request->session()->put('password_reset_code', $resetCode);




if ($user) {
$user->maxn = $request->session()->get('password_reset_code');
$user->save();
Mail::to($request->email)->send(new GuiEmail());



return redirect()->route('insertcode');
} else {
return back()->withErrors(['email' => 'Email không tồn tại']);
}

}
public function viewinsertcode(){

    return view('client.insertcode');
}
public function insertcode(Request $request){
    $user = User::where('maxn', $request->ma)->first();
if ($user) {
$user->password = Hash::make($request->password);
$user->save();
User::where('id',$user->id)->update([
    'password' => $user->password
]);


return redirect()->route('login_loading');
} else {
return back()->withErrors(['ma' => 'ma sai']);
}

}
}
