<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Khóa ngoại tham chiếu đến users
            $table->string('name'); // Tên người đặt hàng
            $table->string('email'); // Email người đặt hàng
            $table->string('phone'); // Số điện thoại
            $table->string('address'); // Địa chỉ
            $table->text('order_notes')->nullable(); // Ghi chú đơn hàng (có thể null)
            $table->unsignedBigInteger('subtotal'); // Tiền phụ (trước khi giảm/giảm thuế)
            $table->unsignedBigInteger('total'); // Tổng tiền
            $table->string('payment_method')->default('cod');
            $table->string('status')->default('pending'); 
            // Trạng thái đơn hàng, có thể là 'pending', 'processing', 'completed', 'cancelled', v.v.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
    
};