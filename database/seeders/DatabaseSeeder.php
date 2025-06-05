<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Strawberry Ice Cream',
            'price' => 10.00,
            'description' => 'A delicious strawberry-flavored ice cream.',
        ]);
        Product::create([
            'name' => 'Chocolate Ice Cream',
            'price' => 10.00,
            'description' => 'Rich and creamy chocolate ice cream.',
        ]);
        Product::create([
            'name' => 'Vanilla Ice Cream',
            'price' => 10.00,
            'description' => 'Classic vanilla ice cream.',
        ]);
    }
}