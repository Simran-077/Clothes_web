<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<body>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
   <div class="container mt-3">
        <h2 class= "text-center"> Login Form </h2>
     <form method="POST" action="{{ route('login') }}">
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
        <p>Don't have an account? <a href="{{ route('register') }}" class="text-info">Register Here</a></p>
    </div>
</form>
</body>
</html>