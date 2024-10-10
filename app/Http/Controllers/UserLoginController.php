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
    }
    function logout(){
    Auth::logout();
    return redirect('dang-nhap');
    }
}