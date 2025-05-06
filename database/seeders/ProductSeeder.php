<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(10)->create([
            'user_id'=>14,
            'category_id'=>6,
        ]);
        Product::factory(5)->create([
            'user_id'=>14,
            'category_id'=>7,
        ]);
        Product::factory(5)->create([
            'user_id'=>1,
            'category_id'=>3,
        ]);
    }
}
