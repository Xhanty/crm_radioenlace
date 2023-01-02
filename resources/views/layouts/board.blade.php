<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <style>
        .multiselect__content-wrapper {
            position: relative !important;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-gray-800 shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-center">
                    <div class="mr-6">
                        <a href="javascript:void(0)" class="text-lg font-semibold text-gray-100 no-underline">
                            {{ session('name_project') }}
                        </a>
                    </div>
                    <div class="flex-1 text-right text-white">
                        <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->nombre }}</span> |
                        <a href="javascript:window.close();" class="no-underline hover:no-underline text-gray-300 text-sm p-3">Ir a proyectos</a>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
</body>
</html>