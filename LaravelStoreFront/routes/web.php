<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\Category;

Route::get('/', function () {
    $categories = Category::all();
    $featured_products = Product::inRandomOrder()->take(4)->get();
    return view('welcome', compact('categories', 'featured_products'));
});
Route::get("/products", [ProductController::class, 'index'])->name('products.index');
Route::get("/categories", [CategoryController::class, 'index'])->name('categories.index');
Route::get("/add-products", [ProductController::class, 'create'])->name('products.create');
Route::get("/add-categories", [CategoryController::class, 'create'])->name('categories.create');
Route::post("/add-products", [ProductController::class, 'store'])->name('products.store');
Route::post("/add-categories", [CategoryController::class, 'store'])->name('categories.store');
Route::get("/cart", [ProductController::class, 'cart'])->name('products.cart');
route::post("/add-to-cart/{product}", [ProductController::class, 'addToCart'])->name('products.addToCart');
