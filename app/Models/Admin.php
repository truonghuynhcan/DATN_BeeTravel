<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

     // Chỉ định bảng
     protected $table = 'admins';

     // Thiết lập quan hệ 1-nhiều (Admins có nhiều Tours)
     public function tours()
     {
         return $this->hasMany(Tour::class);
     }
     public function news()
     {
         return $this->hasMany(News::class);
     }
     public function voucher()
     {
         return $this->hasMany(Voucher::class);
     }

    // Các thuộc tính có thể được điền vào (mass-assignable)
    protected $fillable = [
        'email',
        'password',
        'role',
        'name',
        'phone',
        'image_url',
        'banner_url',
        'bank_number',
        'bank_name',
        'is_block'
    ];
    protected $hidden = [
        'password',
    ];
}