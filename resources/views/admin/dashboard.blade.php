<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    <h4>Welcome, {{ auth()->user()->name }}!</h4>
                    <div class="admin-links mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary m-2">
                            Manage Products
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-success m-2">
                            Manage Categories
                        </a>
                        <a href="{{ route('selected-products.index') }}" class="btn btn-info m-2">
                            View Selected Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection