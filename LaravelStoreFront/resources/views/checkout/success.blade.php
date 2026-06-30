@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <i class="bi bi-check-circle text-success" style="font-size: 4rem;"></i>
    <h1 class="mt-3">Payment Successful!</h1>
    <p class="text-muted">Order #{{ $order->id }} — Total: ${{ number_format($order->total, 2) }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
</div>
@endsection
