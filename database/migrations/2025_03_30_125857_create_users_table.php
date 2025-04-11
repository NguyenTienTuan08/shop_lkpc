<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username')->primary(); // Đặt username làm khóa chính
            $table->string('yourname');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('password');
            $table->enum('role', ['Admin', 'Member'])->default('Member');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
