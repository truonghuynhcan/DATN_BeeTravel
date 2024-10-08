<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'ten_danh_muc' => $this->faker->words(2, true),
            'slug' => $this->faker->slug(),
            'tour_nuoc_ngoai' => $this->faker->boolean(),
        ];
    }
}
