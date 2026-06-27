<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
Use App\Models\User;
Use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function cart(User $user)
    {
        $cart = CartItem::with('product')->where('user_id', Auth::user()->id)->get();
        return view('products.cart', compact('cart'));
    }
    public function addToCart(User $user, Product $product)
    {
         $cartItem = CartItem::where('user_id', Auth::user()->id)
        ->where('product_id', $product->id)
        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id'    => Auth::user()->id,
                'product_id' => $product->id,
                'price'      => $product->product_price,
                'quantity'   => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
    public function removeFromCart(CartItem $cartItem)
    {
    // make sure users can only delete their own cart items
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
            }

            $cartItem->delete();

        return redirect()->route('products.cart')->with('success', 'Item removed from cart.');
    }
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
