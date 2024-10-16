<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function home()
    {
        return view('client.home');
    }
    public function about()
    {
        return view('client.gioi_thieu');
    }
    public function contact()
    {
        return view('client.lien_he');
    }
    public function register()
    {
        return view('client.dang_ky');
    }
    public function login()
    {
        return view('client.dang_nhap');    
    }


    public function login_dl()
    {
        return view('client.dang_nhap_dl');    
    }
    // public function admin()
    // {
    //     return view('client.admin');    
    // }
}
