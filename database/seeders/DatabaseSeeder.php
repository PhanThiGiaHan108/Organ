<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            ContactsSeeder::class,
            CartsSeeder::class,
            CartItemsSeeder::class,
            OrdersSeeder::class,
            OrderDetailSeeder::class,
            NotificationSeeder::class
        ]);
    }
}