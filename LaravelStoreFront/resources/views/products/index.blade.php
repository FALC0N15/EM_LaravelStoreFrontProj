@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <h1>Products</h1>

    {{-- your products grid goes here --}}
    @foreach($products as $product)
        <div>{{ $product->product_name }}</div>
    @endforeach

    <a href="/" class="btn btn-primary">Back to Home</a>
@endsection
