<?php

namespace App\Http\Controllers;

use App\Models\SelectedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $selectedProducts = SelectedProduct::with('product')
                ->where('user_email', Auth::user()->email)
                ->notCheckedOut()
                ->get();
        } else {
            $selectedProducts = SelectedProduct::with('product')
                ->where('user_session', session()->getId())
                ->notCheckedOut()
                ->get();
        }

        $total = $selectedProducts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('selectedProducts', 'total'));
    }

    public function updateQuantity(Request $request, SelectedProduct $selectedProduct)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $selectedProduct->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Quantity updated successfully.');
    }

    public function removeItem(SelectedProduct $selectedProduct)
    {
        $selectedProduct->delete();
        return back()->with('success', 'Item removed from cart.');
    }

    public function processCheckout(Request $request)
    {
        if (Auth::check()) {
            $selectedProducts = SelectedProduct::where('user_email', Auth::user()->email)
                ->notCheckedOut()
                ->get();
        } else {
            $selectedProducts = SelectedProduct::where('user_session', session()->getId())
                ->notCheckedOut()
                ->get();
        }

        // Mark items as checked out
        $selectedProducts->each->update(['is_checked_out' => true]);

        // Here you would typically process payment, send email, etc.
        // For simplicity, we'll just show a success message

        return redirect()->route('checkout.success');
    }

    public function checkoutSuccess()
    {
        return view('checkout.success');
    }
}