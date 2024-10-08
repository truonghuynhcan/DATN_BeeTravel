<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Chỉ định bảng
    protected $table = 'categories';

     // Thiết lập quan hệ 1-nhiều (Category có nhiều Tours)
     public function tours()
     {
         return $this->hasMany(Tour::class);
     }

    // Các thuộc tính có thể được điền vào (mass-assignable)
    protected $fillable = [
        'ten_danh_muc',
        'slug',
        'tour_nuoc_ngoai',
    ];
}
