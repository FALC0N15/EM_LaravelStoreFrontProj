<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('products.cart', compact('cart'));
    }
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);
        $cart[$product->id] = [
            'product' => $product,
            'quantity' => 1
        ];
        session()->put('cart', $cart);
        return redirect()->route('products.cart')->with('success', 'Product added to cart successfully.');
    }
}
