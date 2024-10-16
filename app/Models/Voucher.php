<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_id',
        'code',
        'description',
        'value',
        'unit',
        'date_start',
        'date_end',
        'limit_on_order',
        'limit_on_user',
        'price_min',
        'price_max',
        'image_url',
        'role',
    ];

    /**
     * Get the admin that owns the voucher.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
