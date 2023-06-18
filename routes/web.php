<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);

Route::get('/product/{productId}', [\App\Http\Controllers\ProductController::class, 'product'])->name('products.product');

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'add']);

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('/cartData', [App\Http\Controllers\CartController::class, 'data'])->name('cart.data');


Route::get('/cart/increment/{productId}', array('uses' => \App\Http\Controllers\CartController::class . '@increment'));
Route::get('/cart/decrement/{productId}', array('uses' => \App\Http\Controllers\CartController::class . '@decrement'));

Route::post('/cart/update/{productId}', array('uses' => \App\Http\Controllers\CartController::class . '@update'));

Route::get('/cart/clear', array('uses' => \App\Http\Controllers\CartController::class . '@clear'));

Route::get('/cart/remove/{productId}', array('uses' => \App\Http\Controllers\CartController::class . '@remove'));

Route::post('/wishlist/add', [\App\Http\Controllers\WishlistController::class, 'add']);
Route::get('/wishlist/data', [\App\Http\Controllers\WishlistController::class, 'data']);
Route::delete('/wishlist/remove/{productId}', [\App\Http\Controllers\WishlistController::class, 'remove']);
Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index']);

//Route to checkout page return view
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout.index');

Route::get('/products/create', 'App\Http\Controllers\ProductController@create');
Route::post('/prod', 'App\Http\Controllers\ProductController@store');

Route::get('/products/{id}/edit', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
Route::patch('/products/{id}', 'App\Http\Controllers\ProductController@update')->name('products.update');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');

Route::get('/manage', 'App\Http\Controllers\ProductController@editindex');
