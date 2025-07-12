<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();

        $subcategories = [];

        for ($i = 1; $i <= 20; $i++) {
            $name = 'Subcategory ' . $i;

            $subcategories[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Description for ' . $name,
                'image' => 'text-image-' . $i,
                'is_active' => rand(0, 1),
                'sort_order' => $i,
                'meta_title' => 'Meta title for ' . $name,
                'meta_description' => 'Meta description for ' . $name,
                'category_id' => $categoryIds[array_rand($categoryIds)],
            ];
        }

        foreach ($subcategories as $subcategory) {
            Subcategory::firstOrCreate(
                ['slug' => $subcategory['slug']],
                $subcategory
            );
        }
    }
}
