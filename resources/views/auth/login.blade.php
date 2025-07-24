<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    @if(session('success')) <p>{{ session('success') }}</p> @endif
    @if($errors->any()) <p>{{ $errors->first() }}</p> @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <p><a href="{{ route('register.form') }}">Register</a></p>
</body>
</html>
