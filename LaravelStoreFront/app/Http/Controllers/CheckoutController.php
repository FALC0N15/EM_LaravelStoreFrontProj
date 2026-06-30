<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.cart')->with('error', 'Your cart is empty.');
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        $lineItems = $cartItems->map(function ($item) {
            return [
                'price_data' => [
                    'currency'     => 'cad',
                    'product_data' => ['name' => $item->product->product_name],
                    'unit_amount'  => $item->product->product_price * 100, // Stripe uses cents
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items'            => $lineItems,
            'mode'                  => 'payment',
            'success_url'           => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'            => route('products.cart'),
        ]);
        // create a pending order in our DB
        $order = Order::create([
            'user_id'            => Auth::id(),
            'total_amount'               => $cartItems->sum(fn($i) => $i->product->product_price * $i->quantity),
            'shipping_address' => '123 Main St, Anytown, USA', // Replace with actual shipping address
            'billing_address'  => '123 Main St, Anytown, USA', // Replace with actual billing address or use user's address
            'order_quantity'    => $cartItems->sum('quantity'),
            'status'              => 'pending',
            'stripe_session_id'   => $session->id,
        ]);
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->product_price,
            ]);
        }

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if(!$sessionId) {
            return redirect()->route('products.index')->with('error', 'Invalid session ID.');
        }

        $order = Order::where('stripe_session_id', $sessionId)->firstOrFail();
        $order->update(['status' => 'paid']);

        // clear the cart now that payment succeeded
        CartItem::where('user_id', Auth::id())->delete();

        return view('checkout.success', compact('order'));
    }
}
