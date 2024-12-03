<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';  // Tên bảng trong cơ sở dữ liệu

    // Khai báo các trường có thể được fill
    protected $fillable = ['id', 'image_url', 'title', 'slug', 'description', 'content', 'is_hidden', 'admin_id', 'category_id'  ];
   // Mối quan hệ với Category
    public function NewsCategory()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id','id'); // Mối quan hệ
    }
    public function Admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id'); // Mối quan hệ
    }
    // public function images()
    // {
    //     return $this->hasMany(Image::class, 'tour_id', 'id'); // 'tour_id' là khóa ngoại trong bảng images
    // }

    public static function getNew($limit = 1){
        return self::latest()->limit($limit)->get();
    }
    public static function scopeReading($query)
    {
    return $query->where('reading', '>', 4)->orderBy('id', 'desc')->limit(2);
    }
}
