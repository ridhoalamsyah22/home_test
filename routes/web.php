<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SelectedProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;

// Public routes
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/selected-products', [SelectedProductController::class, 'index'])
        ->name('admin.selected-products');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Product selection
    Route::post('/products/{product}/select', [SelectedProductController::class, 'selectProduct'])
        ->name('products.select');

    // Checkout routes
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/{selectedProduct}/update-quantity', [CheckoutController::class, 'updateQuantity'])
            ->name('checkout.update-quantity');
        Route::delete('/{selectedProduct}/remove-item', [CheckoutController::class, 'removeItem'])
            ->name('checkout.remove-item');
        Route::post('/process', [CheckoutController::class, 'processCheckout'])
            ->name('checkout.process');
        Route::get('/success', [CheckoutController::class, 'checkoutSuccess'])
            ->name('checkout.success');
    });
});

// Authentication routes
Auth::routes();