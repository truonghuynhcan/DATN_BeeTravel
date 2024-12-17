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

        $tours = Tour::select('id', 'category_id', 'image_url', 'title', 'sub_title', 'slug', 'description', 'duration', 'noi_khoi_hanh', 'transport', 'featured')
            // ->where('featured', true) // Chỉ lấy tour nổi bật
            // Lấy danh sách tour nổi bật, sắp xếp theo featured (false trước, true sau)
            // $tours = Tour::where('featured', true)
            //     ->orderBy('featured', 'asc') // Sắp xếp theo featured tăng dần
            // ->orderBy('created_at', 'asc') // Sắp xếp theo created_at tăng dần
            // ->limit(32)->get();
            ->orderBy('featured', 'asc') // Sắp xếp theo featured tăng dần
            ->get();

        $tours_moinhat = Tour::select('id', 'category_id', 'admin_id', 'image_url', 'title', 'slug', 'duration', 'noi_khoi_hanh', 'transport', 'featured', 'is_hidden')
            ->orderBy('created_at', 'desc') // Sắp xếp theo featured tăng dần
            ->get();

        $data = session('data', []);
        $latestNews = News::select('id', 'category_id', 'image_url', 'title', 'slug', 'description', 'content', 'reading')
            ->orderBy('reading', 'asc') // Sắp xếp theo featured tăng dần
            ->limit(4)->get();
        return view('client.home', compact('data', 'categories', 'tours', 'latestNews'));
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
