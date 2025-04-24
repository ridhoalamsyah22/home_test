@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Selected Products by Users</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Selected By</th>
                <th>Date Selected</th>
            </tr>
        </thead>
        <tbody>
            @foreach($selectedProducts as $selected)
            <tr>
                <td>{{ $selected->product->name }}</td>
                <td>${{ number_format($selected->product->price, 2) }}</td>
                <td>{{ $selected->user_email ?? 'Guest (Session: ' . $selected->user_session . ')' }}</td>
                <td>{{ $selected->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection