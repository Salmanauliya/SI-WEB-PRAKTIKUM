<!DOCTYPE html>
<html>
<head><title>Login - Simple Warehouse</title></head>
<body>
    <h2>Login Admin</h2>
    <form action="{{ route('login.post') }}" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>