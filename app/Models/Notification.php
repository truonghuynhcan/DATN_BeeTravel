<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'image_url',
        'title',
        'description',
        'seen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
