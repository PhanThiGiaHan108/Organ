<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;

class CartsSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy user đầu tiên có role là 'user' (hoặc cụ thể id = 2 nếu bạn chắc chắn)
        $user = User::where('role', 'user')->first();

        if ($user) {
            Cart::create([
                'user_id' => $user->id,
                'subtotal' => 50000,
                'total' => 50000,
            ]);
        } else {
            echo "⚠️ Không tìm thấy user để tạo cart.\n";
        }
    }
}
