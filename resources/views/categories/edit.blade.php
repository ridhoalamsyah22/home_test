@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Category: {{ $category->name }}</h1>
    
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" 
                value="{{ old('name', $category->name) }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection