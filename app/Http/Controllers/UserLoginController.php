<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserLoginController extends Controller
{
//
function login(Request $req){
$req->validate([
'email'=>'required|email',
'password'=>'required'
],[
'email.required'=>'Vui lòng nhập email',
'email.email'=>'Vui lòng nhập đúng định dạng email',
'password.required'=>'Vui lòng nhập password'
]);
if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
    return redirect('admin');
    }else return redirect()->back()->witherrors('Sai email hoặc password');
    }
    function login_dl(Request $req){
        $req->validate([
           'name'=>'required|name', 
        'email'=>'required|email',
        'password'=>'required',
        'phone'=>'required|phone',
        ],[
            'name.required'=>'Vui lòng nhập tên đại lý doanh nghiệp',
        'email.required'=>'Vui lòng nhập email',
        'email.email'=>'Vui lòng nhập đúng định dạng email',
        'password.required'=>'Vui lòng nhập password',
        'phone.required'=>'Vui lòng nhập số điện thoại'
        ]);
        if(Auth::attempt(['name' => $req->name,'email' => $req->email, 'password' => $req->password,'phone' => $req->phone])){
            return redirect('admin');
            }else return redirect()->back()->witherrors('Sai email hoặc password đại lý');
            }
    function register(Request $req){
    $req->validate([
    'name'=>'required|unique:users',
    'email'=>'required|email|unique:users',
    'password'=>'required|min:8',
    
    ],[
    'email.required'=>'Vui lòng nhập email',
    'email.email'=>'Vui lòng nhập đúng định dạng email',
    'email.unique'=>'Email đã được đăng kí',
    'password.required'=>'Vui lòng nhập password',
    
    ]);
    $user=User::Create([
    'name'=>$req->name,
    'email'=>$req->email,
    'password'=>bcrypt($req->password),
    ]);
    Auth::login($user);
    return redirect('admin');
    // Auth::login_dl($user);
    // return redirect('admin');
    }
        function logout(){
    Auth::logout();
    return redirect('dang-nhap');
    }
}
