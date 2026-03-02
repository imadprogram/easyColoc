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
        <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-clipboard@2.x.x/dist/alpine-clipboard.js" defer></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-900 bg-[#f0f2f5]">
        <div class="flex h-screen overflow-hidden">
            @include('components.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto">
                    @yield('content')
                    {{ $slot ?? '' }}
                </main>
            </div>
        </div>

        <!-- Modals rendered at body level to escape overflow-hidden -->
        @stack('modals')
    </body>
</html>
