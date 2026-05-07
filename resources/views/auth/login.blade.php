<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Kas RT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('/images/kasrt.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.0);
        }
        .login-card {
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(12px);
            color: #fff;
        }
        .login-card label,
        .login-card .form-check-label,
        .login-card p,
        .login-card h3 {
            color: #fff;
        }
        .login-card .form-control {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.35);
        }
        .login-card .form-control:focus {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.75);
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

<div class="container d-flex justify-content-center align-items-start vh-100 position-relative pt-5">
    <div class="card shadow-lg p-4 login-card mt-4" style="width: 400px; z-index: 2;">

       <h3 class="text-center mb-3 text-success">💰 Kas RT</h3>
        <p class="text-center text-muted">Silakan login untuk melanjutkan</p>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- NAME -->
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required autofocus>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <!-- REMEMBER -->
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label">Remember me</label>
            </div>

            <!-- BUTTON -->
            <button class="btn btn-primary w-100">Login</button>

        </form>

    </div>
</div>

</body>
</html>