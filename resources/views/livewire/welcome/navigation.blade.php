<nav class="flex justify-end gap-2">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Dashboard
        </a>
    @else
        <x-button white
            href="{{ route('login') }}"
            class=""
        >
            Log in
        </x-button>

        @if (Route::has('register'))
            <x-button white
                href="{{ route('register') }}"
                class=""
            >
                Register
            </x-button>
        @endif
    @endauth
</nav>
