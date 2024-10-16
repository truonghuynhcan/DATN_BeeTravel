<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\table;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    
    protected $fillable = [
        'order_id',
        'gender',
        'name',
        'birth_date',
        'phone',
        'price',
    ];

    /**
     * Get the order associated with the customer.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
