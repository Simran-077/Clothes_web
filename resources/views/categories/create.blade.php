@extends('admin.master2')

@section('content')

<div class="container mt-3">
    <h2>Add New Category</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Category Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to Category List</a>
</div>
@endsection
