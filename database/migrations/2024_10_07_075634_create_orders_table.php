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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ngaydi_id');
            $table->unsignedBigInteger('user_id')->nullable();
           
            // thong tin lien he
            $table->enum('gender',['mr','mrs']);
            $table->string('fullname');
            $table->char('phone',11);
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            $table->enum('status',['waiting','confirmed', 'cancel', 'finished'])->nullable()->default(value: 'waiting')->comment('Trang thai xet duyet tu admin');
            $table->boolean('is_paid')->default(false)->comment('da thanh toan hay chua');
            $table->string('voucher_code')->nullable()->comment('ma giam gia');
            $table->double('total_price')->nullable()->comment('tong tien sau khi ap voucher');
            $table->unsignedInteger('adult_count')->nullable()->default(0);
            $table->unsignedInteger('child_count')->nullable()->default(0);
            $table->unsignedInteger('toddler_count')->nullable()->default(0);
            $table->unsignedInteger('infant_count')->nullable()->default(0);

            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ngaydi_id')->references('id')->on('ngay_di')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
