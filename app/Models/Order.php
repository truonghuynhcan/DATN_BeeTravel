<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'ngaydi_id',
        'user_id',
        'gender',
        'fullname',
        'email',
        'address',
        'is_paid',
        'voucher_code',
        'total_price',
    ];

    /**
     * Get the tour associated with the order.
     */
    public function ngayDi()
    {
        return $this->belongsTo(NgayDi::class, 'ngaydi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function customer()
    {
        return $this->hasMany(Customer::class, 'order_id');
    }
}
