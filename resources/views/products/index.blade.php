@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <h1>Products</h1>

    <!-- Search Form -->
    <form action="{{ route('products.index') }}" method="GET">
        <!-- Search Input -->
        <div>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search products...">
        </div>

        <!-- Category Filter -->
        <div>
            <select name="category">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Price Range -->
        <div>
            <input type="number"
                   name="min_price"
                   value="{{ request('min_price') }}"
                   placeholder="Min Price">
            <input type="number"
                   name="max_price"
                   value="{{ request('max_price') }}"
                   placeholder="Max Price">
        </div>

        <button type="submit">Search</button>
        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
            <a href="{{ route('products.index') }}">Clear</a>
        @endif
    </form>

    <!-- Products List -->
    <div class="products">
        @forelse($products as $product)
            <div class="product">
                <h2>{{ $product->name }}</h2>
                @if($product->category)
                    <p>Category: {{ $product->category->name }}</p>
                @endif
                <p>{{ $product->description }}</p>
                <p>Price: ¥{{ number_format($product->price) }}</p>
                <p>Stock: {{ $product->stock }}</p>
                <a href="{{ route('products.show', $product) }}">View Details</a>
            </div>
            <hr>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>

    {{ $products->links() }}
@endsection
