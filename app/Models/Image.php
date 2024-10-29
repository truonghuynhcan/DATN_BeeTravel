<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'tour_id',
        'name',
        'url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Nếu có thuộc tính nào cần ẩn, bạn có thể thêm vào đây
    ];

    /**
     * Get the tour that owns the image.
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
