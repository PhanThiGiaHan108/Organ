<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;


class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'user_id' => 2,
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St, City',
            'order_notes' => 'Please deliver in the evening.',
            'subtotal' => 101597,
            'total' => 101597,
            'payment_method' => 'cod',
            'status' => 'pending',
        ]);
    }
}