@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="lead">${{ number_format($product->price, 2) }}</p>

            @if($product->category)
                <p><strong>Category: </strong>{{ $product->category->name }}</p>
            @endif

            <p>{{ $product->description }}</p>
            
            <form action="{{ route('products.select', $product) }}" method="POST">
                @csrf
                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-sm">Add to Cart</a>
            </form>
            
            @auth
            <div class="mt-3">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection