@extends('layouts.app')

@section('title',$category->name)

@section('content')

    <h1>{{$category->name}}</h1>

    @if($category->description)
    <p>{{$category->description}}</p>
    @endif

    <div class='products'>
        @forelse($products as $product)
        <div class='product'>
            <h2>{{$product->name}}</h2>
            <p>{{$product->description}}</p>
            <p>Price:{{number_format($product->price)}}Yen</p>
            <p>Stock:{{$product->stock}}</p>
            <a href="{{route('products.show',$product)}}">Show the detail</a>
        </div>
        <hr>
        @empty
        <p>No products found.</p>
        @endforelse
    </div>

    {{$products->links()}}
    @endsection
