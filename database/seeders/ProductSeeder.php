<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Membuat data produk
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'brand_id' => 2,
                'name' => 'Product 1',
                'slug' => Str::slug('Product 1'),
                'description' => 'Description of Product 1',
                'price' => 100.00,
                'images' => json_encode(['image1.jpg', 'image2.jpg']), // Simpan nama file gambar sebagai array
                'is_active' => true,
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'brand_id' => 2,
                'name' => 'Product 2',
                'slug' => Str::slug('Product 2'),
                'description' => 'Description of Product 2',
                'price' => 150.00,
                'images' => json_encode(['image3.jpg', 'image4.jpg']), // Simpan nama file gambar sebagai array
                'is_active' => true,
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data produk lainnya sesuai kebutuhan
        ]);
    }
}
