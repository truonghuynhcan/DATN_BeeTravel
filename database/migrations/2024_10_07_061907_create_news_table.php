<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('category_id');
             
            $table->string('title')->comment('tieu de bai viet');
            $table->string('slug'); // giải quyết trùng lặp bằng cách thêm số vào cuối
            $table->string('description')->comment('mo ta ngan tin tuc');
            $table->text('content')->comment('noi dung tin tuc');
            $table->string('image_url')->nullable()->comment('anh bia cho tin tuc');
            $table->integer('reading')->nullable()->comment('luot xem');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('news_categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
