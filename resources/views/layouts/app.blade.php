<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Pour pusher des scripts tels que chart js sur les pages nécessaires -->
    @stack('scripts')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div style="min-height: 640px;" class="bg-gray-100">

        <div x-data="{ open: false }" @keydown.window.escape="open = false" class="h-screen flex overflow-hidden bg-gray-100">

            <x-mobile-menu />
            <x-desktop-menu />

            <div class="flex flex-col w-0 flex-1 overflow-hidden">

                <x-top-menu />

                <!-- Interface principale -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Contenu -->
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>

    </div>

</body>

</html>