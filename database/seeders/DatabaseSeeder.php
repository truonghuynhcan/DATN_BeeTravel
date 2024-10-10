<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Admin::factory(5)->create(); // tạo 5 admin giả lập
        \App\Models\Category::factory(3)->create(); // tạo 3 danh mục giả lập
        \App\Models\Tour::factory(15)->create(); // tạo 15 tour giả lập
        \App\Models\User::factory(5)->create(); // tạo 5 user giả lập

    }
}
