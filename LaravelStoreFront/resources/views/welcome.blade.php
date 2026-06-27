@extends('layouts.app')

@section('content')

{{-- Hero --}}
<div class="py-5 text-white text-center mb-5"
     style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
    <div class="container py-4">
        @auth
            <p class="text-white-50 mb-1">Welcome back,</p>
            <h1 class="display-4 fw-bold mb-3">{{ Auth::user()->name }}</h1>
        @endauth
        @guest
            <h1 class="display-4 fw-bold mb-3">The Mart</h1>
        @endguest
        <p class="lead mb-4 opacity-75">Discover amazing products at great prices</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-bag me-2"></i>Shop Now
            </a>
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5">
                    Register
                </a>
            @endguest
        </div>
    </div>
</div>

{{-- Categories --}}
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Categories</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">
            View All <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="row g-4">
        @forelse($categories ?? [] as $category)
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                <i class="bi bi-tag fs-5"></i>
                            </span>
                        </div>
                        <h5 class="card-title fw-semibold">{{ $category->name }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ $category->description }}</p>
                        <a href="{{ route('products.index', ['category' => $category->id]) }}"
                           class="btn btn-outline-primary btn-sm mt-2">
                            Browse <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No categories available</p>
            </div>
        @endforelse
    </div>
</div>

{{-- Featured Products --}}
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Featured Products</h2>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
            View All <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="row g-4">
        @forelse($featured_products ?? [] as $product)
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height: 200px;">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-semibold">{{ $product->product_name }}</h6>
                        <p class="fw-bold text-primary fs-5 mt-auto mb-2">
                            ${{ number_format($product->product_price, 2) }}
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn btn-outline-secondary btn-sm flex-grow-1">
                                <i class="bi bi-eye me-1"></i>View
                            </a>
                            @auth
                                <form method="POST" action="{{ route('products.addToCart', $product->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No products available</p>
            </div>
        @endforelse
    </div>
</div>

{{-- Footer gap --}}
<div class="mb-5"></div>

@endsection
