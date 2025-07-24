<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  @auth
    <h2>Hai, {{ Auth::user()->name }}!</h2>

    <p>DASHBOARD {{ strtoupper(Auth::user()->role) }}</p>

    <form action="{{ route('logout') }}" method="GET">
      @csrf
      <button type="submit" class="nav-link" style="background: none; border: none; color: red; cursor: pointer;">
        <i class="fas fa-arrow-alt-circle-left"></i> Logout
      </button>
    </form>
  @else
    <p>Silakan login terlebih dahulu.</p>
    <a href="{{ route('login.form') }}">Login</a>
  @endauth

</body>
</html>
