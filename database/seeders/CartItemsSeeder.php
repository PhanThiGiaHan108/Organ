<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;

class CartItemsSeeder extends Seeder
{
    public function run(): void
    {
        CartItem::create([
            'cart_id' => 1,
            'product_id' => 1,
            'quantity' => 2,
            'price' => 150000,
            'total' => 300000,
        ]);

        CartItem::create([
            'cart_id' => 1,
            'product_id' => 2,
            'quantity' => 1,
            'price' => 20000,
            'total' => 40000,
        ]);
    }
}