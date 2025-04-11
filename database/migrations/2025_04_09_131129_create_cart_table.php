<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('product_id');    // Liên kết với bảng products
            $table->string('username');                  // Username người dùng
            $table->string('tensanpham');                // Tên sản phẩm
            $table->string('hinhanh');                   // Ảnh sản phẩm
            $table->integer('so_luong')->default(1);     // Số lượng
            $table->decimal('thanhtien', 10, 2);         // Thành tiền = số lượng * đơn giá
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
