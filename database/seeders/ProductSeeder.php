<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();
        $subcategoryIds = Subcategory::pluck('id')->toArray();

        $products = [];

        for ($i = 1; $i <= 50; $i++) {
            $name = 'Product ' . $i;
            $price = rand(50, 300);
            $salePrice = rand(30, $price - 1);
            $costPrice = rand(20, $salePrice - 1);

            $products[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'This is a detailed description for ' . $name,
                'short_description' => 'Short description for ' . $name,
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'price' => $price,
                'sale_price' => $salePrice,
                'cost_price' => $costPrice,
                'stock_quantity' => rand(0, 100),
                'min_quantity' => rand(1, 5),
                'weight' => rand(1, 10),
                'dimensions' => rand(10, 50) . 'x' . rand(10, 50) . 'x' . rand(10, 50),
                'is_active' => rand(0, 1),
                'is_featured' => rand(0, 1),
                'manage_stock' => rand(0, 1),
                'stock_status' => collect(['in_stock', 'out_of_stock', 'on_backorder'])->random(),
                'image' => 'product-image-' . $i . '.jpg',
                'gallery' => json_encode([
                    'gallery-image-' . $i . '-1.jpg',
                    'gallery-image-' . $i . '-2.jpg'
                ]),
                'meta_title' => 'Meta title for ' . $name,
                'meta_description' => 'Meta description for ' . $name,
                'rating_average' => round(rand(0, 50) / 10, 1), // 0.0 to 5.0
                'rating_count' => rand(0, 100),
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'subcategory_id' => $subcategoryIds[array_rand($subcategoryIds)],
            ];
        }

        foreach ($products as $product) {
            Product::firstOrCreate(['slug' => $product['slug']], $product);
        }
    }
}
