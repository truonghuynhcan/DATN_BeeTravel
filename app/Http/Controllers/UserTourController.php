<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTourController extends Controller
{
    
    public function chitiet($slug)
    {
        $images = [
            'assets/image/tour01.webp',
            'assets/image/tour02.webp',
            'assets/image/tour03.webp',
            // Thêm các ảnh khác nếu có
        ];
        
        return view('client.tour_chi_tiet', compact('images'));
    }
}