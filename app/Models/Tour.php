<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    // Thiết lập quan hệ 1-nhiều (Category có nhiều Tours)
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

   // Các thuộc tính có thể được điền vào (mass-assignable)
   protected $fillable = [
       'ten_danh_muc',
       'slug',
       'tour_nuoc_ngoai',
   ];
}
