<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price'); // Giá gốc
            $table->decimal('discount_price', 8, 2)->nullable(); // Giá giảm (có thể null)
            $table->integer('stock')->default(0); // Số lượng tồn kho
            $table->string('image')->nullable(); // Đường dẫn hình ảnh
            $table->unsignedBigInteger('category_id'); // Khóa ngoại tham chiếu đến categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};