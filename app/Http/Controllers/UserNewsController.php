<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;

class UserNewsController extends Controller
{
    public function news(Request $request)
    {
        // Lấy tất cả các danh mục
        $categories = Category::all();
        // Lấy các tin tức mới nhất
        $news = News::getNew();
        // Lấy các tin có lượt xem cao 
        $reading = News::reading()->get();

        $latestNews = News::select('id', 'category_id', 'image_url', 'title', 'slug', 'description', 'content', 'reading')
        ->orderBy('reading', 'asc') // Sắp xếp theo featured tăng dần
        ->get();

        return view('client.tin_tuc_danh_muc', compact('categories', 'news','reading','latestNews'));
    } 
    public function getNewByCategory(Request $request, $category_id)
    {
        // Lấy tất cả các danh mục
        $categories = Category::all();
        $news = News::where('category_id', $category_id)->get();
        $reading = News::reading()->get();

        return view('client.tin_tuc_danh_muc', compact('categories', 'news', 'reading'));
    }
    public function showNews($category_id)
    {
        $categories = Category::all();
        $news = News::where('category_id', $category_id)->get();
        $newShow = News::findOrFail($category_id);
        $newShow->content = explode("\n", $newShow->content);

        return view('client.tin_tuc_chi_tiet', compact('newShow','categories', 'news'));
    }
    
}
?>
