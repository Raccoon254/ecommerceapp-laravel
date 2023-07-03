<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Engine Parts'],
            ['name' => 'Transmission Parts'],
            ['name' => 'Braking System Parts'],
            ['name' => 'Suspension & Steering Parts'],
            ['name' => 'Exhaust Parts'],
            ['name' => 'Electrical System Parts'],
            ['name' => 'Interior Parts'],
            ['name' => 'Exterior Body Parts'],
            ['name' => 'Tires & Wheels'],
            ['name' => 'Lighting'],
            ['name' => 'Heating & Cooling'],
            ['name' => 'Accessories & Tools'],
        ]);
    }
}
