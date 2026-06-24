@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <h1>Shopping Cart</h1>

    @if(session()->has('cart'))
        @foreach(session()->get('cart') as $item)
            <div>
                <h3>{{ $item['product']->product_name }}</h3>
                <p>Price: ${{ $item['product']->product_price }}</p>
                <p>Quantity: {{ $item['quantity'] }}</p>
            </div>
        @endforeach
    @else
        <p>Your cart is empty.</p>
    @endif

    <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
@endsection
