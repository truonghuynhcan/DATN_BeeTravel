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
            $table->string('slug');
            $table->string('description')->comment('mo ta ngan tin tuc');
            $table->text('content')->comment('noi dung tin tuc');
            $table->string('image_url')->comment('anh bia cho tin tuc');
            $table->integer('reading')->comment('luot xem');
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
