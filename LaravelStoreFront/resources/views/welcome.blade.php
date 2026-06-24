@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-section text-center py-5">
        <h1 class="display-4">The Mart</h1>
        <p class="lead">Discover amazing products at great prices</p>
        <a href="{{route('products.cart')}}" class="btn btn-primary btn-lg">View Cart</a>
    </div>
    <div class="button-section mt-5">
        <a href="{{ route('products.create') }}" class="btn btn-secondary .text-blue-500">Add New Product</a>
        <a href="{{ route('categories.create') }}" class="btn btn-secondary .text-blue-500">Add New Category</a>
    </div>
    <div class="categories-section mt-5">
        <h2>Categories</h2>
        <div class="row g-4">
            @forelse($categories ?? [] as $category)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->category_name }}</h5>
                            <p class="card-text">{{ $category->category_description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>No categories available</p>
            @endforelse
        </div>
    </div>
    <div class="mt-5">
        <h2>Featured Products</h2>
        <div class="row">
            @forelse($featured_products ?? [] as $product)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">${{ $product->product_price }}</p>

                        </div>
                    </div>
                </div>
            @empty
                <p>No products available</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
