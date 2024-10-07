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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique()->comment('unique - email dung dang nhap');
            $table->string('password');
            $table->string('name')->comment('ho va ten');
            
            $table->enum('gender',['mr','mrs'])->nullable()->comment('gioi tinh: mr-nam, mrs-nu');
            $table->char('phone',10)->nullable();
            $table->string('address')->nullable();
            $table->string('image_url',)->nullable()->comment('anh dai dien');
            $table->boolean('noti_email')->default(true)->comment('thong bao ve email');
            $table->boolean('noti_sms')->default(false)->comment('Thong bao ve sdt');
            
            $table->boolean('is_block')->default(false)->comment('tai khoan co bị khoa hay khong');
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('deletion_requested_at')->nullable()->comment('tạo code khi nguoi dung yeu cau; gửi mail khi còn 7 ngày và 1 ngày');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
