<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @stack('styles')
</head>

<body>
    @include('user.partial.navbar')

    @yield('content')

    @include('user.partial.footer')



    @stack('scripts')
</body>

</html>
