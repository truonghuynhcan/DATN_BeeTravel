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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->comment('unique - email dung dang nhap');
            $table->string('password');
            $table->enum('role',['admin','provider','pending'])->default('pending')->comment('pending la provider dang ky cho xac nhan');
            $table->string('name')->comment('ho va ten');
            $table->char('phone',10)->comment('bat buoc co sdt de lien he');

            $table->string('image_url',)->nullable()->comment('anh dai dien');
            $table->string('banner_url')->nullable()->comment('top banner');
            $table->string('bank_number')->nullable()->comment('stk ngan hang');
            $table->string('bank_name')->nullable()->comment('ten tk ngan hang');

            $table->boolean('is_block')->default(false)->comment('co bi khoa tai khoan hay khong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
