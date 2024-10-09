<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $category_name = $this->faker->unique()->city(); // Tên danh mục giả định là tên thành phố
        return [
            'ten_danh_muc' => $category_name,
            'slug' => Str::slug($category_name),
            'tour_nuoc_ngoai' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
