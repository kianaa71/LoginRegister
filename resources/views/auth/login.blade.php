<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div><br>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div><br>
        <button type="submit">Login</button>
    </form>
    <br>
    <a href="{{ route('register') }}">Gaada akun? Register sini</a>
</body>
</html>
