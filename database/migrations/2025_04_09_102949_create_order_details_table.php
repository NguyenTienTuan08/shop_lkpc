<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('order_id');
            $table->string('MaSP');
            $table->string('hinhanh');
            $table->string('tensanpham');
            $table->integer('so_luong');
            $table->decimal('dongia', 10, 2);
            $table->decimal('thanhtien', 12, 2);
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
