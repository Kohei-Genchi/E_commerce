@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>

    <div class="product-details">
        @if($product->category)
            <p>Category: {{ $product->category->name }}</p>
        @endif

        <p>{{ $product->description }}</p>
        <p>Price: ¥{{ number_format($product->price) }}</p>
        <p>Stock: {{ $product->stock }}</p>

        <!-- Rating Summary -->
        <div class="rating-summary">
            <p>Average Rating: {{ number_format($product->average_rating, 1) }}/5.0
               ({{ $product->review_count }} reviews)</p>
        </div>

        <!-- Add to Cart Form -->
        <form action="{{ route('cart.add', $product) }}" method="POST">
            @csrf
            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <!-- Reviews Section -->
    <div class="reviews">
        <h2>Reviews</h2>

        @auth
            @if(!$product->reviews()->where('user_id', auth()->id())->exists())
                <form action="{{ route('products.reviews.store', $product) }}" method="POST">
                    @csrf
                    <div>
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" required>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="comment">Review</label>
                        <textarea name="comment" id="comment" required></textarea>
                    </div>

                    <button type="submit">Submit Review</button>
                </form>
            @endif
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to write a review.</p>
        @endauth

        <!-- Reviews List -->
        @foreach($product->reviews()->with('user')->latest()->get() as $review)
            <div class="review">
                <p>Rating: {{ $review->rating }}/5</p>
                <p>{{ $review->comment }}</p>
                <p>By: {{ $review->user->name }} ({{ $review->created_at->format('Y/m/d') }})</p>

                @if(auth()->id() === $review->user_id)
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endif
            </div>
            <hr>
        @endforeach
    </div>

    <a href="{{ route('products.index') }}">Back to Products</a>
@endsection
