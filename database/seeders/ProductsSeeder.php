<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Thịt lợn',
            'slug' => 'thit-lon',
            'description' => 'Thịt lợn tươi ngon, chất lượng cao.',
            'price' => 150000,
            'discount_price' => 120000,
            'stock' => 50,
            'image' => 'thit-lon.jpg',
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Thịt bò',
            'slug' => 'thit-bo',
            'description' => 'Thịt bò tươi ngon, giàu dinh dưỡng.',
            'price' => 250000,
            'discount_price' => 230000,
            'stock' => 30,
            'image' => 'thit-bo.jpg',
            'category_id' => 1,
        ]);

      
        Product::create([
            'name' => 'Hạt điều rang muối',
            'slug' => 'hat-dieu-rang-muoi',
            'description' => 'Hạt điều rang muối thơm ngon, giòn tan.',
            'price' => 50000,
            'stock' => 60,
            'image' => 'hat-dieu-rang-muoi.jpg',
            'category_id' => 3,
        ]);
        
        Product::create([
            'name' => 'Táo đỏ',
            'slug' => 'tao-do',
            'description' => 'Táo đỏ giòn, ngọt, giàu chất xơ.',
            'price' => 30000,
            'stock' => 100,
            'image' => 'tao-do.jpg',
            'category_id' => 5,
        ]);
        Product::create([
            'name' => 'Bột nghệ',
            'slug' => 'bot-nghe',
            'description' => 'Bột nghệ nguyên chất, gia vị và dược liệu quý.',
            'price' => 25000,
            'stock' => 90,
            'image' => 'bot-nghe.jpg',
            'category_id' => 5,
        ]);
        Product::create([
            'name' => 'Gừng tươi',
            'slug' => 'gung-tuoi',
            'description' => 'Gừng tươi, gia vị không thể thiếu trong bếp.',
            'price' => 15000,
            'stock' => 80,
            'image' => 'gung-tuoi.jpg',
            'category_id' => 5,
        ]);
        Product::create([
            'name' => 'Tôm tươi',
            'slug' => 'tom-tuoi',
            'description' => 'Tôm tươi ngon, giàu protein.',
            'price' => 200000,
            'discount_price' => 180000,
            'stock' => 40,
            'image' => 'tom-tuoi.jpg',
            'category_id' => 4,
        ]);
         Product::create([
            'name' => 'Cá hồi',
            'slug' => 'ca-hoi',
            'description' => 'Cá hồi tươi ngon, giàu omega-3.',
            'price' => 800000,
            'discount_price' => 780000,
            'stock' => 20,
            'image' => 'ca-hoi.jpg',
            'category_id' => 4,
        ]);
       
        Product::create([
            'name' => 'Sò điệp',
            'slug' => 'so-diep',
            'description' => 'Sò điệp tươi ngon, hương vị biển cả.',
            'price' => 350000,
            'discount_price' => 320000,
            'stock' => 15,
            'image' => 'so-diep.jpg',
            'category_id' => 4,
        ]);
          Product::create([
            'name' => 'Rau cải xanh',
            'slug' => 'rau-cai-xanh',
            'description' => 'Rau cải xanh tươi mát, giàu vitamin.',
            'price' => 20000,
            'stock' => 75,
            'image' => 'rau-cai-xanh.jpg',
            'category_id' => 2,
        ]);
        Product::create([
            'name' => 'Ớt chuông',
            'slug' => 'ot-chuong',
            'description' => 'Ớt chuông tươi ngon, màu sắc bắt mắt.',
            'price' => 18000,
            'stock' => 70,
            'image' => 'ot-chuong.jpg',
            'category_id' => 2,
        ]);
        Product::create([
            'name' => 'Bí đỏ',
            'slug' => 'bi-do',
            'description' => 'Bí đỏ tươi ngon, giàu vitamin A.',
            'price' => 22000,
            'stock' => 65,
            'image' => 'bi-do.jpg',
            'category_id' => 2,
        ]); 
        Product::create([
            'name' => 'Hạt chia',
            'slug' => 'hat-chia',
            'description' => 'Hạt chia giàu omega-3, tốt cho sức khỏe.',
            'price' => 22000,
            'stock' => 55,
            'image' => 'hat-chia.jpg',
            'category_id' => 3,
        ]);
        Product::create([
            'name' => 'Cà chua bi',
            'slug' => 'ca-chua-bi',
            'description' => 'Cà chua bi ngọt, tươi ngon.',
            'price' => 22000,
            'stock' => 85,
            'image' => 'ca-chua-bi.jpg',
            'category_id' => 3,
        ]);
        Product::create([
            'name' => 'Sầu riêng',
            'slug' => 'sau-rieng',
            'description' => 'Sầu riêng thơm ngon, đặc sản miền Nam.',
            'price' => 80000,
            'stock' => 100,
            'image' => 'sau-rieng.jpg',
            'category_id' => 3,
        ]);

    }
}