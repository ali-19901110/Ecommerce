<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [];

        for ($i = 1; $i <= 20; $i++) {
            $name = 'Category ' . $i;

            $categories[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Description for ' . $name,
                'image' => 'text-image-' . $i,
                'is_active' => rand(0, 1),
                'sort_order' => $i,
                'meta_title' => 'Meta title for ' . $name,
                'meta_description' => 'Meta description for ' . $name,
            ];
        }

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
