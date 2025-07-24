<!DOCTYPE html>
<html>
<head>
    <title>Logging In...</title>
    <meta http-equiv="refresh" content="1;url={{ route('dashboard') }}">
</head>
<body>
    <p>Logging you in...</p>

    <script>
        // Save the token to document.cookie
        document.cookie = "jwt_token={{ $token }}; path=/; max-age=3600"; // expires in 1 hour
        console.log("JWT saved to cookie.");
    </script>
</body>
</html>
