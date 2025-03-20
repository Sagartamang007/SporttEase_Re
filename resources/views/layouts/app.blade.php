<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SportEase</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link href="{{asset('vendor/css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('vendor/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
             @include('layouts.navigation')
             @include('layouts.aside')


            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    </body>
    <script src="{{ asset('vendor/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('vendor/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('vendor/js/main.js') }}"></script>

</html>
