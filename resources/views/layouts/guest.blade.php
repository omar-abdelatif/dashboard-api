<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui-pro@4.6.0-beta.0/dist/css/coreui.min.css">
    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
</head>
<body>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://unpkg.com/@coreui/coreui-pro@4.6.0-beta.0/dist/js/coreui.bundle.js"></script>
</body>
</html>
