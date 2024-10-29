<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Tour;

class UserPageController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $tours = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'transport', 'featured', 'featured_start')->limit(9)->get();
        
        $data = session('data', []);
        $latestNews = News::orderBy('created_at', 'desc')->take(4)->get();
        return view('client.home', compact('data','categories', 'tours', 'latestNews'));
    }

    public function about()
    {
        return view('client.gioi_thieu');
    }
    // public function contact()
    // {
    //     return view('client.lien_he');
    // }
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
