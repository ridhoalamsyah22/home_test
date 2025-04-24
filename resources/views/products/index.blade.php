@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <h1>Product Catalog</h1>
        </div>
        @auth
        <div class="col-md-6 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
        </div>
        @endauth
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                    <p class="card-text"><strong>Price: </strong>${{ number_format($product->price, 2) }}</p>

                    @if($product->category)
                        <p class="card-text"><strong>Category: </strong>{{ $product->category->name }}</p>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View Details</a>

                        <form action="{{ route('products.select', $product) }}" method="POST">
                            @csrf
                            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-sm">Add to Cart</a>
                        </form>
                    </div>

                    @auth
                    <div class="mt-2 d-flex justify-content-between">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection