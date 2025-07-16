<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Register</title>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <!-- Background Image with Opacity -->
    <div class="position-fixed top-0 start-0 w-100 h-100">
        <img src="https://static.vecteezy.com/system/resources/previews/035/336/813/non_2x/circle-wooden-table-top-with-blurred-tea-plantation-landscape-against-blue-sky-and-blurred-green-leaf-frame-product-display-concept-natural-background-free-photo.jpg"
             class="w-100 h-100 object-fit-cover opacity-50" alt="Background">
    </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
      <div class="container position-relative">
        <div class="row">
            <div class="col-md-5 mx-auto fw-bolder">
                <div class="card text-dark bg-dark bg-opacity-10">
                    <div class="card-header text-center fw-bolder fs-3">Register</div>
                    <div class="card-body fw-bolder">
        <form method="POST" action="{{ route('signup') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control bg-light text-dark border-secondary" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control bg-light text-dark border-secondary" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone:</label>
                <input type="text" name="phone" class="form-control bg-light text-dark border-secondary" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control bg-light text-dark border-secondary" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password:</label>
                <input type="password" name="password_confirmation" class="form-control bg-light text-dark border-secondary" required>
            </div>
            <button type="submit" class="btn btn-outline-dark w-100">Register</button>

            <div class="mt-3 text-center">
                <p>Already have an Account? <a href="{{ route('signin') }}" class="text-info">Login Here</a></p>
            </div>
        </form>
        </div>
</body>
</html>