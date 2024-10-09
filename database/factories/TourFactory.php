<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TourFactory extends Factory
{
    protected $model = Tour::class;

    public function definition()
    {
        $title = $this->faker->sentence(3); // Tiêu đề tour giả định
        return [
            'admin_id' => \App\Models\Admin::factory(), // Tạo admin giả lập
            'category_id' => \App\Models\Category::factory(), // Tạo category giả lập
            'image_url' => $this->faker->imageUrl(640, 480, 'travel'),
            'title' => $title,
            'slug' => Str::slug($title),
            'sub_title' => $this->faker->sentence(6), // Mô tả ngắn
            'description' => $this->faker->paragraph(), // Mô tả chi tiết
            'duration' => $this->faker->randomElement(['2n3d', '3n4d', '4n5d']),
            'transport' => $this->faker->randomElement(['bus', 'plane', 'train']),
            'rating' => $this->faker->numberBetween(1, 5), // Đánh giá
            'start' => $this->faker->randomFloat(2, 1, 5), // Số sao
            'is_hidden' => $this->faker->boolean(),
            'featured' => $this->faker->randomElement(['top', 'trending', null]),
            'featured_start' => $this->faker->dateTime(),
            'featured_end' => $this->faker->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
