<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviews;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ShippingDetailsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
Route::get('/dashboard', [\App\Http\Controllers\ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [ShippingDetailsController::class, 'index'])->name('checkout.index');

    Route::get('/products/{product}/reviews/create', [App\Http\Controllers\ProductReviews::class, 'create'])->name('review.create');

    Route::post('/products/{product}/ratings', [RatingController::class, 'store'])->name('ratings.store');
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



Route::get('/create', 'App\Http\Controllers\ProductController@create')->name('add.prod');
Route::post('/prod', 'App\Http\Controllers\ProductController@store')->name('products.store');

Route::get('/products/{id}/edit', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
Route::patch('/products/{id}', 'App\Http\Controllers\ProductController@update')->name('products.update');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');

Route::get('/manage', 'App\Http\Controllers\ProductController@editindex')->name('manage.products');

//return the product view
Route::get('/prod/id', function (){
    return view('product');
});

Route::get('/getProduct', [\App\Http\Controllers\ProductController::class, 'getProduct'])->name('products.prod');

Route::get('/account', function () {
    // Check if user is logged in
    if (Auth::check()) {
        // Redirect to the profile page if the user is logged in
        return redirect()->route('profile.edit');
    } else {
        // Redirect to the login page if the user is not logged in
        return redirect()->route('login');
    }
})->name('account');

Route::get('/fill', [App\Http\Controllers\ProductController::class, 'filter'])->name('prod.sort');

//Route::post('/products/{product}/reviews', [App\Http\Controllers\ProductReviews::class, 'store']);
Route::post('/products/{product}/reviews', [App\Http\Controllers\ProductReviews::class, 'store'])->name('product_reviews.store');

Route::get('/products/filterByCategory', [App\Http\Controllers\ProductController::class, 'filterByCategory'])->name('products.filterByCategory');

Route::post('/create-product', [ProductController::class, 'store'])->name('products.store');

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart', 'App\Http\Controllers\CartController@clear')->name('cart.clear');

Route::post('/cart/increment/{productId}', 'App\Http\Controllers\CartController@increment')->name('cart.increment');
Route::post('/cart/decrement/{productId}', 'App\Http\Controllers\CartController@decrement')->name('cart.decrement');

Route::post('/shipping-details', [ShippingDetailsController::class, 'store'])->name('shipping-details.store');

Route::put('/shipping-details/{shippingDetail}', [ShippingDetailsController::class, 'update'])->name('shipping-details.update');

Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');

Route::middleware(['auth', 'can:manage-products'])->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/create-category', [CategoryController::class, 'create'])->name('categories.create');


});

Route::get('/category', [CategoryController::class, 'show'])->name('category.show');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/category/{id}/products', [ProductController::class, 'getProductsByCategory'])->name('category.products');
