<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    @if(session('success')) <p>{{ session('success') }}</p> @endif
    @if($errors->any()) <p>{{ $errors->first() }}</p> @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <!-- <label><input type="checkbox" name="isAdmin"> Register as Admin</label><br><br> -->

        <button type="submit">Register</button>
    </form>
    <p><a href="{{ route('login.form') }}">Login</a></p>
</body>
</html>
