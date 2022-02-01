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

    @stack('styles')

    @livewireStyles


</head>

<body id="kt_body" style="background-image: url({{ URL::asset('revo/media/patterns/header-bg-dark.png') }})"
    class="dark-mode page-loading-enabled page-loading header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

    @include('layouts.loader')

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @livewire('navigation-menu')
                <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
                    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
                        <div class="page-title d-flex flex-column me-3">
                            <h1 class="d-flex text-white fw-bolder my-1 fs-3">{{ $title }}</h1>
                            {{-- <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                <li class="breadcrumb-item text-white opacity-75">
                                    <a href="../../demo2/dist/index.html" class="text-white text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-white opacity-75">Dashboards</li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-white opacity-75">Multipurpose</li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                    <div class="content flex-row-fluid" id="kt_content">
                        {{ $slot }}
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <script src="{{ mix('revo/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ mix('revo/js/scripts.bundle.js') }}"></script>

    @livewireScripts

    @stack('scripts')


</body>

</html>
