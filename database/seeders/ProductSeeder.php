<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get all category IDs
        $categories = Category::all();

        // Electronics Products
        $electronicsId = $categories->where('name', 'Electronics')->first()->id;
        $this->createElectronicsProducts($electronicsId);

        // Books Products
        $booksId = $categories->where('name', 'Books')->first()->id;
        $this->createBooksProducts($booksId);

        // Clothing Products
        $clothingId = $categories->where('name', 'Clothing')->first()->id;
        $this->createClothingProducts($clothingId);

        // Home Products
        $homeId = $categories->where('name', 'Home & Living')->first()->id;
        $this->createHomeProducts($homeId);

        // Sports Products
        $sportsId = $categories->where('name', 'Sports')->first()->id;
        $this->createSportsProducts($sportsId);
    }

    private function createElectronicsProducts($categoryId): void
    {
        $products = [
            [
                'name' => 'Smartphone X',
                'description' => 'Latest smartphone with advanced features',
                'price' => 89999,
                'stock' => 50,
            ],
            [
                'name' => 'Laptop Pro',
                'description' => 'Professional laptop for work and gaming',
                'price' => 129999,
                'stock' => 30,
            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'High-quality wireless earbuds with noise cancellation',
                'price' => 19999,
                'stock' => 100,
            ],
        ];

        $this->createProducts($products, $categoryId);
    }

    private function createBooksProducts($categoryId): void
    {
        $products = [
            [
                'name' => 'Programming Basics',
                'description' => 'Learn programming fundamentals',
                'price' => 2499,
                'stock' => 200,
            ],
            [
                'name' => 'Business Strategy',
                'description' => 'Guide to modern business strategies',
                'price' => 3499,
                'stock' => 150,
            ],
            [
                'name' => 'Cooking Masterclass',
                'description' => 'Complete guide to cooking',
                'price' => 1999,
                'stock' => 100,
            ],
        ];

        $this->createProducts($products, $categoryId);
    }

    private function createClothingProducts($categoryId): void
    {
        $products = [
            [
                'name' => 'Cotton T-Shirt',
                'description' => 'Comfortable cotton t-shirt',
                'price' => 2999,
                'stock' => 300,
            ],
            [
                'name' => 'Denim Jeans',
                'description' => 'Classic denim jeans',
                'price' => 5999,
                'stock' => 200,
            ],
            [
                'name' => 'Winter Jacket',
                'description' => 'Warm winter jacket',
                'price' => 8999,
                'stock' => 100,
            ],
        ];

        $this->createProducts($products, $categoryId);
    }

    private function createHomeProducts($categoryId): void
    {
        $products = [
            [
                'name' => 'Table Lamp',
                'description' => 'Modern design table lamp',
                'price' => 4999,
                'stock' => 80,
            ],
            [
                'name' => 'Throw Pillow',
                'description' => 'Decorative throw pillow',
                'price' => 1999,
                'stock' => 150,
            ],
            [
                'name' => 'Wall Clock',
                'description' => 'Contemporary wall clock',
                'price' => 3999,
                'stock' => 100,
            ],
        ];

        $this->createProducts($products, $categoryId);
    }

    private function createSportsProducts($categoryId): void
    {
        $products = [
            [
                'name' => 'Yoga Mat',
                'description' => 'Professional yoga mat',
                'price' => 3999,
                'stock' => 200,
            ],
            [
                'name' => 'Dumbbells Set',
                'description' => 'Set of adjustable dumbbells',
                'price' => 12999,
                'stock' => 50,
            ],
            [
                'name' => 'Running Shoes',
                'description' => 'Professional running shoes',
                'price' => 8999,
                'stock' => 150,
            ],
        ];

        $this->createProducts($products, $categoryId);
    }

    private function createProducts($products, $categoryId): void
    {
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category_id' => $categoryId,
            ]);
        }
    }
}
