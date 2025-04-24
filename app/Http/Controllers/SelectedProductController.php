<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SelectedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectedProductController extends Controller
{
    public function selectProduct(Request $request, Product $product)
    {
        $userIdentifier = Auth::check() ? ['user_email' => Auth::user()->email] : ['user_session' => session()->getId()];
    
        $selectedProduct = SelectedProduct::firstOrNew([
            'product_id' => $product->id,
            ...$userIdentifier,
            'is_checked_out' => false
        ]);
        
        $selectedProduct->quantity = $selectedProduct->exists ? $selectedProduct->quantity + 1 : 1;
        $selectedProduct->save();
        
        return back()->with('success', 'Product added to cart.');
    }

    public function index()
    {
        $this->middleware('auth');
        
        $selectedProducts = SelectedProduct::with('product')->latest()->get();
        return view('selected-products.index', compact('selectedProducts'));
    }
}