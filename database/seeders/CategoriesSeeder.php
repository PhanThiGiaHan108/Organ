<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Thịt tươi', 'slug' => Str::slug('Fresh Meat'),'image' => 'meat.jpg'],
            ['name' => 'Rau quả', 'slug' => Str::slug('Vegetables'),'image' => 'vegetables.jpg'],
            ['name' => 'Trái cây ', 'slug' => Str::slug('Fruit '),'image' => 'F&N.jpg'],
            ['name' => 'Hải sản', 'slug' => Str::slug('Ocean Foods'),'image' => 'O&F.jpg'],
            ['name' => 'Thực phẩm khô', 'slug' => Str::slug('Spices and seasonings'),'image' => 'S&S.jpg'],
        ];

        Category::insert($categories);
    }
}