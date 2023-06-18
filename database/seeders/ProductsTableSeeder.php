<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Sport Shoes 1', 'category' => 'Footwear', 'price' => 1100.00, 'old_price' => 1300.00, 'image' => 'sport_shoes1.png'],
            ['name' => 'Sport Shoes 2', 'category' => 'Footwear', 'price' => 1200.00, 'old_price' => 1400.00, 'image' => 'sport_shoes2.png'],
            ['name' => 'Smart Watch 1', 'category' => 'Electronics', 'price' => 3100.00, 'old_price' => 3300.00, 'image' => 'smart_watch1.png'],
            ['name' => 'Smart Watch 2', 'category' => 'Electronics', 'price' => 3200.00, 'old_price' => 3400.00, 'image' => 'smart_watch2.png'],
            ['name' => 'Gaming Laptop 1', 'category' => 'Computers', 'price' => 75000.00, 'old_price' => 80000.00, 'image' => 'gaming_laptop_1.png'],
            ['name' => 'Gaming Laptop 2', 'category' => 'Computers', 'price' => 82000.00, 'old_price' => 86000.00, 'image' => 'gaming_laptop_2.png'],
            ['name' => 'Headphones 1', 'category' => 'Electronics', 'price' => 500.00, 'old_price' => 600.00, 'image' => 'headphones1.png'],
            ['name' => 'Headphones 2', 'category' => 'Electronics', 'price' => 800.00, 'old_price' => 900.00, 'image' => 'headphones2.png'],
            ['name' => 'T-Shirt 1', 'category' => 'Clothing', 'price' => 200.00, 'old_price' => 250.00, 'image' => 'tshirt1.png'],
            ['name' => 'T-Shirt 2', 'category' => 'Clothing', 'price' => 150.00, 'old_price' => 180.00, 'image' => 'tshirt2.png'],
            ['name' => 'Backpack 1', 'category' => 'Accessories', 'price' => 500.00, 'old_price' => 600.00, 'image' => 'backpack1.png'],
            ['name' => 'Backpack 2', 'category' => 'Accessories', 'price' => 800.00, 'old_price' => 900.00, 'image' => 'backpack2.png'],
            ['name' => 'Dumbbells Set', 'category' => 'Fitness', 'price' => 1000.00, 'old_price' => 1200.00, 'image' => 'dumbbells_set.png'],
            ['name' => 'Yoga Mat', 'category' => 'Fitness', 'price' => 300.00, 'old_price' => 350.00, 'image' => 'yoga_mat.png'],
            ['name' => 'Gaming Console 1', 'category' => 'Gaming', 'price' => 2000.00, 'old_price' => 2300.00, 'image' => 'gaming_console1.png'],
            ['name' => 'Gaming Console 2', 'category' => 'Gaming', 'price' => 2500.00, 'old_price' => 2800.00, 'image' => 'gaming_console2.png'],
            ['name' => 'Smartphone 1', 'category' => 'Electronics', 'price' => 9000.00, 'old_price' => 9500.00, 'image' => 'smartphone1.png'],
            ['name' => 'Smartphone 2', 'category' => 'Electronics', 'price' => 10000.00, 'old_price' => 10500.00, 'image' => 'smartphone2.png'],
            ['name' => 'Camera 1', 'category' => 'Electronics', 'price' => 4000.00, 'old_price' => 4200.00, 'image' => 'camera1.png'],
            ['name' => 'Camera 2', 'category' => 'Electronics', 'price' => 4500.00, 'old_price' => 4700.00, 'image' => 'camera2.png'],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'category' => $product['category'],
                'price' => $product['price'],
                'old_price' => $product['old_price'],
                'image' => $product['image'],
            ]);
        }
    }
}
