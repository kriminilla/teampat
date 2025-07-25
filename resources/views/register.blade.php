<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - E Commerce</title>

  <link rel="icon" href="{{ asset('image/logo pnb.png') }}" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" href="#">
  <style>
    body {
      background-image: url('{{ asset('image/foto_login.png') }}');
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
      position: relative;
    }

    .background-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 1;
    }

    .register-box {
      position: relative;
      z-index: 2;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      border-radius: 10px;
      padding: 10px 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      border: 1px solid #dcdcdc;
    }

    .card-header {
      background: transparent;
      border-bottom: none;
    }

    .card-header h2 {
      font-weight: bold;
      color: #004085;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .text-danger {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="background-overlay"></div>
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="card-header text-center">
          <h2>SimpleShop</h2>
        </div>
        <p class="login-box-msg"><b>Create a New Account</b></p>

        <form action="{{ route('register') }}" method="POST">
          @csrf

          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="name" value="{{ old('name') }}" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
          </div>
          @error('name')
            <p class="text-danger">{{ $message }}</p>
          @enderror

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
          </div>
          @error('email')
            <p class="text-danger">{{ $message }}</p>
          @enderror

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>
          @error('password')
            <p class="text-danger">{{ $message }}</p>
          @enderror

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
          </div>

          <div class="row" align="center">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Register</butt
