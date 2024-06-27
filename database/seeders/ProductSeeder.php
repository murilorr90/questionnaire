<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['uid' => 'sildenafil_50', 'name' => 'Sildenafil', 'size' => '50'],
            ['uid' => 'sildenafil_100', 'name' => 'Sildenafil', 'size' => '100'],
            ['uid' => 'tadalafil_10', 'name' => 'Tadalafil', 'size' => '10'],
            ['uid' => 'tadalafil_20', 'name' => 'Tadalafil', 'size' => '20']
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
