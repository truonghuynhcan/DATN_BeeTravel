<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Mã hóa mật khẩu
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['mr', 'mrs']),
            'phone' => $this->faker->numerify('##########'),
            'address' => $this->faker->address(),
            'image_url' => $this->faker->imageUrl(640, 480, 'people'),
            'noti_email' => $this->faker->boolean(80), // 80% cơ hội nhận thông báo email
            'noti_sms' => $this->faker->boolean(20), // 20% cơ hội nhận thông báo SMS
            'is_block' => $this->faker->boolean(10), // 10% cơ hội bị khóa tài khoản
            'last_login_at' => $this->faker->dateTimeThisYear(),
            'deletion_requested_at' => null, // Mặc định chưa yêu cầu xóa
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
