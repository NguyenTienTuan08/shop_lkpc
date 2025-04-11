<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Tạo cột id tự động tăng
            $table->enum('danhmuc', ['Mainboard', 'CPU', 'RAM', 'SSD', 'VGA', 'Case', 'ManHinh']); // Danh mục sản phẩm
            $table->string('hinhanh'); // Hình ảnh sản phẩm
            $table->string('tensanpham'); // Tên sản phẩm
            $table->decimal('dongia', 10, 2); // Đơn giá sản phẩm
            $table->string('phanloai'); // Phân loại sản phẩm
            $table->enum('status', ['con_hang', 'het_hang']); // Trạng thái sản phẩm (còn hàng, hết hàng)
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
