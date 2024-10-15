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
        // các ngày đi của tour
        Schema::create('ngay_di', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');

            $table->dateTime('start_date')->comment('ngay bat dau');
            $table->double('price')->comment('Gia nguoi lon >12 tuoi');
            $table->double('price_tre_em')->comment('Gia nguoi lon 5-12 tuoi');
            $table->double('price_tre_nho')->comment('Gia nguoi lon 2-5 tuoi');
            $table->double('price_em_be')->comment('Gia nguoi lon <2 tuoi');
            
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ngay_di');
    }
};
