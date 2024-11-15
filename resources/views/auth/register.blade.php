<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div><br>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div><br>
        <div>
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
        </div><br>
        <button type="submit">Register</button>
    </form>
    <br>
    <a href="{{ route('login') }}">dah ada akun? Login sini</a>
</body>
</html>
