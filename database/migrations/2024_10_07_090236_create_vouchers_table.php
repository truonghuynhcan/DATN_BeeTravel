<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('code')->comment('Ma voucher');
            $table->string('description');
            $table->double('value')->comment('gia tri; vd 10 000 hoac 20');
            $table->enum('unit', ['%', 'vnd'])->comment('don vi');

            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->integer('limit_on_order')->nullable();
            $table->integer('limit_on_user')->nullable();

            $table->integer('price_min')->nullable()->comment('gia toi thieu de ap dung voucher');
            $table->integer('price_max')->nullable()->comment('gia toi da de ap dung voucher, don hang qua so tien thi ap dung pricemax de giam');

            $table->string('image_url')->nullable(); // hình thumbnail cho voucher

            $table->enum('role', ['admin', 'provider'])->comment('phan quyen nguoi chinh sua');
            // role: quyền cho người chỉnh sửa
            // + nếu là admin thì where role=admin
            // + nếu là provider thì where role=provider AND admin_id=[post admin_id]
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
