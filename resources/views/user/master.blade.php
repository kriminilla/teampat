<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    @stack('scripts')
</head>

<body>
    @include('user.partial.navbar')

    @yield('content')

    {{-- Kurang Footer --}}



    @stack('scripts')
</body>

</html>
