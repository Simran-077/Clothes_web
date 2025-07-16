@extends('admin.master2')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
       
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label>Brand</label>
        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand ?? '') }}">
    </div>
    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category" class="form-control" value="{{ old('category', $product->category ?? '') }}">
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Offer Price</label>
        <input type="number" name="offer_price" class="form-control" value="{{ old('offer_price', $product->offer_price ?? '') }}" step="0.01">
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if(!empty($product->image))
            <p><img src="{{ asset('storage/' . $product->image) }}" width="100"></p>
        @endif
    </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
