<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
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
            <div class="col-md-4 mx-auto fw-bolder">
                <div class="card bg-dark text-dark bg-opacity-10">
                    <div class="card-header text-center fw-bolder fs-3">Login</div>
                    <div class="card-body fw-bolder">
     <form method="POST" action="{{ route('signin') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" name="email" class="form-control bg-light text-dark border-secondary" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password:</label>
        <input type="password" name="password" class="form-control bg-light text-dark border-secondary" required>
    </div>
    <button type="submit" class="btn btn-outline-dark w-100">Login</button>

    <div class="mt-3 text-center">
        <p>Don't have an account? <a href="{{ route('signup') }}" class="text-info">Register Here</a></p>
    </div>
</form>
</body>
</html>