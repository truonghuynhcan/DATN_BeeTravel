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
}
