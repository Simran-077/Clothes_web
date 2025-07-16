@extends('user.master2')

@section('content')

<div class="container mt-5">
    <div class="row">

        {{-- Success Message --}}
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

        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="background-color: #dde4ea;">
                <div class="card-header text-center bg-info text-white">
                    <h4 class="mb-0">Inquiry Form</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('user.inquiry') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input type="text" name="name" class="form-control border border-secondary shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control border border-secondary shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject:</label>
                            <input type="text" name="subject" class="form-control border border-secondary shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Message:</label>
                            <textarea class="form-control border border-secondary shadow-sm" name="message" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-info w-100 shadow-sm">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
