<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    

    <div class="container">
        <div class="logo-section">
            <img src="{{ asset('images/logo-pondok.png') }}" alt="Logo">
            <h1>Pondok Pesantren<br>Dar El Hikmah Pekanbaru</h1>
        </div>
        <div class="form-section">
            <form method="POST" action="{{ route('api.login') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                {{-- @if(session('success') || session('error'))
                <div class="alert-card">
                    <p>{{ session('success') ?? session('error') }}</p>
                    </div>
                @endif --}}
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
