<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/pa/logo-img-1.png') }}" type="image/x-icon" />

    @hasSection('styles')
        @yield('styles')
    @else
        <link rel="stylesheet" href="{{ asset('css/pa/normalize.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/pa/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/pa/media.css') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
        <link rel="stylesheet" href="{{ asset('css/pa/lib-style.css') }}" />
    @endif
    <title>Личный кабинет</title>
</head>

<body>
    @yield('main')
</body>

@yield('scripts')
