@extends('website.master')
@section('content')

<div class="container mt-4">
    <h2 class="text-center fw-bold">My Profile</h2>

     @if(session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Error Message --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    <div class="card mx-auto shadow-lg p-4" style="max-width: 500px;">
        <div class="text-center">
           <img src="{{ $user->image ? asset($user->image) : asset('backend/img/undraw_profile_1.svg') }}" 
     class="rounded-circle mb-3" style="width: 100px;">

            <h4>{{ $user->name }}</h4>
            <p class="text-muted">{{ $user->email }}</p>
        </div>

        <div class="card-body">
            <!-- Profile Details -->
           <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div class="mb-3">
        <label class="form-label"><strong>Name:</strong></label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label"><strong>Email:</strong></label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>

    <!-- Phone -->
    <div class="mb-3">
        <label class="form-label"><strong>Phone:</strong></label>
        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
    </div>

    <!-- Profile Image Upload -->
    <div class="mb-3">
        <label class="form-label"><strong>Profile Image:</strong></label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
</form>
            <hr>

            <a href="{{ route('signout') }}" class="btn btn-danger w-100">Sign Out</a>
        </div>
    </div>
</div>




@endsection