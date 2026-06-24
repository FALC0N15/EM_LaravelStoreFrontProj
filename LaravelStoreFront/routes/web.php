<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
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
Route::get("/add-products", [ProductController::class, 'create'])->middleware('auth')->name('products.create');
Route::get("/add-categories", [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');
Route::post("/add-products", [ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::post("/add-categories", [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
Route::get("/cart", [ProductController::class, 'cart'])->middleware('auth')->name('products.cart');
Route::post("/add-to-cart/{product}", [ProductController::class, 'addToCart'])->middleware('auth')->name('products.addToCart');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
