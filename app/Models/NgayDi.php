<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgayDi extends Model
{
    use HasFactory;
    protected $table ='ngay_di';

    protected $fillable = [
        'tour_id',
        'start_date',
        'price',
        'price_tre_em',
        'price_tre_nho',
        'price_em_be',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class,'tour_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class,'ngaydi_id');
    }
}
