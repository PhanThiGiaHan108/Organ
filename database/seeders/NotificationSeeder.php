<?php

namespace Database\Seeders;
use App\Models\Notification;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        // Thêm thông báo cho admin (user_id = null)
        Notification::create([
            'title' => 'Đơn hàng mới',
            'message' => 'Có một đơn hàng mới đang chờ xử lý.',
            'is_read' => false,
            'user_id' => null,
        ]);

        // Thêm thông báo cho 1 user cụ thể
        $user = User::first(); 
        if ($user) {
            Notification::create([
                'title' => 'Cảm ơn bạn đã mua hàng!',
                'message' => 'Đơn hàng của bạn đang được xử lý.',
                'is_read' => false,
                'user_id' => $user->id,
            ]);
        }
    }
}

