<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductData;
use App\Models\ProductImage;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $iphoneCategories = \App\Models\Category::where('name', 'like', 'iPhone%')->get();

        foreach ($iphoneCategories as $category) {
            foreach (range(1, 10) as $index) {
                $productName = $faker->unique()->sentence(3);
                $product = Product::create([
                    'name' => $productName,
                    'category_id' => $category->id,
                    'price' => $faker->randomFloat(2, 10, 1000),
                    'old_price' => $faker->randomFloat(2, 5, 500),
                    'image' => 'https://sparerealm.com/img/1693923731_1.jpg',
                    'description' => 'Brand Apple Model Name iPhone 13 Pro Wireless Carrier Unlocked for All Carriers Operating System iOS 16 Cellular Technology 5G Memory Storage Capacity 512 GB Connectivity Technology Wi-Fi Screen Size 6.1 Inches Wireless network technology',
                ]);

                // Create ProductData for each product
                $productData = ProductData::create([
                    'product_id' => $product->id,
                    'size' => $faker->word,
                    'color' => $faker->colorName,
                    'car_model_name' => $faker->word,
                    'weight' => $faker->randomFloat(2, 1, 100),
                    'part_number' => $faker->ean13,
                    'manufacturer' => $faker->company,
                    'compatibility' => $faker->word,
                    'material' => $faker->word,
                ]);

                // Create ProductImage for each product
                ProductImage::create([
                    'product_id' => $product->id,
                    'filename' => 'https://sparerealm.com/img/1693923731_2.jpg',
                ]);
            }
        }
    }
}

