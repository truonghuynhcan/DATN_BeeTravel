<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';  // Tên bảng trong cơ sở dữ liệu

    // Khai báo các trường có thể được fill
    protected $fillable = ['title', 'content', 'image_url', 'category_id'];

    // Mối quan hệ với Category
    public function Category()
    {
        return $this->belongsTo(NewCategory::class, 'category_id'); // Mối quan hệ
    }

    public static function getNew($limit = 1){
        return self::latest()->limit($limit)->get();
    }
    public static function scopeReading($query)
    {
    return $query->where('reading', '>', 4)->orderBy('id', 'desc')->limit(2);
    }
}
