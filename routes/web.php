<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SelectedProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);

Route::post('/products/{product}/select', [SelectedProductController::class, 'selectProduct'])
    ->name('products.select');

Route::get('/selected-products', [SelectedProductController::class, 'index'])
    ->name('selected-products.index')
    ->middleware('auth');

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/{selectedProduct}/update-quantity', [CheckoutController::class, 'updateQuantity'])->name('checkout.update-quantity');
    Route::delete('/{selectedProduct}/remove-item', [CheckoutController::class, 'removeItem'])->name('checkout.remove-item');
    Route::post('/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
});

// Tambahkan route categories
Route::resource('categories', CategoryController::class)->middleware('auth');

Auth::routes();

