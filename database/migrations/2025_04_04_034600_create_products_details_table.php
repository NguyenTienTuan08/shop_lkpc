<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('products_details', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->unsignedBigInteger('product_id'); // Khoá ngoại liên kết với bảng products
            $table->text('thongsokythuat'); // Thông số kỹ thuật sản phẩm
            $table->text('chitietsanpham')->nullable(); // Chi tiết mô tả sản phẩm
            $table->timestamps(); // created_at, updated_at
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // Thiết lập khoá ngoại
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_details');
    }
}
