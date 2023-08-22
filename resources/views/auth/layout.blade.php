<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Cash rocket login') }}</title>
    <!-- Apple Favicon -->
    <link rel="apple-touch-icon" href="{{ asset(settings()->favicon) }}">
    <!-- All Device Favicon -->
    <link rel="icon" href="{{ asset(settings()->favicon) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="mybazar-login-section">
        <div class="mybazar-login-wrapper">
            @yield('contents')
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('back-end/js/custom.js') }}"></script>
    @stack('script')
</body>
</html>
