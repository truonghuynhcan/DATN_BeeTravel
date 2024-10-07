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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('category_id');
 
            $table->string('image_url')->comment('anh chinh cho tour');
            $table->string('title')->comment('tieu de tour');
            $table->string('slug');
            $table->string('sub_title')->comment('mo ta ngan tour');
            $table->text('description')->comment('mo ta chi tiet tour');
            $table->string('duration')->nullable()->comment('vd 2n3d');
            $table->string('transport')->nullable()->comment('phuong tien di chuyen'); // cần kiểm tra lại thống nhất cách nhập
            $table->integer('rating')->default('0')->comment('luot danh gia');
            $table->double('start')->nullable()->comment('so sao');

            $table->boolean('is_hidden')->default(false)->comment('trang thai an hien');

            $table->string('featured')->nullable()->comment('index vi tri');
            $table->dateTime('featured_start')->nullable()->comment('ngay bat dau');
            $table->dateTime('featured_end')->nullable()->comment('ngay ket thuc');

            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour');
    }
};
