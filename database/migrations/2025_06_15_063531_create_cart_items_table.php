<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id'); // Khóa ngoại tham chiếu đến carts
            $table->unsignedBigInteger('product_id'); // Khóa ngoại tham chiếu đến products
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->unsignedBigInteger('price'); // Giá của sản phẩm
            $table->unsignedBigInteger('total'); // Tổng tiền (quantity * price)
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};