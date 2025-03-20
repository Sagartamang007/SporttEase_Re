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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                {{-- </a>
            </div>


        </div> --}}
        <div class="flex justify-center items-center w-full h-screen custom-outer-div">
            {{-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div> --}}
                {{ $slot }}

        </div>
    </body>
    <style>
        .custom-outer-div {
            /* Ensure the container takes full height of the screen */
            height: 100vh; /* Full viewport height */
            display: flex; /* Flexbox for centering content */
            justify-content: center; /* Horizontally center */
            align-items: center; /* Vertically center */
            padding: 0 20px; /* Horizontal padding for spacing */

            /* Add background image */
            background-image: url('{{asset('bg1.jpg')}}'); /* Path to your background image */
            background-size: cover; /* Cover the entire container */
            background-position: center center; /* Center the background image */
            background-repeat: no-repeat; /* Prevent the image from repeating */
        }

        /* Example custom background color fallback */
        .custom-outer-div.bg-custom {
            background-color: #e2e8f0; /* Custom background color */
        }

        /* Example custom height */
        .custom-outer-div.height-large {
            height: 80vh;
        }

        /* Example custom width */
        .custom-outer-div.width-small {
            width: 90%;
        }
    </style>



</html>
