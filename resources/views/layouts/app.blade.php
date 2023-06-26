<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title', 'Omar Abdelatif')</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui-pro@4.6.0-beta.0/dist/css/coreui.min.css">
    <link rel="stylesheet" href="{{url('resources/sass/app.scss')}}">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/omar-abdelatif/dashboard-api/04c6c64a62b2750fb82596fb784df106df4abe93/resources/css/app.css">
    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
</head>
<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <h1 class="text-center sidebar-brand-full">Dashboard</h1>
            <h1 class="text-center sidebar-brand-narrow">O</h1>
        </div>
        @include('layouts.navigation')
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @yield('header')

        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div>
                <a href="https://coreui.io">CoreUI </a>
                <a href="https://coreui.io">Bootstrap Admin Template</a>
                &copy; 2021 creativeLabs.
            </div>
            <div class="ms-auto">
                Powered by&nbsp;
                <a href="https://coreui.io/bootstrap/ui-components/">
                    CoreUI UI Components
                </a>
            </div>
        </footer>
    </div>
    <script src="https://unpkg.com/@coreui/coreui-pro@4.6.0-beta.0/dist/js/coreui.bundle.js"></script>
</body>
</html>
