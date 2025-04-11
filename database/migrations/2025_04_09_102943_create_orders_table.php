<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('username'); // khóa ngoại từ bảng users
            $table->string('yourname');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->dateTime('order_date')->default(now());
            $table->decimal('total_price', 10, 2);
            $table->enum('delivery', ['Chờ xử lý', 'Đang giao', 'Đã giao', 'Đã hủy'])->default('Chờ xử lý');
            $table->enum('payment_method', ['Tiền mặt', 'Chuyển khoản']);
            $table->enum('status', ['Xác nhận', 'Chờ xác nhận', 'Hủy'])->default('Chờ xác nhận');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
