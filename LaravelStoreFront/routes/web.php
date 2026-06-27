<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
Route::get('/', function () {
    $categories = Category::all();
    $featured_products = Product::inRandomOrder()->take(4)->get();
  //  $user = auth()->user();
    return view('welcome', compact('categories', 'featured_products'));
})-> name('welcome');
Route::get("/products", [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get("/categories", [CategoryController::class, 'index'])->name('categories.index');

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get("/add-products", [ProductController::class, 'create'])->middleware('auth')->name('products.create');
    Route::get("/add-categories", [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');
    Route::post("/add-products", [ProductController::class, 'store'])->middleware('auth')->name('products.store');
    Route::post("/add-categories", [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
});
Route::middleware('auth')->group(function () {
    Route::get("/cart", [ProductController::class, 'cart'])->name('products.cart');
    Route::post("/add-to-cart/{product}", [ProductController::class, 'addToCart'])->name('products.addToCart');
    Route::delete('/cart/remove/{cartItem}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
