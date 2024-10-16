<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Http\Request;

class UserTourController extends Controller
{
    public function tour()
    {
        $categories = Category::all(); 
        $tours = Tour::select('id','category_id', 'image_url', 'title', 'sub_title', 'slug', 'description','duration','transport','featured','featured_start')->limit(9)->get();
        return view('client.tour', compact('categories','tours'));
    }
    
    public function chitiet($slug)
    {
        $categories = Category::all();
        $tour = Tour::select('id','category_id', 'image_url', 'title', 'sub_title', 'slug', 'description','duration','transport','featured','featured_start')->where('slug', '=', $slug)->first();

        $images = [
            'assets/image/'.$tour->image_url,
            'assets/image/tour02.webp',
            'assets/image/tour03.webp',
            // Thêm các ảnh khác nếu có
        ];
        
        return view('client.tour_chi_tiet', compact('images','categories','tour'));
    }
}