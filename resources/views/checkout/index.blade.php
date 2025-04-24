@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($selectedProducts->isEmpty())
        <div class="alert alert-info">
            Your cart is empty. <a href="{{ route('products.index') }}">Browse products</a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($selectedProducts as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('checkout.update-quantity', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 70px; display: inline-block;">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('checkout.remove-item', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <table class="table">
                            <tr>
                                <th>Subtotal</th>
                                <td>${{ number_format($total, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Tax</th>
                                <td>${{ number_format($total * 0.1, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>${{ number_format($total * 1.1, 2) }}</td>
                            </tr>
                        </table>
                        
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Proceed to Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection