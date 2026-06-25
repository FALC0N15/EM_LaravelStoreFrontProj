@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Products</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>${{ number_format($product->product_price, 2) }}</td>
                    <td>
                        <form method="POST" action="{{ route('products.addToCart', $product->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/" class="btn btn-secondary mt-3">Back to Home</a>
</div>
@endsection
