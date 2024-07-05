<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Noteify</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <wireui:scripts />
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="flex flex-col justify-between min-h-screen">
        <!-- Header -->
        <header class="py-4 bg-indigo-700 ">
            <div class="container px-10 ">
                <!-- Navigation component -->
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex items-center">
            <div class="container text-center">
                <div class="flex flex-col justify-center max-w-2xl p-10 mx-auto bg-white shadow-lg rounded-3xl">
                    <x-application-logo class="w-auto h-20" />
                    <h1 class="mt-4 text-4xl font-bold">Welcome to Noteify</h1>
                    <p class="mt-2 text-lg text-gray-600">Your ultimate note-taking app.</p>
                    <x-button primary xl href="{{ route('register') }}" class="w-full mt-8">Get Started</x-button>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-4 text-center border-t-2">
            <div class="container mx-auto">
                <span class="text-gray-600">&copy; 2024 man-myth. All rights reserved.</span>
            </div>
        </footer>
    </div>
</body>

</html>
