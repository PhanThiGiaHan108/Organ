<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderDetail
;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
       OrderDetail::create([
            'order_id' => 1,
            'product_id' => 1,
            'quantity' => 2,
            'price' => 250000,
            'total' => 2 * 250000,
        ]);

        OrderDetail::create([
            'order_id' => 1,
            'product_id' => 2,
            'quantity' => 1,
            'price' => 20000,
            'total' => 1 * 20000,
        ]);
    }
}
