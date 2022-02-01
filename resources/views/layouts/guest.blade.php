<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('revo/css/style.dark.bundle.css') }}" />
    <link rel="stylesheet" href="{{ mix('revo/plugins/global/plugins.dark.bundle.css') }}" />
    <link rel="stylesheet" href="{{ mix('revo/plugins/global/plugins-custom.dark.bundle.css') }}" />

</head>

<body id="kt_body" class="dark-mode page-loading-enabled page-loading">

    @include('layouts.loader')

    <div class="d-flex flex-column flex-root">
        {{ $slot }}
    </div>

    <!-- Scripts -->
    <script src="{{ mix('revo/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ mix('revo/js/scripts.bundle.js') }}"></script>

</body>

</html>
