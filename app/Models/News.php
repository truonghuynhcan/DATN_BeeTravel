<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    protected $fillable = [
        'title',
        'slug',
        'image_url',
    ];
}
