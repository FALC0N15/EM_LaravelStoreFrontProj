@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Shopping Cart</h1>

    @if($cart->isEmpty())
        <p class="text-muted">Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item->product->product_name }}</td>
                        <td>${{ number_format($item->product->product_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->product->product_price * $item->quantity, 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Sub Total:</td>
                    <td colspan="2" class="fw-bold">
                        ${{ number_format($cart->sum(fn($item) => $item->product->product_price * $item->quantity), 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Tax (13%):</td>
                    <td colspan="2" class="fw-bold">
                        ${{ number_format($cart->sum(fn($item) => $item->product->product_price * $item->quantity) * 0.13, 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td colspan="2" class="fw-bold">
                        ${{ number_format($cart->sum(fn($item) => $item->product->product_price * $item->quantity) * 1.13, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Continue Shopping</a>
            <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
        </div>
    @endif
</div>
@endsection
