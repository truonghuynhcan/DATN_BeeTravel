<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNewsController extends Controller
{
    public function news()
    {
        return view('client.tin_tuc_danh_muc');
    }
}
