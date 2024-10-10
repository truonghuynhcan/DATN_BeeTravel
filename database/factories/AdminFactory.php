<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Mã hóa mật khẩu giả định
            'role' => $this->faker->randomElement(['admin', 'provider', 'pending']),
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('##########'),
            'image_url' => $this->faker->imageUrl(640, 480, 'people'),
            'banner_url' => $this->faker->imageUrl(1280, 720, 'nature'),
            'bank_number' => $this->faker->bankAccountNumber(),
            'bank_name' => $this->faker->company(),
            'is_block' => $this->faker->boolean(10), // 10% cơ hội bị khóa
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
