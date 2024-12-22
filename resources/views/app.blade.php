<!--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title> -->

        <!-- Fonts -->
         <!--
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        -->
        <!-- Scripts -->
         <!--
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Learning Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 30px;
        }
        .form-control {
            height: 50px;
            font-size: 1.1rem;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .btn-login {
            background-color: #ff6f61;
            color: white;
            font-size: 1.2rem;
            border-radius: 8px;
            padding: 12px 30px;
            width: 100%;
            transition: transform 0.3s ease, background-color 0.3s;
        }
        .btn-login:hover {
            background-color: #ff3b2a;
            transform: translateY(-5px);
        }
        .text-center {
            margin-top: 20px;
        }
        .text-center a {
            color: #ff6f61;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .alert {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login to Your Account</h2>

        <!-- Display success or error message -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <div class="text-center">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>