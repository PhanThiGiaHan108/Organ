<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Contact;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên người liên hệ
            $table->string('email'); // Email người liên hệ
            $table->string('phone')->nullable(); // Số điện thoại (có thể null)
            $table->text('message'); // Nội dung tin nhắn
             $table->boolean('is_read')->default(false); // Thêm trường xác định đã đọc hay chưa

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};