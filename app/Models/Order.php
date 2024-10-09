<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'tour_id',
        'user_id',
        'gender',
        'fullname',
        'phone',
        'email',
        'address',
        'is_paid',
        'voucher_code',
        'total_price',
    ];

    /**
     * Get the tour associated with the order.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
}
