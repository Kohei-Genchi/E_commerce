<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and gadgets',
            ],
            [
                'name' => 'Books',
                'description' => 'Books and magazines',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Fashion and apparel',
            ],
            [
                'name' => 'Home & Living',
                'description' => 'Home decorations and furniture',
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports equipment and accessories',
            ],
        ];

        foreach ($categories as $category) {
            // Check if category exists by slug
            $slug = Str::slug($category['name']);

            if (!Category::where('slug', $slug)->exists()) {
                Category::create([
                    'name' => $category['name'],
                    'slug' => $slug,
                    'description' => $category['description'],
                ]);
            }
        }
    }
}
