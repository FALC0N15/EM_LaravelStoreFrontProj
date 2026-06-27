@extends('layouts.app')

@section('title', $product->product_name)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}"
                     class="img-fluid rounded shadow-sm"
                     style="width: 100%; height: 400px; object-fit: cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded"
                     style="height: 400px;">
                    <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold mb-2">{{ $product->product_name }}</h1>
            <p class="text-muted mb-3">
                Category: {{ $product->category->name ?? 'Uncategorized' }}
            </p>
            <h2 class="text-primary fw-bold mb-4">
                ${{ number_format($product->product_price, 2) }}
            </h2>
            <p class="mb-4">{{ $product->product_description }}</p>
            <p class="text-muted small mb-4">
                <i class="bi bi-box me-1"></i>
                {{ $product->stock_quantity }} in stock
            </p>
            @auth
                <form method="POST" action="{{ route('products.addToCart', $product->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                    </button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100">
                    Log in to Add to Cart
                </a>
            @endguest
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                <i class="bi bi-arrow-left me-2"></i>Back to Products
            </a>
        </div>
    </div>
</div>
@endsection
