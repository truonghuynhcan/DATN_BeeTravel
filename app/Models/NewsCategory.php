<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    // // Chỉ định bảng
    // protected $table = 'newscategories';

    // // Thiết lập quan hệ 1-nhiều (newsCategory có nhiều news)
    // public function news()
    // {
    //     return $this->hasMany(News::class);
    // }

    // protected $fillable = [
    //     'title',
    //     'slug',
    //     'image_url',
    // ];
    use HasFactory;
    protected $table='news_categories';
    protected $primaryKey = 'id';
    public function news(){
        return $this->hasMany(News::class);
    
    }

}
