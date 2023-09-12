<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $iphoneCategories = [
            'iPhone',
            'iPhone 3G',
            'iPhone 3GS',
            'iPhone 4',
            'iPhone 4S',
            'iPhone 5',
            'iPhone 5c',
            'iPhone 5s',
            'iPhone 6',
            'iPhone 6 Plus',
            'iPhone 6s',
            'iPhone 6s Plus',
            'iPhone SE (1st generation)',
            'iPhone 7',
            'iPhone 7 Plus',
            'iPhone 8',
            'iPhone 8 Plus',
            'iPhone X',
            'iPhone XR',
            'iPhone XS',
            'iPhone XS Max',
            'iPhone 11',
            'iPhone 11 Pro',
            'iPhone 11 Pro Max',
            'iPhone SE (2nd generation)',
            'iPhone 12 mini',
            'iPhone 12',
            'iPhone 12 Pro',
            'iPhone 12 Pro Max',
            'iPhone 13 mini',
            'iPhone 13',
            'iPhone 13 Pro',
            'iPhone 13 Pro Max',
            'iPhone SE (3rd generation)',
            'iPhone 14',
            'iPhone 14 Plus',
            'iPhone 14 Pro',
            'iPhone 14 Pro Max',
        ];

        foreach ($iphoneCategories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }
    }
}
