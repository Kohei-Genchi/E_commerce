<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\ProductSearchRequest;

class ProductController extends Controller
{
    /**
     * Display product listing with filters
     */
    public function index(ProductSearchRequest $request): View
{
    $categories = Category::all();
    $query = Product::with('category');

    $validated = $request->validated();

    // 検索フィルター適用
    if (!empty($validated['search'])) {
        $search = $validated['search'];
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if (!empty($validated['category'])) {
        $query->where('category_id', $validated['category']);
    }

    if (!empty($validated['min_price'])) {
        $query->where('price', '>=', $validated['min_price']);
    }

    if (!empty($validated['max_price'])) {
        $query->where('price', '<=', $validated['max_price']);
    }

    $products = $query->latest()->paginate(12);

    return view('products.index', [
        'products' => $products,
        'categories' => $categories
    ]);
}

    /**
     * Display product details
     */
    public function show(Product $product): View
    {
        // Load necessary relationships
        $product->load([
            'category',
            'reviews' => fn($query) => $query->with('user')->latest()
        ]);

        return view('products.show', compact('product'));
    }
}
