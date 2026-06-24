@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <h1>Products</h1>
<table>
    {{-- your products grid goes here --}}
    @foreach($products as $product)
        <tr>
            <td>{{ $product->product_name }}</td>
            <td><a href="{{route('products.addToCart', ['user' => $user->id, 'product' => $product->id])}}" class="btn btn-primary">Add to Cart</a></td>
        </tr>
    @endforeach
</table>
    <a href="/" class="btn btn-primary">Back to Home</a>
@endsection
