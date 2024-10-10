<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    // Các thuộc tính có thể được điền vào (mass-assignable)
    protected $fillable = [
        'admin_id',
        'category_id',
        'image_url',
        'title',
        'slug',
        'sub_title',
        'description',
        'duration',
        'transport',
        'rating',
        'start',
        'is_hidden',
        'featured',
        'featured_start',
        'featured_end',
    ];

    // Thiết lập quan hệ 1-nhiều (1 admin - nhiều tour)
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function ngayDi()
    {
        return $this->hasMany(NgayDi::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    
}
