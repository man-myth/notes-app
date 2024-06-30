<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="items-center gap-2 py-10 ">
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </header>
                <div class="flex lg:justify-center lg:col-start-2">
                        <x-application-logo class="w-auto h-9 " />
                    </div>


                <footer class="py-16 text-sm text-center text-black dark:text-white/70">
                    © 2024
                </footer>
            </div>
        </div>
    </div>
</body>

</html>