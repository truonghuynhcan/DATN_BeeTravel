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
        // các hình phụ của tour
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');

            $table->string('name')->comment('ten cua hinh - alt');
            $table->string('url')->comment('url cua hinh');

            $table->timestamps();
            
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
